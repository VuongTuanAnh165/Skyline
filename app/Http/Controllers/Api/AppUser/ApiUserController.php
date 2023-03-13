<?php

namespace App\Http\Controllers\Api\AppUser;

use App\Helpers\UploadsHelper;
use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiUserChangePasswordRequest;
use App\Http\Requests\Api\ApiUserForgotPasswordRequest;
use App\Http\Requests\Api\ApiUserLoginRequest;
use App\Http\Requests\Api\ApiUserStoreRequest;
use App\Http\Requests\Api\ApiUserVerifyRegisterRequest;
use App\Http\Requests\Api\ApiVerifyForgotPasswordRequest;
use App\Http\Requests\Api\CreatePasswordRequest;
use App\Jobs\User\SendEmailForgotPassword;
use App\Jobs\User\SendEmailRegisterComplete;
use App\Jobs\User\SendEmailVerifyForgotPassword;
use App\Models\Activation;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\UserDevice;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

class ApiUserController extends AbstractApiController
{
    /**
     * Create User
     * @param ApiUserStoreRequest $request
     * @return json|Respond
     * @throws Exception
     */
    public function store(ApiUserStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'status' => User::STATUS_INACTIVE,
            ];
            $user = User::create($data);
            if (!empty($user)) {
                $data_activation = [
                    'user_id' => $user->id,
                    'code' => sprintf('%06d', rand(1, 999999)),
                    'expired_time' => Carbon::now()->addMinutes(5),
                ];
                $code = Activation::create($data_activation);
                if (!empty($user->email) && !empty($code)) {
                    dispatch(new SendEmailRegisterComplete($user->email, $code));
                }
            }
            DB::commit();
            $userStore = [
                'user' => $user,
                'code' => $code->code,
            ];
            return $this->respondCreated($userStore, __('messages.api.user.register.success'));
        } catch (Exception $e) {
            Log::error('[ApiUserController][store] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[ApiUserController][store] error because ' . $e->getMessage());
        }
    }

    /**
     * Verify Register
     * @param ApiUserVerifyRegisterRequest $request
     * @param $id
     * @return json|Respond
     * @throws Exception
     */

    public function verifyRegister(ApiUserVerifyRegisterRequest $request, $id)
    {
        try {
            $data = User::join('activations', 'activations.user_id', 'users.id')
                ->where('activations.user_id', $id)
                ->where('activations.code', $request->input('code'))
                ->where('activations.expired_time', '>=', Carbon::now()->format('Y-m-d H:i:s'))
                ->where('activations.completed', PasswordReset::COMPLETED_FALSE)
                ->where('users.status', User::STATUS_INACTIVE)
                ->select(['users.*', 'activations.id as activation_id'])
                ->first();
            if (empty($data)) {
                $user = null;
            } else {
                DB::beginTransaction();
                $data->update([
                    'status' => User::STATUS_ACTIVE,
                ]);
                Activation::where('id', $data->activation_id)->update([
                    'completed' => Activation::COMPLETEDTRUE,
                    'completed_at' => Carbon::now(),
                ]);
                $accessToken = $data->createToken('AuthToken User', ['user'])->accessToken;
                $data->accessToken = $accessToken;
                DB::commit();
                $user = $data;
            }
            if (empty($user)) {
                return $this->respondWithError(__('messages.api.user.verifyRegister.fail'));
            }
            return $this->renderJsonResponse($user, __('messages.api.user.verifyRegister.success'));
        } catch (Exception $e) {
            Log::error('[ApiUserController][verifyRegister] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[ApiUserController][verifyRegister] error because ' . $e->getMessage());
        }
    }

    /**
     * @param UserLoginRequest $request
     * @return json|Respond
     */
    public function login(ApiUserLoginRequest $request)
    {
        try {
            $email = $request->input('email');
            $guard = User::where('email', $email)->select('*')->first();
            if (empty($guard) || !Hash::check($request->input('password'), $guard->password)) {
                $guard = null;
            } else {
                DB::beginTransaction();
                $accessToken = $guard->createToken('AuthToken User', ['user'])->accessToken;
                $guard->accessToken = $accessToken;

                if ($request->input('device')) {
                    $userDevice = UserDevice::firstOrCreate(
                        [
                            'device_token' => $request->input('device_token'),
                        ],
                        [
                            'user_id' => $guard->id,
                            'device' => $request->input('device'),
                            'device_token' => $request->input('device_token'),
                        ]
                    );
                }
                DB::commit();

                if ($guard->status == User::STATUS_INACTIVE) {
                    DB::beginTransaction();

                    $dataActivation = [
                        'user_id' => $guard->id,
                        'code' => sprintf('%06d', rand(1, 999999)),
                        'expired_time' => Carbon::now()->addMinutes(5),
                    ];
                    $code = Activation::create($dataActivation);
                    DB::commit();
                    if (!empty($guard->email) && !empty($code)) {
                        dispatch(new SendEmailRegisterComplete($guard->email, $code));
                    }
                    $data = [
                        'id' => $guard->id,
                        'email' => $guard->email,
                        'name' => $guard->name,
                        'gender' => $guard->gender,
                        'address' => $guard->address,
                        'code' => $code->code
                    ];
                    $guard = $data;
                }
                $user = $guard;
            }
            if (empty($user)) {
                return $this->respondBadRequest(__('messages.api.user.login.fail'));
            }
            return $this->renderJsonResponse($user, __('messages.api.user.login.success'));
        } catch (Exception $e) {
            Log::error('[ApiUserController][login] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[ApiUserController][login] error ' . $e->getMessage());
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return json
     */
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if (!empty($user)) {
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });
            return $this->renderJsonResponse([], __('messages.api.logout.success'));
        }
        return $this->renderJsonResponse([], __('messages.api.logout.error'), 400);
    }

    /**
     * @param ApiUserChangePasswordRequest $request
     * @return json
     * @throws Exception
     */
    public function changePassword(ApiUserChangePasswordRequest $request)
    {
        try {
            $userApi = Auth::guard('api')->user();
            if (!Hash::check($request->input('password_old'), $userApi->password)) {
                $userApi = null;
            } else {
                DB::beginTransaction();
                $userApi->password = Hash::make($request->input('password'));
                // dd($userApi->password);
                $userApi->update();
                DB::commit();
            }
            $user = $userApi;
            $msg = __('messages.api.user.chanePassword.success');
            if (empty($user)) {
                $msg = __('messages.api.user.chanePassword.fail');
                return $this->respondBadRequest($msg);
            }
            return $this->renderJsonResponse($user, $msg,);
        } catch (Exception $e) {
            Log::error('[ApiUserController][changePassword] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[ApiUserController][changePassword] error ' . $e->getMessage());
        }
    }

    /**
     * @param ApiUserForgotPasswordRequest $request
     * @return json
     * @throws Exception
     */
    public function forgotPassword(ApiUserForgotPasswordRequest $request)
    {
        $column = ['status', 'id', 'email'];
        $dataUser = User::where('email', $request->input('email'))->select($column)->first();
        if (empty($dataUser) || $dataUser->status == User::STATUS_INACTIVE) {
            $user = null;
        } else {
            try {
                DB::beginTransaction();
                $data = new PasswordReset;
                $data->user_id = $dataUser->id;
                $data->token = Str::random(150);
                $data->expired_time = Carbon::now()->addMinutes(5);
                $data->code = sprintf('%06d', rand(1, 999999));
                $data->save();
                DB::commit();
                if (!empty($dataUser->email)) {
                    dispatch(new SendEmailForgotPassword($dataUser->email, $data));
                }
                $user = [
                    'user_id' => $dataUser->id,
                    'code' => $data->code,
                ];
            } catch (Exception $e) {
                Log::error('[ApiUserController][forgotPassword] error ' . $e->getMessage());
                DB::rollBack();
                throw new Exception('[ApiUserController][forgotPassword] error ' . $e->getMessage());
            }
        }
        if (empty($user)) {
            return $this->respondBadRequest(__('messages.api.user.forgotPassword.fail'));
        }
        return $this->renderJsonResponse($user, __('messages.api.user.forgotPassword.success'));
    }

    /**
     * @param ApiVerifyForgotPasswordRequest $request
     * @return json
     */
    public function verifyForgotPassword(ApiVerifyForgotPasswordRequest $request)
    {
        return $this->renderJsonResponse(null, __('messages.api.user.verifyForgotPassword.confirm'));
    }

    /**
     * create password by forgot
     * @param CreatePasswordRequest $request
     * @param $id
     * @return json
     * @throws Exception
     */
    public function createForgotPassword(CreatePasswordRequest $request, $id)
    {
        $user = User::where('id', $id)->Active()->first();
        if (empty($user)) {
            $pass = null;
        } else {
            $code = PasswordReset::where('user_id', $user['id'])->where('code', $request->input('code'))
                ->where('completed', config('constants.completedFalse'))
                ->select(['completed_at', 'completed'])
                ->orderBy('id', 'desc')->first();
            try {
                DB::beginTransaction();
                $user->password = Hash::make($request->input('password'));
                $user->update();
                if (!empty($code)) {
                    $code->completed_at = Carbon::now();
                    $code->completed = PasswordReset::COMPLETED_TRUE;
                    $code->update();
                }
                if (!empty($user->email)) {
                    dispatch(new SendEmailVerifyForgotPassword($user->email, $request->input('password')));
                }
                DB::commit();
                $pass = $request->input('password');
            } catch (Exception $e) {
                Log::error('[ApiUserController][verifyForgotPassword] error ' . $e->getMessage());
                DB::rollBack();
                throw new Exception('[ApiUserController][verifyForgotPassword] error ' . $e->getMessage());
            }
        }
        if (empty($pass)) {
            return $this->respondWithError(__('messages.api.user.verifyForgotPassword.fail'));
        }
        return $this->renderJsonResponse($pass, __('messages.api.user.verifyForgotPassword.success'));
    }

    /**
     * @return json|Respond
     *
     * @throws Exception
     */
    public function show()
    {
        try {
            $data = Auth::guard('api')->user();
            $user = $data;
            return $this->renderJsonResponse($user);
        } catch (Exception $e) {
            throw new Exception('[ApiUserController][show] error because ' . $e->getMessage());
        }
    }

    /**
     * @param UserUpdateRequest $request
     * @return json|Respond
     * @throws Exception
     */
    public function update(Request $request)
    {
        try {
            $id = Auth::guard('api')->user()->id;
            DB::beginTransaction();
            $filePath = UploadsHelper::handleUploadFile('img/user/', 'avatar', $request);
            $data = [
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'birthday' => $request->input('birthday'),
                'gender' => $request->input('gender'),
                'avatar' => $filePath,
            ];
            DB::commit();
            $user = User::where('id', $id)->update($data);
            $user_data = Auth::guard('api')->user();
            return $this->renderJsonResponse($user_data);
        } catch (Exception $e) {
            Log::error('[ApiUserController][update] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[ApiUserController][update] error because ' . $e->getMessage());
        }
    }
}
