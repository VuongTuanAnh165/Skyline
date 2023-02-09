<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShiftRequest;
use App\Models\Position;
use App\Models\Shift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestaurantShiftController extends Controller
{
    protected $pathView = 'restaurant.admin.shift.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fullTime = Shift::query()
            ->where('work_type', Position::FULL)
            ->where('restaurant_id', Auth::guard('restaurant')->user()->id)
            ->orderBy('id', 'asc')
            ->get();
        $partTime = Shift::query()
            ->where('work_type', Position::PART)
            ->where('restaurant_id', Auth::guard('restaurant')->user()->id)
            ->orderBy('id', 'asc')
            ->get();
        return view($this->pathView . 'index', compact('fullTime', 'partTime'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShiftRequest $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $params = $request->only([
                    'name',
                    'start',
                    'end',
                    'work_type',
                ]);
                $params['restaurant_id'] = Auth::guard('restaurant')->user()->id;
                $data = Shift::create($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantShiftController][store] error ' . $e->getMessage());
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShiftRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = Shift::find($request->id);
                DB::beginTransaction();
                $params = $request->only([
                    'start',
                    'end',
                    'work_type',
                ]);
                $params['restaurant_id'] = Auth::guard('restaurant')->user()->id;
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                    'data' => $data,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantShiftController][update] error ' . $e->getMessage());
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

    /**
     * destroy the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Shift::find($request->id);
                $data->delete();
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantShiftController][destroy] error ' . $e->getMessage());
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
