@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/survey/" type="button" class="btn btn-secondary btn-sm mb-3"><i class="fas fa-arrow-left"></i> Retour</a>

        @if((Auth::user()->isDelegate) || (Auth::user()->hasRole('Administrateur')) || (Auth::user()->hasRole('Professeur')))
            <form method="POST" action="/survey">

                {{csrf_field()}}

                <div class="form-group">



                    <div class="my-1 mr-sm-2 {{ $errors->has('module') ? ' has-error' : ''}}" >
                        <select id="module_select" class="form-control" name="destinataire" required>
                            <option value="" selected disabled hidden>Choisissez un destinataire</option>
                            @foreach($destinataire_promotions as $destinataire)
                                <option value={{ $destinataire->id }}>{{ $destinataire->name }}</option>
                                @foreach($destinataire_semesters as $destinataire)
                                    <option value={{ $destinataire->id }}>{{ $destinataire->name }}</option>
                                @endforeach
                            @endforeach
                            @foreach($destinataire_tdgroups as $destinataire)
                                <option value={{ $destinataire->id }}>{{ $destinataire->name }}</option>
                            @endforeach
                            @foreach($destinataire_tpgroups as $destinataire)
                                <option value={{ $destinataire->id }}>{{ $destinataire->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <!--div class="my-1 mr-sm-2">
                        <select name="destinataire" class="custom-select form-control">
                            <option value="1">Destinataire</option>
                            <option value="2">Ensemble de l'IUT</option>
                            <option value="3">Promotion R&T 1</option>
                            <option value="4">Promotion R&T 2</option>
                            <option value="5">Promotion GEA 1</option>
                            <option value="6">Promotion GEA 2</option>
                            <option value="7">Promotion Info 1</option>
                            <option value="8">Promotion Info 2</option>
                            <option value="9">Promotion TC 1</option>
                            <option value="10">Promotion TC 2</option>
                        </select>
                    </div-->

                    <br>

                    <div class="my-1 mr-sm-2">
                        <input type="text" class="form-control" id="question" name="question" placeholder="Question" required>
                    </div>

                    <div class="my-1 mr-sm-2">
                        <textarea class="form-control" name="description" id="description" cols="25" rows="3" placeholder="(Optionnel) Description"></textarea>
                    </div>

                    <br>

                    <div class="my-1 mr-sm-2">
                        <div class="input-group">

                            <div class="input-group-append">
                                <input type="button" class="btn btn-dark rounded-left" id="decrementation_reponse" onclick="retirerChamp()" value="-">
                                <input type="button" class="btn btn-dark" id="incrementation_reponse" onclick="ajouterChamp()" value="+">
                                <input type="text" class="border-0 input-group-text" name="nb_reponse_total" id="nb_reponse_total" size="1" readonly>
                                <!--input type="text" class="border-0 input-group-text" size="1" value="/" disabled>
                                <input type="text" class="border-0 input-group-text" name="nb_reponse_max_choisi" id="nb_reponse_max_choisi" size="1" readonly>
                                <input type="button" class="btn btn-dark" id="decrementation_reponse" onclick="augmenterMax()" value="+">
                                <input type="button" class="btn btn-dark rounded-right" id="decrementation_reponse" onclick="diminuerMax()" value="-"-->
                            </div>

                        </div>

                    </div>

                    <div id="ajout" class="my-1 mr-sm-2">
                        <input type="text" class="form-control" name="reponse[]", id='id_reponse' placeholder="Réponse 1" required>
                        <input type="text" class="form-control" name="reponse[]", id='id_reponse' placeholder="Réponse 2" required>
                    </div>
                </div>

                <hr>

                <script>
                    var div_ajout, input_ajout, nouveau_champ;
                    var id_reponse = 3;
                    var nb_reponse_max_choisi = 0;
                    var nb_reponse_max = 30;

                    document.getElementById('nb_reponse_max_choisi').value = nb_reponse_max_choisi;
                    document.getElementById('nb_reponse_max').value = nb_reponse_max;
                    document.getElementById('nb_reponse_total').value = 1;

                    function ajouterChamp(){
                        div_ajout = document.getElementById("ajout");
                        input_ajout = div_ajout.getElementsByTagName("input");
                        nouveau_champ = document.createElement("input");

                        nouveau_champ.setAttribute("type", "text");
                        nouveau_champ.setAttribute("class", "form-control");
                        nouveau_champ.setAttribute("name", "reponse[]");
                        nouveau_champ.setAttribute("id", id_reponse);
                        nouveau_champ.setAttribute("placeholder", "Réponse " + id_reponse);
                        nouveau_champ.setAttribute("required", null);

                        if(id_reponse <= nb_reponse_max) {
                            div_ajout.appendChild(nouveau_champ);
                            nouveau_champ.style.display="block";

                            document.getElementById('nb_reponse_total').value = id_reponse;

                            id_reponse = id_reponse + 1;
                        }
                    }

                    function retirerChamp(){
                        if(input_ajout.length > 2){
                            if(id_reponse <= nb_reponse_max + id_reponse) {
                                div_ajout.removeChild(input_ajout[input_ajout.length - 1]);

                                id_reponse = id_reponse - 1;

                                document.getElementById('nb_reponse_total').value = id_reponse - 1;
                            }
                        }
                    }

                    /*
                    function augmenterMax(){
                        div_ajout = document.getElementById("ajout");
                        input_ajout = div_ajout.getElementsByTagName("input");

                        if(nb_reponse_max_choisi < nb_reponse_max) {
                            document.getElementById('nb_reponse_max_choisi').value = nb_reponse_max_choisi + 1;
                            nb_reponse_max_choisi = nb_reponse_max_choisi + 1;
                        }
                    }

                    function diminuerMax(){
                        div_ajout = document.getElementById("ajout");
                        input_ajout = div_ajout.getElementsByTagName("input");

                        if(nb_reponse_max_choisi <= nb_reponse_max) {

                            if(nb_reponse_max_choisi <= 0){
                                document.getElementById('nb_reponse_max_choisi').value = 0;
                            } else {
                                document.getElementById('nb_reponse_max_choisi').value = nb_reponse_max_choisi - 1;
                                nb_reponse_max_choisi = nb_reponse_max_choisi - 1;
                            }
                        }
                    }
                    */

                </script>


                <button type="submit" class="btn btn-primary">Valider votre sondage</button>

            </form>

        @else
            Vous n'avez pas accès à cette page
        @endif
    </div>

@endsection
