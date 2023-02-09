<?php

namespace App\Http\Controllers\Admin\Be;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBe\AdminBeHelpRequest;
use App\Models\Help;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBeHelpController extends Controller
{
    protected $pathView = 'admin.be.help.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Help::query()
            ->leftJoin('services', 'services.id', 'helps.service_id')
            ->select(
                'helps.*',
                'services.name as service_name',
            )->get();
        return view($this->pathView . 'index', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $datas = Help::find($request->id);
        return response()->json([
            'data' => $datas,
            'status' => 200,
        ]);
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
    public function store(AdminBeHelpRequest $request)
    {
        try {
            $data = Help::find($request->id);
            DB::beginTransaction();
            $params = $request->only([
                'answer',
            ]);
            $params['admin_id'] = Auth::guard('admin')->user()->id;
            $params['status'] = 1;
            $data->update($params);
            DB::commit();
            return response()->json([
                'data' => $data,
                'status' => 200,
            ]);
        } catch (Exception $e) {
            Log::error('[AdminBeHelpController][store] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json([
                'status' => 400,
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
    public function updateShowHome($id)
    {
        try {
            $data = Help::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            if($data->show_home == 1) {
                $data->update(['show_home' => 0]);
            } else {
                $data->update(['show_home' => 1]);
            }
            DB::commit();
            return redirect()->route('admin.help.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[AdminBeHelpController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }
}
