<?php

namespace App\Http\Controllers\H5User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        //echo $content;

        $content=json_decode($content,true);
        //dd($content);
        if($content['error'] == 0){
            return redirect("h5/login");
        }else{
            print_r($content);
            return redirect("h5/register");
        }


    }

    public function conter(){
        $token = request()->get('token');
        if(empty($token)){
            $response=[
                'error'=>"50003",
                "msg"=>"Token不能为空"
            ];
        }

        $res = Token::where(['token' => $token])->first();
        $time=time()-$res['time'];
        //echo $time;die;
        if($time>7200){
            $response=[
                'error'=>50004,
                'msg'=>"Token已过期"
            ];
        }else{
            if ($res) {
                //获取用户信息
                $user = User::where(['user_id' => $res->user_id])->first();
                //签到
                $sign="sign_in";

                //访问量
                $count="counts";

                $response=[
                    'name'=>$user->name,
                    'error'=>0,
                    'msg'=>"个人中心",
                    'sing'=>Redis::zincrby($sign,time(),"ning"),
                    'count'=>Redis::hincrby($count,'count',1)
                ];
            }else{
                $response=[
                    'error'=>50002,
                    'msg'=>"用户信息获取失败"
                ];
            }
        }
        return $response;
    }
}
