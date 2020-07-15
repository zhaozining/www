<?php

namespace App\Http\Controllers\Ce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeasController extends Controller
{
    public function token(){
        $appid="wxf4d9c5b635f41270";
        $appsecret="f85271c0ca76f71cdcfe5e2a96f3c29b";
        $access_token="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        $content=file_get_contents($access_token);
        echo "$content";
    }
}
