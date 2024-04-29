<?php

use App\Http\Controllers\CheckEmail;
use Illuminate\Support\Facades\Route;
use App\Models\User;   
use App\Interfaces\ProductInterface;


/*
* Products routes 
*/ 
Route::middleware('auth:sanctum')->group(function () 
{
    Route::get(
        "/index/product", 
        [ProductInterface::class,"index"])->middleware('auth:sanctum');
        
    Route::post(
        "/create/product",
        [ProductInterface::class,"create"])->middleware('auth:sanctum');
    
    Route::put("/update/product", 
        [ProductInterface::class,"update"]);
    
    Route::delete("/delete/product", 
        [ProductInterface::class,"delete"]);  
});
  

Route::get('/users', function () {
$users = User::all();
return response([$users],200);});

/*
*Auth Sanctum route
 */
Route::post('/login', [CheckEmail::class,'login']);
