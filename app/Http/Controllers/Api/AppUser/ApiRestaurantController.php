<?php

namespace App\Http\Controllers\Api\AppUser;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Restaurant;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiRestaurantController extends AbstractApiController
{
    /**
     * @return json|Respond
     *
     * @throws Exception
     */
    public function show(Request $request, $id)
    {
        try {
            $today = Carbon::now();
            $restaurant = Restaurant::where('id', $id)
                ->whereDate('started_at', '<=', $today)
                ->whereDate('ended_at', '>=', $today)
                ->first();
            $category = Category::query()
                ->leftJoin('restaurants', 'restaurants.id', 'categories.restaurant_id')
                ->select('categories.*')
                ->where('categories.restaurant_id', $id)
                ->whereDate('restaurants.started_at', '<=', $today)
                ->whereDate('restaurants.ended_at', '>=', $today)
                ->get();
            $dishs = Dish::query()
                ->leftJoin('restaurants', 'restaurants.id', 'dishes.restaurant_id')
                ->select('dishes.*')
                ->where('dishes.restaurant_id', $id)
                ->whereDate('restaurants.started_at', '<=', $today)
                ->whereDate('restaurants.ended_at', '>=', $today)
                ->get();
            $branchs = Branch::query()
                ->leftJoin('restaurants', 'restaurants.id', 'branches.restaurant_id')
                ->select('branches.*')
                ->where('branches.restaurant_id', $id)
                ->whereDate('restaurants.started_at', '<=', $today)
                ->whereDate('restaurants.ended_at', '>=', $today)
                ->get();
            return $this->renderJsonResponse([
                'restaurant' => $restaurant,
                'category' => $category,
                'dishs' => $dishs,
                'branchs' => $branchs,
            ]);
        } catch (Exception $e) {
            throw new Exception('[ApiRestaurantController][show] error because ' . $e->getMessage());
        }
    }
}
