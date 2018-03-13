@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sondages</h1>
        @if((Auth::user()->isDelegate) || (Auth::user()->hasRole('Administrateur')) || (Auth::user()->hasRole('Professeur')))
            <a class="btn btn-primary" href="/survey/create" role="button">Nouveau sondage</a>
        @endif
        <hr>
        @foreach ($surveys as $survey)
            @if(($survey->promotion->id) == (Auth::user()->tpgroup->tdgroup->promotion->id) || (Auth::user()->hasRole('Administrateur')) || (Auth::user()->hasRole('Professeur')))

                <div class="list-group ">
                    <a href="/survey/show/{{$survey->id}}" class="border-left-0 border-right-0 border-bottom-0 border-dark rounded-0 list-group-item list-group-item-action flex-column align-items-start ">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 text-primary text-truncate">{{$survey->question}}</h5>
                            <small>Il y a {{$survey->created_at->diffForHumans(null, true)}}</small>
                        </div>
                        <p class="mb-1 text-truncate">{{$survey->description}}</p>
                        <small>Destiné à {{$survey->promotion->name}}, par {{ $survey->user->firstName }} {{$survey->user->lastName}}.</small>
                    </a>
                </div>
            @endif
        @endforeach
    </div>

@endsection
