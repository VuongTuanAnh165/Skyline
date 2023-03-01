<?php

namespace App\Http\Controllers\Admin\Be;

use App\Helpers\ConvertNameHelper;
use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBe\AdminBeCategoryHomeRequest;
use App\Models\CategoryHome;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminBeCategoryHomeController extends Controller
{
    protected $pathView = 'admin.be.category.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = CategoryHome::query()
            ->leftJoin('services', 'services.id', 'category_homes.service_id')
            ->select(
                'category_homes.*',
                'services.name as service_name'
            )->orderByDesc('category_homes.updated_at')->get();
        $services = Service::all();
        return view($this->pathView . 'index', compact('datas', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBeCategoryHomeRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'service_id',
            ]);
            if ($request->hasFile('image')) {
                $params['image'] = UploadsHelper::handleUploadFile('img/category/', 'image', $request);
            }
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            $data = CategoryHome::create($params);
            DB::commit();
            return response()->json([
                'code' => 200,
            ]);
        } catch (Exception $e) {
            Log::error('[AdminBeCategoryHomeController][store] error ' . $e->getMessage());
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
            $category = CategoryHome::find($request->id);
            $image = !empty($category->image) ? asset('storage/' . $category->image) : '';
            return response()->json([
                'category' => $category,
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
    public function update(AdminBeCategoryHomeRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = CategoryHome::find($id);
                DB::beginTransaction();
                $params = $request->only([
                    'name',
                    'service_id',
                ]);
                $params['name_link'] = ConvertNameHelper::convertName($request->name);
                if ($request->hasFile('image')) {
                    Storage::delete($data->image);
                    $params['image'] = UploadsHelper::handleUploadFile('img/category/', 'image', $request);
                }
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[AdminBeCategoryHomeController][update] error ' . $e->getMessage());
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
