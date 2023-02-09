<?php

namespace App\Http\Controllers\Restaurant;

use App\Helpers\ConvertNameHelper;
use App\Helpers\UploadsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RestaurantPostController extends Controller
{
    protected $pathView = 'restaurant.admin.post.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        $datas = Post::query()
            ->where('restaurant_id', $restaurant_id)
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
        return view($this->pathView.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $restaurant_id = Auth::guard('restaurant')->user() ? Auth::guard('restaurant')->user()->id : Auth::guard('personnel')->user()->restaurant_id;
        try {
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'description',
                'content',
            ]);
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            $params['restaurant_id'] = $restaurant_id;
            if ($request->hasFile('image')) {
                $params['image'] = UploadsHelper::handleUploadFile('img/post/','image', $request);
            }
            if(Auth::guard('personnel')->user()) {
                $params['create_by'] = Auth::guard('personnel')->user()->id;
            } else {
                $params['create_by'] = -1;
            }
            $data = Post::create($params);
            DB::commit();
            return redirect()->route('restaurant.post.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantpostController][store] error ' . $e->getMessage());
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
        $data = Post::find($id);
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
    public function update(PostRequest $request, $id)
    {
        try {
            $data = Post::find($id);
            if (!$data) {
                abort(404);
            }
            DB::beginTransaction();
            $params = $request->only([
                'name',
                'description',
                'content',
            ]);
            $params['name_link'] = ConvertNameHelper::convertName($request->name);
            if ($request->hasFile('image')) {
                Storage::delete($data->image);
                $params['image'] = UploadsHelper::handleUploadFile('img/post/','image', $request);
            }
            if(Auth::guard('personnel')->user()) {
                $params['update_by'] = Auth::guard('personnel')->user()->id;
            } else {
                $params['update_by'] = -1;
            }
            $data->update($params);
            DB::commit();
            return redirect()->route('restaurant.post.index')->with(['success' => trans('messages.common.success')]);
        } catch (Exception $e) {
            Log::error('[RestaurantpostController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => trans('messages.common.error')]);
        }
    }
}
