<?php

namespace App\Http\Controllers\Uploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadsController extends Controller
{
    public function upload(){
        return view("upload/add");
    }
}
