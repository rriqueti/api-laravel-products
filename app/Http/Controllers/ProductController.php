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
        return $this->product->update($request);
    }

    public function delete(ProductRequest $request)
    {
        return $this->product->delete($request);
    }
}
