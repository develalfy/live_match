<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'first_team_id',
        'second_team_id',
        'first_team_score',
        'second_team_score',
    ];
}
