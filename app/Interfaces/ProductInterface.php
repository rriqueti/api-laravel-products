<?php

namespace App\Interfaces;

use App\Http\Requests\ProductRequest;


interface ProductInterface
{
    public function index();

    public function create(ProductRequest $request);

    public function update(ProductRequest $request);

    public function delete(ProductRequest $request);
}
