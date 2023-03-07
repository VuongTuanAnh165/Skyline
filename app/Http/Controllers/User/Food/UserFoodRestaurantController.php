<?php

namespace App\Http\Controllers\User\Food;

use App\Helpers\ConvertNameHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Post;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class UserFoodRestaurantController extends Controller
{
    protected $pathView = 'user.restaurant.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
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
        $url_show = 'user.food.product.show';
        $title = "Món ăn";
        $posts = Post::where('restaurant_id', $id)->get();
        $url_post = 'user.food.restaurant.post';
        $url_home = 'user.food.restaurant.index';
        return view($this->pathView.'index', compact('restaurant', 'categories', 'dishes', 'url_show', 'title', 'posts', 'url_post', 'url_home'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post($id)
    {
        $post = Post::find($id);
        $restaurant = Restaurant::find($post->restaurant_id);
        $post_other = Post::where('id', '<>', $id)->inRandomOrder()->limit(2)->get();
        $url_post = 'user.food.restaurant.post';
        $url_home = 'user.food.restaurant.index';
        return view($this->pathView.'post', compact('post', 'restaurant', 'post_other', 'url_post', 'url_home'));
    }
}
