<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any("/teas","Ce\TeasController@token");
Route::any("/teas1","Ce\TeasController@token1");
Route::any("/teas2","Ce\TeasController@token2");
Route::any("/teas3","Ce\TeasController@token3");

//测Http解密
Route::get("/dec","Ce\DecController@dec");//对称
Route::any("/pubdec","Ce\DecController@pubdec");//非对称
Route::any("/signature","Ce\DecController@signature");//签名
Route::any("/privsign","Ce\DecController@privsign");//非对称签名

//...H5...
//登录
Route::get("/h5/login","H5User\UserController@login");
Route::post("/h5/logindo","H5User\UserController@logindo");
//注册
Route::get("/h5/register","H5User\UserController@register");
Route::post("/h5/regi_do","H5User\UserController@regi_do");