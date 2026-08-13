<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\traits\ApiResponse;
use App\Http\Resources\prouductResource;

class ProductController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $products = Product::all();
        return $this->successResponse(prouductResource::collection($products), __('messages.products_retrieved_successfully'));
    }


    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->errorResponse(__('messages.product_not_found'), 404);
        }
        return $this->successResponse(new prouductResource($product), __('messages.product_retrieved_successfully'));
    }
}
