<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueInfo extends Model
{
    use HasFactory;

    public function league(){
        return $this->hasMany('App\Models\League');
    }
    public function player(){
        return $this->hasMany('App\Models\Player');
    }
    public function club(){
        return $this->hasMany('App\Models\Club');
    }
    
}
