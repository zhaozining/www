<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //列表
    public function list1(){

        $url = "http://api.1911.com/h5/lists";

        $ch = curl_init();// 创建一个新cURL资源
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $content = curl_exec($ch);// 抓取URL并把它传递给浏览器
        curl_close($ch);// 关闭cURL资源，并且释放系统资源
      // dd($content);


      return view("h5goods/list",['data'=>$content]);
    }

    public function list2(){

    }

    //详情
    public function details(){
        return view("h5goods/deta");
    }

    public function deta(){

    }

    //购物车
    public function cart(){
        return view("h5goods/cart");
    }

    public function carts(){

    }
}
