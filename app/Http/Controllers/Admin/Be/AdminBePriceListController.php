<?php

namespace App\Http\Controllers\Admin\Be;

use App\Http\Controllers\Controller;
use App\Models\PriceList;
use App\Models\Service;
use App\Models\ServiceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBePriceListController extends Controller
{
    protected $pathView = 'admin.be.price_list.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = ServiceType::TYPE;
        $models = PriceList::MODEL;
        $datas = PriceList::query()
            ->leftJoin('services', 'services.id', 'price_lists.service_id')
            ->select(
                'price_lists.*',
                'services.name as service_name',
            )->get();
        return view($this->pathView.'index', compact('datas', 'types', 'models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ServiceType::TYPE;
        $models = PriceList::MODEL;
        $services = Service::all();
        return view($this->pathView.'create', compact('services', 'types', 'models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'service_id',
                'type_service',
                'type_list',
                'model',
            ]);
            $data = PriceList::create($params);
            DB::commit();
            return redirect()->route('admin.price_list.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[adminprice_listController][store] error ' . $e->getMessage());
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
        $data = PriceList::find($id);
        if($data) {
            $types = ServiceType::TYPE;
            $models = PriceList::MODEL;
            $services = Service::all();
            return view($this->pathView.'edit', compact('data', 'services', 'types', 'models'));
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
    public function update(Request $request, $id)
    {
        try {
            $data = PriceList::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'service_id',
                'type_service',
                'type_list',
                'model',
            ]);
            $data->update($params);
            DB::commit();
            return redirect()->route('admin.price_list.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[adminprice_listController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }
}
