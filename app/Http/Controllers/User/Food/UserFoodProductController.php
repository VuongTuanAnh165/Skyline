<?php

namespace App\Http\Controllers\User\Food;

use App\Helpers\ConvertNameHelper;
use App\Http\Controllers\Controller;
use App\Models\CategoryHome;
use App\Models\Dish;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class UserFoodProductController extends Controller
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
            ->where('service_types.service_id', 1);
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
        $title = "M??n ??n";
        $url_home = route('user.food.home.index');
        $categoryHomes = CategoryHome::where('service_id', 1)->get();
        $url_show = 'user.food.product.show';
        return view($this->pathView . 'index', compact('dishes', 'title', 'url_home', 'categoryHomes', 'url_show'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $name_link)
    {
        $dish = Dish::query()
            ->leftJoin('categories', 'categories.id', 'dishes.category_id')
            ->select(
                'dishes.*',
                'categories.name as category_name',
            )
            ->where('dishes.id', $id)
            ->first();
        $url_home = route('user.food.home.index');
        $menu_items = MenuItem::query()
            ->leftJoin('menus', 'menus.id', 'menu_items.menu_id')
            ->where('menus.dish_id', $id)
            ->select('menu_items.*')
            ->get();
        $menus = Menu::where('dish_id', $id)->get();
        $restaurant = Restaurant::find($dish->restaurant_id);
        $text_restaurant = 'Xem nh?? h??ng';
        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();
        $text_dish = 'C??c m??n ??n kh??c c???a nh?? h??ng';
        $url_show = 'user.food.product.show';
        $url_restaurant = 'user.food.restaurant.index';
        return view($this->pathView . 'show', compact('dish', 'url_home', 'menu_items', 'menus', 'restaurant' , 'text_restaurant', 'dishes', 'text_dish', 'url_show', 'url_restaurant'));
    }
}
