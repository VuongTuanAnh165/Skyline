<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Helpers\UploadsHelper;
use App\Http\Requests\BranchRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RestaurantBranchController extends Controller
{
    protected $pathView = 'restaurant.admin.branch.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Branch::query()
            ->where('restaurant_id', Auth::guard('restaurant')->user()->id)
            ->get();
        return view($this->pathView.'index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = Branch::query()
            ->where('restaurant_id', Auth::guard('restaurant')->user()->id)
            ->max('name') + 1;
        return view($this->pathView.'create', compact('name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'address',
                'open_time',
                'close_time',
                'background',
                'longitude',
                'latitude',
            ]);
            $params['restaurant_id'] = Auth::guard('restaurant')->user()->id;
            $data = Branch::create($params);
            DB::commit();
            return redirect()->route('restaurant.branch.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantBranchController][store] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Branch::find($id);
        if($data) {
            $background = isset($data->background[0]) ? $data->background[0] : '';
            return view($this->pathView.'show', compact('data', 'background'));
        }
        return redirect()->back()->with(['error' => trans('messages.common.error')]);
    }

    public function findLocationById($id) {
        $data = Branch::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Branch::find($id);
        if($data) {
            return view($this->pathView.'edit', compact('data'));
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
    public function update(BranchRequest $request, $id)
    {
        try {
            $data = Branch::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'address',
                'open_time',
                'close_time',
                'background',
                'longitude',
                'latitude',
            ]);
            $data->update($params);
            DB::commit();
            return redirect()->route('restaurant.branch.show', ['id' => $id])->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantBranchController][update] error ' . $e->getMessage());
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
            $filePath = UploadsHelper::handleUploadFile('img/branch/', 'background', $request);
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
}
