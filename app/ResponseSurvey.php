<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseSurvey extends Model
{
    public function responseUser() {
        return $this->belongsTo('App\User');
    }

    public function response() {
        return $this->belongsTo('App\Response');
    }
}
