<?php

namespace App\Http\Controllers\Restaurant;

use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RestaurantRestaurantController extends Controller
{
    protected $pathView = 'restaurant.admin.restaurant.';

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = Auth::guard('restaurant')->user();
        if (!$data) {
            abort(404);
        }
        $background = isset($data->background[0]) ? $data->background[0] : '';
        return view($this->pathView . 'edit', compact('data', 'background'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantRequest $request)
    {
        try {
            $data = Auth::guard('restaurant')->user();
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'email',
                'phone',
                'content',
                'background',
                'client_id',
                'secret',
            ]);
            if ($request->hasFile('logo')) {
                Storage::delete($data->logo);
                $params['logo'] = UploadsHelper::handleUploadFile('img/restaurant/','logo', $request);
            }
            $data->update($params);
            DB::commit();
            return redirect()->route('restaurant.restaurant.edit')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantRestaurantController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }

    /**
     * upload img
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('background')) {
            $filePath = UploadsHelper::handleUploadFile('img/restaurant/', 'background', $request);
            return response()->json(['success' => $filePath]);
        }
    }

    /**
     * remove img
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json
     */
    public function remove(Request $request)
    {
        if ($request) {
            $check = UploadsHelper::handleDeleteFile('file_name', $request);
            if ($check) {
                return response()->json(['status' => 200]);
            }
            return response()->json(['status' => 400]);
        }
    }

    /**
     * @param ChangePasswordRequest $request
     * @return json
     * @throws Exception
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $data = Auth::guard('restaurant')->user();
            if (!Hash::check($request->input('password_old'), $data->password)) {
                $data = null;
            } else {
                DB::beginTransaction();
                $data->password = Hash::make($request->input('password'));
                $data->update();
                DB::commit();
            }
            // dd(empty($data));
            if (empty($data)) {
                return response()->json(['status' => 400]);
            }
            return response()->json(['status' => 200]);
        } catch (Exception $e) {
            Log::error('[RestaurantRestaurantController][changePassword] error ' . $e->getMessage());
            DB::rollBack();
            throw new Exception('[RestaurantRestaurantController][changePassword] error ' . $e->getMessage());
        }
    }
}
