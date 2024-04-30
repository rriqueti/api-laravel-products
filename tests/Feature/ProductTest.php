<?php

namespace Tests\Feature;


use Database\Factories\ProductFactory;
use Tests\TestCase;

class ProductTest extends TestCase
{

    protected $token = ['Authorization' => 'Bearer 13|XUszKnaiecVl6YZyEgR51bMI6DgMQtfi6oLHJja6be20a0ab'];
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
        $request = ProductFactory::create();

        $resposne = $this->post('/api/create/product', 
        $this->token,
        $request->all()
        )->assertStatus(200);
    }
}
