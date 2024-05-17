<?php

namespace Tests\Feature;


use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Faker\Factory as ProductFactoryFaker;

class ProductTest extends TestCase
{  

    /**
     *
     */
    public function test_index_route_products_authenticate(): void
    {


        Sanctum::actingAs(User::factory()->create());

        $response = $this->get('/api/index/product')
        ->assertStatus(200);

        DB::rollBack();
    }

    public function test_index_route_products_unauthorized(): void
    {
        $response = $this->get('/api/index/product')
        ->assertStatus(500);
    }

    public function test_create_route_products(): void
    {
        $factoryProduct = ProductFactoryFaker::create();

        Sanctum::actingAs(User::factory()->create());

        $request = [
            'name' => $factoryProduct->name,
            'description' => $factoryProduct->sentence,
            'price' => $factoryProduct->randomFloat(2, 10, 100),
            'status' => $factoryProduct->randomElement([0, 1]),
            'stocky_quantity' => $factoryProduct->numberBetween(1, 100),
        ];

        $response = $this->post('/api/create/product', 
        $request)
        ->assertStatus(201);

        DB::rollBack();
    }

    public function test_update_route_products(): void
    { 
        Sanctum::actingAs(User::factory()->create());

        $factoryProduct = Product::factory()->create();

        $idProduct = DB::table('products')->select('id')->get();

        $request = [
            // 'id' => 3,
            'id' => $factoryProduct->randomElement($idProduct),
            'status' => $factoryProduct->randomElement([0, 2]),
            'stocky_quantity' => $factoryProduct->numberBetween(1, 100),
        ];

        $response = $this->put('/api/update/product', 
        $request)
        ->assertStatus(200);
    }

    public function test_delete_route_products(): void
    {
        $factoryProduct = ProductFactoryFaker::create();

        $idProduct = Product::all()->value('id');

        Sanctum::actingAs(User::factory()->create());

        $request = [
            'id' => $factoryProduct->randomElement([$idProduct]),
        ];

        $response = $this->delete('/api/delete/product', 
        $request)
        ->assertStatus(200);
    }


}
