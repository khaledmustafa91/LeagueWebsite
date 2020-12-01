<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ["Name"];
    public $timestamps = false;
//    public function leagueInfo(){
//        return $this->belongsTo('App\Models\leagueInfo');
//    }
    public function league(){
        return $this->belongsToMany('App\Models\League');
    }
    public function club(){
        return $this->belongsToMany('App\Models\Club');
    }
}
