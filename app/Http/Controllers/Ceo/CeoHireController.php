<?php

namespace App\Http\Controllers\Ceo;

use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ceo\CeoProfileRequest;
use App\Http\Requests\Ceo\CheckEmailRequest;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\ServiceCharge;
use App\Models\ServiceGroup;
use App\Models\ServiceType;
use App\Models\Skyline;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CeoHireController extends Controller
{
    protected $pathView = 'restaurant.ceo.hire.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_groups = ServiceGroup::all();
        return view($this->pathView . 'index', compact('service_groups'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showService(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::where('services.service_group_id', $request->service_group_id)->get();
            return response()->json([
                'services' => $services,
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showServiceType(Request $request)
    {
        if ($request->ajax()) {
            $service_types = ServiceType::query()
            ->leftJoin('services', 'services.id', 'service_types.service_id')
            ->select('service_types.*', 'services.image as service_image')
            ->where('service_types.service_id', $request->service_id)->get();
            foreach ($service_types as $service_type) {
                $service_type['service_charge'] = ServiceCharge::where('service_type_id', $service_type->id)->get();
            }
            return response()->json([
                'service_types' => $service_types,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $today = Carbon::now();
        $skyline = Skyline::first();
        $service_charge = ServiceCharge::find($id);
        $service_type = ServiceType::find($service_charge->service_type_id);
        $service = Service::find($service_type->service_id);
        $ceo = Auth::guard('ceo')->user();
        $promotions = Promotion::query()
            ->where('type', 1)
            ->where('condition', '<=', $service_charge->price)
            ->whereDate('started_at', '<=', $today)
            ->whereDate('ended_at', '>=', $today)
            ->get();
        return view($this->pathView . 'create', compact('service_charge', 'service', 'service_type', 'ceo', 'skyline', 'promotions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(CeoProfileRequest $request)
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
                $params['avatar'] = UploadsHelper::handleUploadFile('img/ceo/', 'avatar', $request);
            }
            $data->update($params);
            DB::commit();
            return response()->json([
                'status' => 200,
                'ceo' => $data,
            ]);
        } catch (Exception $e) {
            Log::error('[CeoProfileController][update] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json([
                'status' => 400,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        return view($this->pathView . 'print');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkEmail(CheckEmailRequest $request)
    {
        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPromotion(Request $request)
    {
        $datas = Promotion::query()->whereIn('id',$request->promotion_id)->get();
        return response()->json([
            'data' => $datas,
            'status' => 200,
        ]);
    }
}
