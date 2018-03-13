@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/survey/" type="button" class="btn btn-secondary btn-sm mb-3"><i class="fas fa-arrow-left"></i> Retour</a>

        <br>

        <div class="list-group ">
            <div class="border-0 rounded-0 list-group-item flex-column align-items-start ">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 text-primary">{{$survey->question}}</h5>
                </div>
                <br>
                <p class="mb-1">{{$survey->description}}</p>
                <br>
                <p class="mb-0 blockquote-footer">Par  {{ $survey->user->firstName }} {{$survey->user->lastName}}, le {{$survey->created_at->addHour(1)->format('j F Y \\à h\\hi')}}.</p>
                <p class="mb-0  font-italic">Destiné à {{$survey->promotion->name}}</p>
            </div>
        </div>

        <br>

        <form action="{{route('answered_survey', 'id' => $survey_id)}}" method="POST">

            @foreach($survey->responses as $response)
                <div class="border-left-0 border-right-0 border-dark rounded-0 list-group-item list-group-item-action">
                    <input type="radio" name="selectedResponse" value="{{$response->id}}">
                    {{$response->response}}
                </div>
            @endforeach

            <hr>
            <button type="submit" class="btn btn-primary">Valider votre réponse</button>
        </form>

    </div>
@endsection
