<?php

namespace App\Http\Controllers\H5User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //登录
    public function login(){
        return view('h5user/login');
    }

    public function logindo(){
        //echo 111;die;
        $name=request()->get('name');
        $pwd=request()->get('pwd');
        $data=[
            'name'=>$name,
            'pwd'=>$pwd
        ];

        $url="http://api.1911.com/h5/logindo";

        $ch = curl_init();// 创建一个新cURL资源
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

        $content=curl_exec($ch);// 抓取URL并把它传递给浏览器
        curl_close($ch);// 关闭cURL资源，并且释放系统资源
        echo $content;

        $content=json_decode($content,true);
        //dd($content);
       if($content['error'] == 0){
            $token=$content['token'];
           //echo 111;die;
            return redirect("http://www.1911.com/h5/conter?token=".$token);
        }else{
            print_r($content);
            return redirect("h5/login");
      }
    }

    //注册
    public function register(){
        return view('h5user/register');
    }

    public function regi_do()
    {

        //echo 111;die;
        $name = request()->get('name');
        $email = request()->get('email');
        $pwd = request()->get('pwd');
        $data = [
            'name' => $name,
            'pwd' => $pwd,
            'email' => $email
        ];

        $url = "http://api.1911.com/h5/register";

        $ch = curl_init();// 创建一个新cURL资源
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $content = curl_exec($ch);// 抓取URL并把它传递给浏览器
        curl_close($ch);// 关闭cURL资源，并且释放系统资源
        echo $content;

        $content=json_decode($content,true);
        //dd($content);
        if($content['error'] == 0){
            return redirect("h5/login");
        }else{
            print_r($content);
            return redirect("h5/register");
        }

    }

    //个人中心
    public function conter(){

        $token = request()->get('token');
        $url = "http://api.1911.com/h5/conter";
        $data=['token'=>$token];

        $ch = curl_init();// 创建一个新cURL资源
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $content = curl_exec($ch);// 抓取URL并把它传递给浏览器
        curl_close($ch);// 关闭cURL资源，并且释放系统资源
        echo $content;

        $content=json_decode($content,true);
        //dd($content);
        if($content['error'] == 0){
            return redirect("h5/conters");
        }else{
            print_r($content);
            return redirect("h5/login");
        }
    }

    public function conters(){
        return view("h5user/conter");
    }
}
