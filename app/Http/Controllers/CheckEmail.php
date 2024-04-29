<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckEmail extends Controller
{
    
    public function login(Request $request)
    {

        if(Auth::attempt($request->only("email","password"))) 
        {

        $token = $request->user()->createToken('Authorization')->plainTextToken;

        return response()->json(
            ['Authorized', $token], 
            Response::HTTP_ACCEPTED,[$token]);
        }
        
        return response(
            'Not Authorized', 
            Response::HTTP_UNAUTHORIZED
            );  
    }

}
