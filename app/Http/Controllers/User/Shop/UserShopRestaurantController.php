<?php

namespace App\Http\Controllers\User\Shop;

use App\Helpers\ConvertNameHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class UserShopRestaurantController extends Controller
{
    protected $pathView = 'user.restaurant.home.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$id)
    {
        $restaurant = Restaurant::find($id);
        $categories = Category::where('restaurant_id', $id)->get();
        $dishes = Dish::where('restaurant_id', $id);
        if ($request->keyword) {
            $valSearch = ConvertNameHelper::escapeLike($request->keyword);
            $dishes = $dishes->where('dishes.name', 'like', '%' . $valSearch . '%');
        }
        if (isset($request->priceMin)) {
            $dishes = $dishes->where('dishes.price', '>=', $request->priceMin);
        }
        if (isset($request->priceMax)) {
            $dishes->where('dishes.price', '<=', $request->priceMax);
        }
        if (isset($request->sort)) {
            if ($request->sort == 1) {
                $dishes = $dishes->orderBy('dishes.updated_at', 'DESC');
            }
            if ($request->sort == 2) {
                $dishes = $dishes->orderBy('dishes.price', 'ASC');
            }
            if ($request->sort == 3) {
                $dishes = $dishes->orderBy('dishes.price', 'DESC');
            }
        } else {
            $dishes = $dishes->orderBy('dishes.updated_at', 'DESC');
        }
        $dishes = $dishes->paginate(25);
        $dishes = $dishes->appends(request()->query());
        $url_show = 'user.product.show';
        $title = "Sản phẩm";
        return view($this->pathView.'index', compact('restaurant', 'categories', 'dishes', 'url_show', 'title'));
    }
}
