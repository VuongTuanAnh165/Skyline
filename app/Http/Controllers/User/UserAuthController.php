<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\UserVerifyRequest;
use App\Jobs\User\SendEmailRegisterComplete;
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

class UserAuthController extends Controller
{
    protected $pathView = 'user.auth.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prev = $request->prev;
        if (Auth::guard('user')->check()) {
            if ($prev) {
                return redirect($prev);
            }
            return redirect()->route('user.home.index');
        }
        return view($this->pathView . 'index', compact('prev'));
    }

    /**
     * @param UserLoginRequest $request
     * @return json|Respond
     */
    public function login(UserLoginRequest $request)
    {
        try {
            $credentials = [
                'email' => $request->input('email_login'),
                'password' => $request->input('password_login'),
            ];
            if (!Auth::guard('user')->attempt($credentials)) {
                $guard = null;
            } else {
                DB::beginTransaction();
                $request->session()->regenerate();
                $email = $request->input('email_login');
                $guard = User::where('email', $email)->select('*')->first();
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
                return redirect()->back()->with(['error' => trans('messages.api.user.login.fail')]);
            }
            if ($request->route) {
                return redirect($request->route)->with(['success' => trans('messages.api.user.login.success')]);
            }
            return redirect()->route('user.home.index')->with(['success' => trans('messages.api.user.login.success')]);
        } catch (Exception $e) {
            Log::error('[ApiUserController][login] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[ApiUserController][login] error ' . $e->getMessage());
            return redirect()->back()->with(['error' => trans('messages.common.error_register')]);
        }
    }

    /**
     * Create User
     * @param ApiUserStoreRequest $request
     * @return json|Respond
     * @throws Exception
     */
    public function register(UserRegisterRequest $request)
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
            return redirect(route('user.verify', ['id' => $user->id]) . '?prev=' . $request->route)->with(['success' => trans('messages.api.user.register.success')]);
        } catch (Exception $e) {
            Log::error('[ApiUserController][store] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[ApiUserController][store] error because ' . $e->getMessage());
            return redirect()->back()->with(['error' => trans('messages.common.error_register')]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function verify(Request $request, $id)
    {
        $id = $id;
        $prev = $request->prev;
        return view($this->pathView . 'verify', compact('id', 'prev'));
    }

    /**
     * Verify Register
     * @param UserVerifyRequest $request
     * @param $id
     * @return json|Respond
     * @throws Exception
     */

    public function verifyStore(UserVerifyRequest $request, $id)
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
                Auth::guard('user')->loginUsingId($data->id);
                DB::commit();
                $user = $data;
            }
            if (empty($user)) {
                return redirect()->back()->with(['error' => trans('messages.api.user.verifyRegister.fail')]);
            }
            if ($request->route) {
                return redirect($request->route)->with(['success' => trans('messages.api.user.verifyRegister.success')]);
            }
            return redirect()->route('user.home.index')->with(['success' => trans('messages.api.user.verifyRegister.success')]);
        } catch (Exception $e) {
            Log::error('[ApiUserController][verifyRegister] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[ApiUserController][verifyRegister] error because ' . $e->getMessage());
            return redirect()->back()->with(['error' => trans('messages.api.user.verifyRegister.fail')]);
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user.home.index');
    }

    public function updateProfile(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user = User::find(Auth::guard('user')->user()->id);
                $datas = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ];
                $user->update($datas);
                return response()->json([
                    'code' => 200,
                    'user' => $user,
                ]);
            } catch (Exception $e) {
                Log::error('[UserCartController][addCart] error ' . $e->getMessage());
                dd($e);
                DB::rollBack();
                return response()->json([
                    'code' => 400,
                ]);
            }
        } else {
            return response()->json([
                'code' => 400,
            ]);
        }
    }
}
