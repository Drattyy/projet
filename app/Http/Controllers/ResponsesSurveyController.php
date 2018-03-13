<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponsesSurveyController extends Controller
{
    public function addResponse(Request $request) {
      $survey->question = $request->input('selectedResponse');
    }
}
