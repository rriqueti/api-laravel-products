<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Tests\TestCase;
use Faker\Factory as ProductFactoryFaker;

class ProductTest extends TestCase
{

    protected $token = [
        'Authorization' => 'Bearer 5|gmmGasvGGMIsVmMnV5z8iaFzWPcDOHzpRwyQWjS53cad00fc',
];
    /**
     *
     */
    public function test_index_route_products_authenticate(): void
    {
        $response = $this->get('/api/index/product', $this->token)
        ->assertStatus(200);    
    }

    public function test_index_route_products_unauthorized(): void
    {
        $response = $this->get('/api/index/product')
        ->assertStatus(500);
    }

    public function test_create_route_products(): void
    {
        $factoryProduct = ProductFactoryFaker::create();

        $request = [
            'name' => $factoryProduct->name,
            'description' => $factoryProduct->sentence,
            'price' => $factoryProduct->randomFloat(2, 10, 100),
            'status' => $factoryProduct->randomElement([0, 1]),
            'stocky_quantity' => $factoryProduct->numberBetween(1, 100),
        ];

        $response = $this->post('/api/create/product', 
        $request, 
        $this->token)
        ->assertStatus(200);
    }

    public function test_update_route_products(): void
    {
        $factoryProduct = ProductFactoryFaker::create();

        $idProduct = Product::all()->value('id');

        $request = [
            'id' => $factoryProduct->randomElement([$idProduct]),
            'status' => $factoryProduct->randomElement([0, 2]),
            'stocky_quantity' => $factoryProduct->numberBetween(1, 100),
        ];

        $response = $this->put('/api/update/product', 
        $request, 
        $this->token)
        ->assertStatus(200);
    }

    public function test_delete_route_products(): void
    {
        $factoryProduct = ProductFactoryFaker::create();

        $idProduct = Product::all()->value('id');

        $request = [
            'id' => $factoryProduct->randomElement([$idProduct]),
        ];

        $response = $this->delete('/api/delete/product', 
        $request, 
        $this->token)
        ->assertStatus(200);
    }


}
