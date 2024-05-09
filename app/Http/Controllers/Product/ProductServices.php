<?php

namespace App\Http\Controllers\Product;

use App\Interfaces\ProductInterface;
use App\Http\Requests\ProductRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Product;


class ProductServices implements ProductInterface
{
    public function index()
    {   
        /*
        *Query database all products
        */
        $products = Product::all('id', 'name', 'status');

        /*
        If return query empty
        */
        if ($products->isEmpty()) 
        {
            return response()->json(Response::HTTP_NOT_FOUND);
        }

        /*
        If query sucess
        */
        return response()->json($products, Response::HTTP_OK);
        
    }
    public function create(ProductRequest $request)
    {
        
        try 
        {
            /*
            *Validate with rules ProductRequest
            */
            $validateData = $request->validated();
 
            /*
            *Create if has sucess validate
            */
            $request->user()->products()->create($validateData);

            return response()
                ->json('Criado com Sucesso', 
                        Response::HTTP_CREATED);
        }
        
        catch (\Exception $e)
        {  
            return response()
            ->json('Erro inesperado', 
                    Response::HTTP_BAD_REQUEST);
        }
         
    }

    public function update(ProductRequest $request)
    {
        try
        {
            $product = Product::find($request->id);

            /*
            *Validação via rules ProductRequest
            */
            $validateData = $request->validated();

            /*
            *Update se houve sucesso na validação
            */
            $product->update($validateData);

            return response()->json('Alterado com sucesso', Response::HTTP_OK);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
        
    }

    public function delete(ProductRequest $request)
    {
        /*
        *Delete request id
        */
        try
        {
            Product::where("id", $request->id)->delete();
            return response()->json("Dados Deletados", Response::HTTP_OK);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 500);
        }
        
    }
}