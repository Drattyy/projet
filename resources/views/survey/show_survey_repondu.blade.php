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
                <p class="mb-0  font-italic">Destiné à {{$survey->promotion->name}}.</p>
            </div>
        </div>

        <br>

        @foreach($survey->responses as $response)
            <div class="list-group ">
                <div class="border-0 rounded-0 list-group-item flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1 text-dark">{{$response->response}}</p>
                    </div>
                    <div class="progress">
                        <span class="rounded-0 badge badge-dark">{{$response->id}}</span>
                        <div class=" progress-bar bg-dark" role="progressbar" style="width: 25%;"  aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach

        <br>
    </div>
@endsection