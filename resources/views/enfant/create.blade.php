@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h4><strong>Créer un Profil d'Enfant</strong></h4>
                </div>

                <div class="card-body p-5">
                    <form action="{{ route('enfant.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label"><strong>Nom de l'enfant</strong></label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" required placeholder="Entrez le nom de l'enfant">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="last_name" class="form-label"><strong>Prénom de l'enfant</strong></label>
                                <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" required placeholder="Entrez le prénom de l'enfant">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="birthday" class="form-label"><strong>Date de naissance</strong></label>
                                <input type="date" class="form-control form-control-lg" id="birthday" name="birthday" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="gender" class="form-label"><strong>Genre</strong></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="Garçon" value="Garçon" required>
                                    <label class="form-check-label" for="Garçon">Garçon</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="Fille" value="Fille" required>
                                    <label class="form-check-label" for="Fille">Fille</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="Autre" value="Autre" required>
                                    <label class="form-check-label" for="Autre">Autre</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 w-100">
                            <a href="{{ route('enfant.index') }}" class="btn btn-outline-secondary btn-lg">Annuler</a>
                            <button type="submit" class="btn btn-primary btn-lg">Enregistrer</button>
                        </div>
                        
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
