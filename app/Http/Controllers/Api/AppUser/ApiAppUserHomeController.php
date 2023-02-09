<?php

namespace App\Http\Controllers\Api\AppUser;

use App\Http\Controllers\Api\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Models\CategoryHome;
use App\Models\Image;
use App\Models\Promotion;
use App\Models\Restaurant;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiAppUserHomeController extends AbstractApiController
{
    /**
     * @return json|Respond
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        try {
            $today = Carbon::now();
            $image = Image::where('type', Image::APPUSERSELL)
                ->limit(3)
                ->get();
            $categoryHome = CategoryHome::get();
            $restaurantNew = Restaurant::query()
                ->whereDate('started_at', '<=', $today)
                ->whereDate('ended_at', '>=', $today)
                ->orderByDESC('created_at')
                ->get();
            $dataRestaurantSale = Restaurant::query()
                ->join('promotions', 'promotions.restaurant_id', 'restaurants.id')
                ->select([
                    'restaurants.*',
                ])
                ->whereDate('restaurants.started_at', '<=', $today)
                ->whereDate('restaurants.ended_at', '>=', $today)
                ->distinct()
                ->get();
            foreach($dataRestaurantSale as $key => $value) {
                $promotion = Promotion::where('restaurant_id', $value->id)->get();
                $data = [];
                foreach($promotion as $key_pro => $value_pro) {
                    $data += [
                        $value_pro->condition => $value_pro->value
                    ];
                }
                $dataRestaurantSale[$key]['promotion'] = $data;
            }
            return $this->renderJsonResponse([
                'image' => $image,
                'categoryHome' => $categoryHome,
                'restaurantNew' => $restaurantNew,
                'dataRestaurantSale' => $dataRestaurantSale,
            ]);
        } catch (Exception $e) {
            throw new Exception('[ApiAppUserHomeController][index] error because ' . $e->getMessage());
        }
    }
}
