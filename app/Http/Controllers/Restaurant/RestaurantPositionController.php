<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RestaurantPositionController extends Controller
{
    protected $pathView = 'restaurant.admin.position.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Position::query()
            ->where('restaurant_id', Auth::guard('restaurant')->user()->id)
            ->get();
        $full = Position::FULL;
        $part = Position::PART;
        return view($this->pathView . 'index', compact('datas', 'full', 'part'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->pathView . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                $params = $request->only([
                    'name',
                    'wage',
                    'work_type',
                    'amount_personnel',
                ]);
                $params['restaurant_id'] = Auth::guard('restaurant')->user()->id;
                $data = Position::create($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantPositionController][store] error ' . $e->getMessage());
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $position = Position::find($request->id);
            return response()->json([
                'position' => $position,
            ]);
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
        $data = Position::find($id);
        if ($data) {
            return view($this->pathView . 'edit', compact('data'));
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
    public function update(PositionRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = Position::find($id);
                DB::beginTransaction();
                $params = $request->only([
                    'name',
                    'wage',
                    'work_type',
                    'amount_personnel',
                ]);
                $data->update($params);
                DB::commit();
                return response()->json([
                    'code' => 200,
                ]);
            } catch (Exception $e) {
                Log::error('[RestaurantPositionController][update] error ' . $e->getMessage());
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
