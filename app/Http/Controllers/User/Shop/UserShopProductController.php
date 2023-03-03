<?php

namespace App\Http\Controllers\User\Shop;

use App\Helpers\ConvertNameHelper;
use App\Http\Controllers\Controller;
use App\Models\CategoryHome;
use App\Models\Dish;
use Illuminate\Http\Request;

class UserShopProductController extends Controller
{
    protected $pathView = 'user.product.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dishes = Dish::query()
            ->leftJoin('restaurants', 'restaurants.id', 'dishes.restaurant_id')
            ->leftJoin('order_ceos', 'order_ceos.restaurant_id', 'restaurants.id')
            ->leftJoin('service_charges', 'service_charges.id', 'order_ceos.service_charge_id')
            ->leftJoin('service_types', 'service_types.id', 'service_charges.service_type_id')
            ->select('dishes.*')
            ->where('service_types.service_id', 2);
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
        $title = "Sản phẩm";
        $url_home = route('user.food.home.index');
        $categoryHomes = CategoryHome::where('service_id', 2)->get();
        return view($this->pathView . 'index', compact('dishes', 'title', 'url_home', 'categoryHomes'));
    }
}
