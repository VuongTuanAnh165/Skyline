<?php

namespace App\Http\Controllers\Ceo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ceo\CeoHelpRequest;
use App\Models\Help;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CeoHelpController extends Controller
{
    protected $pathView = 'restaurant.ceo.help.';

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
            )
            ->where('helps.ceo_id', Auth::guard('ceo')->user()->id)
            ->get();
        return view($this->pathView . 'index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view($this->pathView . 'create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CeoHelpRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'service_id',
                'question',
            ]);
            $params['ceo_id'] = Auth::guard('ceo')->user()->id;
            $data = Help::create($params);
            DB::commit();
            return redirect()->route('ceo.help.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantPositionController][store] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
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
}
