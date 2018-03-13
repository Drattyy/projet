@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" name="EdT" id="EdT" src="https://ade6-upmf-ro.grenet.fr/direct/?top=top&projectId=1&login=etudiant-IUT-Valence&password=iutval&resources=342"></iframe>
            </div>
        </div>
        <div class="col-lg-3">
            @if((Auth::user()->hasRole('Administrateur')) || (Auth::user()->hasRole('Professeur')))
                <div class="card mb-3">
                    <div class="card-header">Accès rapide</div>
                    <div class="card-body">
                        <a href="#" class="btn btn-primary btn-block">Ajout de notes</a>
                        <a href="#" class="btn btn-primary btn-block">Liste des étudiants</a>
                        <a href="/survey" class="btn btn-primary btn-block">Sondages</a>
                        <a href="#" class="btn btn-primary btn-block disabled">Absences</a>
                    </div>
                </div>
            @endif
                <div class="card mb-3">
                    <div class="card-header">Le dernier sondage</div>
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{$survey->question}}</h5>
                        <p class="text-truncate"> {{$survey->description}}</p>
                        <p class="blockquote-footer">{{ $survey->user->firstName }} {{$survey->user->lastName}}, il y a {{$survey->created_at->diffForHumans(null, true)}}</p>
                        <a class="btn btn-primary btn-block" href="/survey/show/{{$survey->id}}">Aller au sondage</a>
                    </div>
                    <!--div class="card-footer">
                        <a class="btn btn-primary btn-block" href="/survey/show/$survey->id}}">Aller au sondage</a>
                    </div-->
                </div>

                <div class="card mb-3">
                    <div class="card-header">Notifications</div>
                    <div class="card-body">
                        <p class="card-text">Nouvelle note ! - 12/01</p>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
