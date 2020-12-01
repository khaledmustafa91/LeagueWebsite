<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;
    protected $fillable = ["Name"];
    public $timestamps = false;

    public function player(){
        return $this->belongsToMany('App\Models\Player');
    }
//    public function club(){
//        return $this->belongsToMany('App\Models\Club');
//    }

//    public function leagueInfo(){
//        return $this->belongsTo('App\Models\leagueInfo');
//    }
}
