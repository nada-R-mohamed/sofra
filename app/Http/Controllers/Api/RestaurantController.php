<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    use ApiResponses;
    public function getAllRestaurants(Request $request): JsonResponse
    {
        $restaurants = Restaurant::search($request)->paginate();
        return $this->responseData(compact('restaurants'),'all restaurants');
    }
    public function getRestaurant($id): JsonResponse
    {
        $restaurant = Restaurant::find($id);
        if(!$restaurant)
        {
            return $this->responseError(['Restaurant not found']);
        }
        return $this->responseData(compact('restaurant'),'get the restaurant by id');
    }
    public function getMealsForRestaurant($id): JsonResponse
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            return $this->responseError(['message' => 'Restaurant not found'], 404);
        }

        $meals = $restaurant->meals;

        return $this->responseData(compact('meals'),'all meals for this restaurant');
    }
    public function getReviewsForRestaurant($id): JsonResponse
    {
        $restaurant = Restaurant::find($id);

        if (!$restaurant) {
            return $this->responseError(['message' => 'Restaurant not found'], 404);
        }

        $reviews = $restaurant->reviews;

        return $this->responseData(compact('reviews'),'all reviews for this restaurant');
    }

}
