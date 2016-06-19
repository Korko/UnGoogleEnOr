<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'text', 'slug'
    ];

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
