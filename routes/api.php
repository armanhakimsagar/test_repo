<?php

use Illuminate\Http\Request;
use App\ap;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('departments', function() {
    
    $department = ap::all();
    if(count($department) == 0){
       $feedback = [
           'status'     => "error",
           'message'    => "data not found",
           'data'       => null
        ]; 
       
    }else{
        $feedback = [
           'status'     => "success",
           'message'    => "data found",
           'data'       => $department
        ]; 
    }
    
    return $feedback;
    
});

Route::post('ap','apc@post');

Route::put('apUp/{id}','apc@update');

Route::delete('apUp/{id}','apc@delete');