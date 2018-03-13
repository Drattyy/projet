<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Response;
use App\Promotion;
use App\Semester;
use App\Tdgroup;
use App\Tpgroup;
use App\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::latest()->get();

        return view('survey/index_survey', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $destinataire_promotions = Promotion::with('tdgroups')->get();
        $destinataire_semesters = Semester::with("users")->get();
        $destinataire_tdgroups = Tdgroup::with("users")->get();
        $destinataire_tpgroups = Tpgroup::with("users")->get();


        return view('survey/create_survey', compact('destinataire_promotions','destinataire_semesters', 'destinataire_tdgroups', 'destinataire_tpgroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $survey = new Survey();
        $survey->question = $request->input('question');
        $survey->description = $request->input('description');
        $survey->promotion_id = $request->input('destinataire');
        //$survey->grouptd_id = $request->input('destinataire');
        //$survey->grouptp_id = $request->input('destinataire');
        $survey->endDate = Carbon::tomorrow();
        $survey->user_id = Auth::user()->id;
        $survey->save();

        $responses = collect(Input::get('reponse'));
        $responses->map(function ($value, $key) use ($survey) {
            $response = new Response();
            $response->survey_id = $survey->id;
            $response->response = $value;
            $response->save();
        });

        $responses_choisies = collect(Input::get('response_choisie'));
        $responses_choisies->map(function ($value, $key) use ($responses) {
            $response_choisie = new ResponseSurvey();
            $response_choisie->user_id = Auth::user()->id;
            $response_choisie->response_id = $responses->id;
            $response_choisie->save();
        });

        return redirect("/");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repondu = false;
        $survey = Survey::find($id);
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->firstOrFail();

        foreach ($user->responseSurvey as $s) {
          if ($s->response->survey->id == $survey->id) {
            $repondu = true;
          }
        }


        if($repondu == false){
            return view('survey/show_survey', compact('survey', 'repondu'));
        } else{
            return view('survey/show_survey_repondu', compact('survey', 'repondu'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
