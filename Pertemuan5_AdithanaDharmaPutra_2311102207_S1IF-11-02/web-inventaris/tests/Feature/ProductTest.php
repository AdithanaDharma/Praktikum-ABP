<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_access_products()
    {
        $response = $this->get('/products');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_products()
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);
        $response->assertViewIs('product.index');
    }

    public function test_authenticated_user_can_create_product()
    {
        $user = \App\Models\User::factory()->create();

        $productData = [
            'name' => 'Buku Tulis',
            'description' => 'Buku tulis 38 lembar',
            'price' => 5000,
            'stock' => 100,
        ];

        $response = $this->actingAs($user)->post('/products', $productData);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', $productData);
    }

    public function test_authenticated_user_can_update_product()
    {
        $user = \App\Models\User::factory()->create();
        $product = \App\Models\Product::factory()->create([
            'name' => 'Pensil',
            'stock' => 50,
        ]);

        $updateData = [
            'name' => 'Pensil 2B',
            'description' => 'Pensil ujian',
            'price' => 2000,
            'stock' => 45,
        ];

        $response = $this->actingAs($user)->put('/products/' . $product->id, $updateData);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', $updateData);
    }

    public function test_authenticated_user_can_delete_product()
    {
        $user = \App\Models\User::factory()->create();
        $product = \App\Models\Product::factory()->create();

        $response = $this->actingAs($user)->delete('/products/' . $product->id);

        $response->assertRedirect('/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
