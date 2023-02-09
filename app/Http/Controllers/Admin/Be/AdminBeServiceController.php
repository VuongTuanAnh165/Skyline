<?php

namespace App\Http\Controllers\Admin\Be;

use App\Helpers\ConvertNameHelper;
use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBe\AdminBeServiceRequest;
use App\Models\Service;
use App\Models\ServiceCharge;
use App\Models\ServiceGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminBeServiceController extends Controller
{
    protected $pathView = 'admin.be.service.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Service::query()
            ->leftJoin('service_groups', 'service_groups.id', 'services.service_group_id')
            ->select('services.*','service_groups.name as service_group_name')
            ->get();
        $service_groups = ServiceGroup::all();
        return view($this->pathView.'index', compact('datas', 'service_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service_groups = ServiceGroup::all();
        return view($this->pathView.'create', compact('service_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBeServiceRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'service_group_id',
                'content',
            ]);
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            if ($request->hasFile('image')) {
                $params['image'] = UploadsHelper::handleUploadFile('img/service/','image', $request);
            }
            if($request->show_home) {
                $params['show_home'] = $request->show_home;
                Service::query()->update(['show_home' => 0]);
            }
            $data = Service::create($params);
            DB::commit();
            return redirect()->route('admin.service.index')->with(['success' => trans('messages.common.success')]);
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
    public function edit($id)
    {
        $data = Service::find($id);
        if($data) {
            $service_groups = ServiceGroup::all();
            return view($this->pathView.'edit', compact('data', 'service_groups'));
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
    public function update(AdminBeServiceRequest $request, $id)
    {
        try {
            $data = Service::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'service_group_id',
                'content',
            ]);
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            if ($request->hasFile('image')) {
                Storage::delete($data->image);
                $params['image'] = UploadsHelper::handleUploadFile('img/service/','image', $request);
            }
            if($request->show_home) {
                $params['show_home'] = $request->show_home;
                Service::where('id', '<>', $id)->update(['show_home' => 0]);
            }
            $data->update($params);
            DB::commit();
            return redirect()->route('admin.service.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[AdminBeServiceController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateShowHome($id)
    {
        try {
            $data = Service::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            if($data->show_home == 1) {
                $data->update(['show_home' => 0]);
            } else {
                Service::where('id', '<>', $id)->update(['show_home' => 0]);
                $data->update(['show_home' => 1]);
            }
            DB::commit();
            return redirect()->route('admin.service.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[AdminBeServiceController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }
}
