<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    public function leagueInfo(){
        return $this->belongsTo('App\Models\leagueInfo');
    }
}
