<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Requests\CartRequest;
use App\Traits\ApiResponse;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    use ApiResponse;
    public function cart()
    {
        $user = auth()->user();
        $cartItems = $user->cart()
            ->with([
                'productVariant.product.category',
                'productVariant.product.images.color',
                'productVariant.color',
                'productVariant.size',
            ])
            ->get();
        return $this->successResponse(CartResource::collection($cartItems), __('messages.cart_retrieved_successfully'));
    }


    public function addToCart(CartRequest $request)
    {
        // dd($request->validated());

        Cart::create($request->validated() + [
            'user_id' => auth()->id()
        ]);

        return $this->successMessage(
            __('messages.product_added_to_cart_successfully')
        );
    }

    public function removeFromCart($id)
    {
        $user = auth()->user();
        $cartItem = Cart::where('user_id', $user->id)->where('id', $id)->first();
        if (!$cartItem) {
            return $this->errorResponse(__('messages.cart_item_not_found'), 404);
        }
        $cartItem->delete();

        return $this->successMessage(__('messages.product_removed_from_cart_successfully'));
    }
}
