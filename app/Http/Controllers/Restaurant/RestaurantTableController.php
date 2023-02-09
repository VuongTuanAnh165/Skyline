<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Branch;
use App\Models\Table;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestaurantTableController extends Controller
{
    protected $pathView = 'restaurant.admin.branch.table.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $datas = Table::query()
            ->where('branch_id', $id)
            ->get();
        $branch = Branch::query()
            ->where('branches.id', $id)
            ->first();
        $name = Table::query()
            ->where('branch_id', $id)
            ->max('name') + 1;
        return view($this->pathView.'index', compact('datas', 'branch', 'name'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $table = Table::find($request->id);
            return response()->json([
                'table' => $table,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableRequest $request, $branch_id)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'max_people'
            ]);
            $params['status'] = $request->status ? $request->status : 0;
            $params['branch_id'] = $branch_id;
            $data = Table::create($params);
            DB::commit();
            return response()->json([
                'code' => 200,
            ]);
        } catch (Exception $e) {
            Log::error('[RestaurantTableController][store] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json([
                'code' => 400,
                'error' => $e->getMessage()
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
    public function update(TableRequest $request, $branch_id, $id)
    {
        if ($request->ajax()) {
            try {
                $data = Table::find($id);
                $params = $request->only([
                    'name',
                    'max_people'
                ]);
                $params['branch_id'] = $branch_id;
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantTableController][update] error ' . $e->getMessage());
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
