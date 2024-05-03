<?php

use App\Http\Controllers\CheckEmail;
use Illuminate\Support\Facades\Route;
use App\Models\User;   
use App\Interfaces\ProductInterface;
use App\Jobs\ExampleJob;


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
        [ProductInterface::class,"update"])->middleware('auth:sanctum');
    
    Route::delete("/delete/product", 
        [ProductInterface::class,"delete"])->middleware('auth:sanctum');
});
  
/**
 * Index users
 */
Route::get('/users', function () {
$users = User::all();
return response([$users],200);});

Route::get('/', function () {
    return view('welcome');
});

/*
*Auth Sanctum route
 */
Route::post('/login', [CheckEmail::class,'login']);


