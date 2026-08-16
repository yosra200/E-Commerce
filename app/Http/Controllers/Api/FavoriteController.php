<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\Favorite;
use App\Http\Requests\AddFavoriteRequest;

class FavoriteController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with('product')->get();

        $this->successResponse($favorites, __('messages.favorites_retrieved_successfully'));
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
