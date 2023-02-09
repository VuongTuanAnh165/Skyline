<?php

namespace App\Http\Controllers\Admin\Be;

use App\Http\Controllers\Controller;
use App\Models\PriceList;
use App\Models\Service;
use App\Models\ServiceCharge;
use App\Models\ServiceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBeServiceTypeController extends Controller
{
    protected $pathView = 'admin.be.service.service_type.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $datas = ServiceType::where('service_id', $id)
            ->get();
        $service = Service::find($id);
        return view($this->pathView . 'index', compact('datas', 'service'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $service_type = ServiceType::find($request->id);
        $service_charges = ServiceCharge::where('service_type_id', $request->id)->get();
        if($service_type && $service_charges) {
            return response()->json([
                'code' => 200,
                'service_type' => $service_type,
                'service_charges' => $service_charges,
            ]);
        }
        return response()->json([
            'code' => 400,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeServiceCharge(Request $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $params = $request->only([
                    'service_type_id',
                    'month',
                    'price',
                ]);
                $data = ServiceCharge::create($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[AdminBeServiceController][storeServiceCharge] error ' . $e->getMessage());
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateServiceCharge(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = ServiceCharge::find($request->id);
                DB::beginTransaction();
                $params = $request->only([
                    'service_type_id',
                    'month',
                    'price',
                ]);
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[AdminBeServiceController][updateServiceCharge] error ' . $e->getMessage());
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

    /**
     * destroy the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyServiceCharge(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = ServiceCharge::find($request->id);
                $data->delete();
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[AdminBeServiceController][destroyServiceCharge] error ' . $e->getMessage());
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_service)
    {
        $types = ServiceType::TYPE;
        $service = Service::find($id_service);
        $price_lists = PriceList::all();
        return view($this->pathView.'create', compact('types', 'service', 'price_lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_service)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'description',
            ]);
            $params['service_id'] = $id_service;
            $params['price_list'] = [];
            $price_lists = PriceList::all();
            foreach($price_lists as $price_list) {
                $id_request = $price_list->id_request;
                $value_request = $price_list->value_request;
                if($request->$id_request && $request->$value_request) {
                    $params['price_list'] += [
                        $request->$id_request => $request->$value_request,
                    ];
                }
            }
            $data = ServiceType::create($params);
            DB::commit();
            return redirect()->route('admin.service_type.index', ['id' => $id_service])->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[AdminBeServiceController][store] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_service, $id)
    {
        $data = ServiceType::find($id);
        // dd($data);
        if($data) {
            $service = Service::find($id_service);
            $price_lists = PriceList::all();
            $types = ServiceType::TYPE;
            return view($this->pathView.'edit', compact('data', 'service', 'price_lists', 'types'));
        }
        return redirect()->back()->with(['error' => trans('messages.common.error')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_service, $id)
    {
        try {
            $data = ServiceType::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'description',
            ]);
            $params['service_id'] = $id_service;
            $params['price_list'] = [];
            $price_lists = PriceList::all();
            foreach($price_lists as $price_list) {
                $id_request = $price_list->id_request;
                $value_request = $price_list->value_request;
                if($request->$id_request && $request->$value_request) {
                    $params['price_list'] += [
                        $request->$id_request => $request->$value_request,
                    ];
                }
            }
            $data->update($params);
            DB::commit();
            return redirect()->route('admin.service_type.index', ['id' => $id_service])->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[AdminBeServiceController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }
}
