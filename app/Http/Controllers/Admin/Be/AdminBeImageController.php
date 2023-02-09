<?php

namespace App\Http\Controllers\Admin\Be;

use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBe\AdminBeImageRequest;
use App\Models\Image;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminBeImageController extends Controller
{
    protected $pathView = 'admin.be.image.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Image::get();
        return view($this->pathView . 'index', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBeImageRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'type'
            ]);
            if ($request->hasFile('image')) {
                $params['image'] = UploadsHelper::handleUploadFile('img/image/', 'image', $request);
            }
            $data = Image::create($params);
            DB::commit();
            return response()->json([
                'code' => 200,
            ]);
        } catch (Exception $e) {
            Log::error('[AdminBeImageController][store] error ' . $e->getMessage());
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
            $data = Image::find($request->id);
            $image = !empty($data->image) ? asset('storage/' . $data->image) : '';
            return response()->json([
                'data' => $data,
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
    public function update(AdminBeImageRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = Image::find($id);
                DB::beginTransaction();
                $params = $request->only([
                    'type'
                ]);
                if ($request->hasFile('image')) {
                    Storage::delete($data->image);
                    $params['image'] = UploadsHelper::handleUploadFile('img/image/', 'image', $request);
                }
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[AdminBeImageController][update] error ' . $e->getMessage());
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
