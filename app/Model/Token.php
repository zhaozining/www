<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Token;

class Token extends Model
{
    public $table="token";
    protected  $primaryKey="id";
    public $timestamps=false;
    protected  $fillable=["token","time","user_id"];
}
