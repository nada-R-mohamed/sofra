<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use App\Models\Setting;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    use ApiResponses;
    public function allCities(): JsonResponse
    {
        $cities = City::all();
        return $this->responseData(compact('cities'), 'all cities');
    }

    public function allRegions(): JsonResponse
    {
        $regions = Region::all();
        return $this->responseData(compact('regions'), 'all regions');
    }
    public function allCategories(): JsonResponse
    {
        $categories = Category::all();
        return $this->responseData(compact('categories'), 'all categories');
    }
    public function aboutUs(): JsonResponse
    {
        $aboutApp= Setting::get('about_app');
        return $this->responseData(compact('aboutApp'));
    }
}
