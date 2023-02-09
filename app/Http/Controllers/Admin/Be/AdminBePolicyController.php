<?php

namespace App\Http\Controllers\Admin\Be;

use App\Helpers\ConvertNameHelper;
use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PolicyRequest;
use App\Models\Policy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBePolicyController extends Controller
{
    protected $pathView = 'admin.be.policy.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Policy::all();
        return view($this->pathView.'index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->pathView.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PolicyRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'content',
            ]);
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            $data = Policy::create($params);
            DB::commit();
            return redirect()->route('admin.policy.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[adminpolicyController][store] error ' . $e->getMessage());
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
        $data = Policy::find($id);
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
    public function update(PolicyRequest $request, $id)
    {
        try {
            $data = Policy::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'content',
            ]);
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            $data->update($params);
            DB::commit();
            return redirect()->route('admin.policy.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[adminpolicyController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }
}
