<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\traits\ApiResponse;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $categories = Category::all();
        return $this->successResponse(CategoryResource::collection($categories), __('messages.categories_retrieved_successfully'));
    }
}
