<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;s
use App\Models\Order;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ApiResponse;

    public function orderSummary()
    {
        $cartItems = Cart::query()
            ->where('user_id', auth()->id())
            ->with('productVariant.product')
            ->get();

        $subtotal = 0.0;
        $discount = 0.0;

        foreach ($cartItems as $cartItem) {
            $variant = $cartItem->productVariant;
            $product = $variant->product;
            $unitPrice = (float) ($variant->price ?? $product->price);
            $originalUnitPrice = max($unitPrice, (float) ($product->compare_price ?? $unitPrice));

            $subtotal += $originalUnitPrice * $cartItem->quantity;
            $discount += ($originalUnitPrice - $unitPrice) * $cartItem->quantity;
        }

        $shipping = 0.0;
        $total = $subtotal - $discount + $shipping;

        return $this->successResponse([
            'items_count' => $cartItems->sum('quantity'),
            'subtotal' => round($subtotal, 2),
            'discount' => round($discount, 2),
            'shipping' => $shipping,
            'total' => round($total, 2),
        ], __('messages.order_summary_retrieved_successfully'));
    }

    public function store()
    {
        $user = auth()->user();

        $order = DB::transaction(function () use ($user) {
            $cartItems = $user->cart()
                ->with('productVariant.product')
                ->lockForUpdate()
                ->get();

            if ($cartItems->isEmpty()) {
                return null;
            }

            $subtotal = 0.0;
            $discount = 0.0;
            $items = [];

            foreach ($cartItems as $cartItem) {
                $variant = $cartItem->productVariant;
                $product = $variant->product;
                $unitPrice = (float) ($variant->price ?? $product->price);
                $originalUnitPrice = max($unitPrice, (float) ($product->compare_price ?? $unitPrice));

                $subtotal += $originalUnitPrice * $cartItem->quantity;
                $discount += ($originalUnitPrice - $unitPrice) * $cartItem->quantity;

                $items[] = [
                    'product_variant_id' => $variant->id,
                    'product_name' => is_array($product->name)
                        ? ($product->name['ar'] ?? $product->name['en'] ?? '')
                        : $product->name,
                    'sku' => $variant->sku ?? $product->sku,
                    'unit_price' => $unitPrice,
                    'quantity' => $cartItem->quantity,
                    'total' => $unitPrice * $cartItem->quantity,
                ];
            }

            $shipping = 0.0;
            $order = $user->orders()->create([
                'status' => 'pending',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'total' => $subtotal - $discount + $shipping,
            ]);

            $order->items()->createMany($items);
            $user->cart()->delete();

            return $order->load('items');
        });

        if (! $order) {
            return $this->errorResponse(__('messages.cart_is_empty'), 422);
        }

        return $this->successResponse($order, __('messages.order_created_successfully'), 201);
    }

    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('items')
            ->latest()
            ->get();

        return $this->successResponse($orders, __('messages.orders_retrieved_successfully'));
    }
}
