<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\Favorite;
use App\Http\Requests\AddFavoriteRequest;
use App\Http\Resources\prouductResource;

class FavoriteController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $user = auth()->user();
        $products = $user->favorites()
            ->with([
                'product.category',
                'product.images.color',
                'product.variants.color',
                'product.variants.size',
            ])
            ->get()
            ->pluck('product')
            ->filter()
            ->values();

        return $this->successResponse(
            prouductResource::collection($products),
            __('messages.favorites_retrieved_successfully')
        );
    }

    public function store(AddFavoriteRequest $request)
    {
        $user = auth()->user();
        $favorite = Favorite::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id
        ]);
        return $this->successResponse($favorite, __('messages.favorite_added_successfully'));
    }
    public function destroy($id)
    {
        $user = auth()->user();
        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $id)->first();
        if (!$favorite) {
            return $this->errorResponse(__('messages.favorite_not_found'), 404);
        }
        $favorite->delete();
        return $this->successMessage(__('messages.favorite_removed_successfully'));
    }
}
