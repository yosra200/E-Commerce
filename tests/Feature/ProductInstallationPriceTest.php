<?php

namespace Tests\Feature;

use App\Http\Resources\prouductResource;
use App\Models\Product;
use Tests\TestCase;

class ProductInstallationPriceTest extends TestCase
{
    public function test_product_resource_includes_installation_price(): void
    {
        $product = new Product([
            'name' => ['ar' => 'منتج', 'en' => 'Product'],
            'description' => ['ar' => 'وصف', 'en' => 'Description'],
            'category_id' => 1,
            'price' => 100,
            'compare_price' => 120,
            'installation_price' => 45.5,
            'sku' => 'SKU-001',
            'is_active' => true,
        ]);

        $payload = (new prouductResource($product))->resolve();

        $this->assertSame(45.5, $payload['installation_price']);
    }
}
