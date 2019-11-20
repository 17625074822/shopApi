<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/navs','NavController');
Route::apiResource('/categories','CategoryController');
Route::apiResource('/products','ProductController');
Route::apiResource('/tags','TagController');
Route::apiResource('/skus','SkuController');
