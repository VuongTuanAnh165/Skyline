<?php

namespace App\Http\Controllers\Admin\Be;

use App\Helpers\ConvertNameHelper;
use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBe\AdminBeServiceGroupRequest;
use App\Models\ServiceGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminBeServiceGroupController extends Controller
{
    protected $pathView = 'admin.be.service.service_group.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = ServiceGroup::query()
            ->get();
        return view($this->pathView . 'index', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBeServiceGroupRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name'
            ]);
            if ($request->hasFile('image')) {
                $params['image'] = UploadsHelper::handleUploadFile('img/service_group/', 'image', $request);
            }
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            $data = ServiceGroup::create($params);
            DB::commit();
            return response()->json([
                'code' => 200,
            ]);
        } catch (Exception $e) {
            Log::error('[AdminBeServiceGroupController][store] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json([
                'code' => 400,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $service_group = ServiceGroup::find($request->id);
            $image = !empty($service_group->image) ? asset('storage/' . $service_group->image) : '';
            return response()->json([
                'service_group' => $service_group,
                'image' => $image,
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
    public function update(AdminBeServiceGroupRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = ServiceGroup::find($id);
                DB::beginTransaction();
                $params = $request->only([
                    'name'
                ]);
                $params['name_link'] = ConvertNameHelper::convertName($request->name);
                if ($request->hasFile('image')) {
                    Storage::delete($data->image);
                    $params['image'] = UploadsHelper::handleUploadFile('img/service_group/', 'image', $request);
                }
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[AdminBeServiceGroupController][update] error ' . $e->getMessage());
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
