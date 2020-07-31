<?php

namespace App\Http\Controllers\Ce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DecController extends Controller
{
    public function dec(Request $request)
    {

        $data=$request->get("data");

        $data2=base64_decode($data);

        $method="AES-256-CBC";
        $privatekey="sing";
        $iv="qqqqwwwweeeerrrr";
        $contents=openssl_decrypt($data2,$method,$privatekey,OPENSSL_RAW_DATA ,$iv);
        echo $contents;

    }

    public function pubdec(){
        $data=file_get_contents('php://input');
        $key=file_get_contents(storage_path("secretKey/api_pub.key"));
        $prikey=openssl_get_publickey($key);
        // echo $prikey;die;
        openssl_public_decrypt($data,$datas,$prikey);
//        echo $datas;
//        echo "<br>";



        //回复
        $data2="淡淡的秋波，可是传达着谁的情谊";
        $key2=file_get_contents(storage_path("secretKey/api_pub.key"));
        $prikey2=openssl_get_publickey ($key2);
        // echo $prikey;die;
        openssl_public_encrypt($data2,$data2s,$prikey2);

        echo $data2s;

    }

    public function signature(){
        $data=request()->get("data");
        $sign=request()->get("sign");
        //echo $data;die;
        $key="api";
        $sign_dec=md5($key.$data);
        if($sign==$sign_dec){
            echo "ok";
        }else{
            echo "fack";
        }
    }

    public function privsign(){

        $data=request()->get('data');
        $signs=request()->get('sign');
        $key="api";
        $keypub=file_get_contents(storage_path("secretKey/api_pub.key"));
        $keypubs=openssl_get_publickey($keypub);
        $sign=openssl_public_decrypt($key.$data,$datas,$keypubs);
       // echo $datas;

        if($signs==$sign){
            echo "OK";
        }else{
            echo "Fack";
        }
    }


}
