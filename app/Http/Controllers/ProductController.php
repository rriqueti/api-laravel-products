<?php

namespace App\Http\Controllers;

use App\Interfaces\ProductInterface;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    protected $product;
    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return $this->product->index();
    }

    public function create(ProductRequest $request) 
    {
        return $this->product->create($request);
    }

    public function update(ProductRequest $request)
    {
        ProductJob::dispatch($this->product, $request);

        return response()->json(['message' => 'Alteração dos dados foi enviada']);
        // return $this->product->update($request);
    }

    public function delete(ProductRequest $request)
    {
        return $this->product->delete($request);
    }
}
