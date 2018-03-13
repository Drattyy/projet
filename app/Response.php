<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = ['user_id'];

    public function survey() {
        return $this->belongsTo('App\Survey');
    }
}
