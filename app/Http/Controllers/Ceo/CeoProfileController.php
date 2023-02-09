<?php

namespace App\Http\Controllers\Ceo;

use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ceo\CeoChangePasswordRequest;
use App\Http\Requests\Ceo\CeoProfileRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CeoProfileController extends Controller
{
    protected $pathView = 'restaurant.ceo.profile.';

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Auth::guard('ceo')->user();
        if (!$data) {
            abort(404);
        }
        return view($this->pathView . 'show', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CeoProfileRequest $request)
    {
        try {
            $data = Auth::guard('ceo')->user();
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'email',
                'phone',
                'address',
                'cmnd',
            ]);
            if ($request->hasFile('avatar')) {
                Storage::delete($data->avatar);
                $params['avatar'] = UploadsHelper::handleUploadFile('img/ceo/','avatar', $request);
            }
            $data->update($params);
            DB::commit();
            return redirect()->back()->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[CeoProfileController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }

    /**
     * @param ChangePasswordRequest $request
     * @return json
     * @throws Exception
     */
    public function changePassword(CeoChangePasswordRequest $request)
    {
        try {
            $data = Auth::guard('ceo')->user();
            if (!Hash::check($request->input('password_old'), $data->password)) {
                $data = null;
            } else {
                DB::beginTransaction();
                $data->password = Hash::make($request->input('password'));
                $data->update();
                DB::commit();
            }
            if (empty($data)) {
                return response()->json(['status' => 400]);
            }
            return response()->json(['status' => 200]);
        } catch (Exception $e) {
            Log::error('[CeoProfileController][changePassword] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[CeoProfileController][changePassword] error ' . $e->getMessage());
        }
    }
}
