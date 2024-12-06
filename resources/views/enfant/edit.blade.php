@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('enfant.index') }}" class="btn btn-outline-primary btn-lg">Retour à la liste</a>
                    <a href="{{ route('enfant.create') }}" class="btn btn-primary btn-lg">Ajouter un Enfant</a>
                </div>

                <div class="card-body">
                    <h4 class="text-primary">INFORMATION DE BASE</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ $child->photo ? asset('storage/' . $child->photo) : asset('storage/No_image.png') }}" 
                            alt="Profile Image" 
                            class="rounded-circle mr-4" 
                            width="200" height="200">

                        <div>
                            <h6 class="mb-3">Photo de profil</h6>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm" id="replacePhotoBtn">Remplacer</button>
                                <form action="{{ route('enfant.deletePhoto', $child->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                                    <form action="{{ route('enfant.updatePhoto', $child->id) }}" method="POST" enctype="multipart/form-data" id="imageUploadForm">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="photo" id="photoInput" class="d-none" accept="image/*">
                                    <button type="submit" class="d-none" id="submitPhotoBtn">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('enfant.update', $child->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="childName"><strong>Nom</strong></label>
                                    <input type="text" class="form-control" id="childName" name="name" value="{{ $child->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="childLastName"><strong>Prénom</strong></label>
                                    <input type="text" class="form-control" id="childLastName" name="last_name" value="{{ $child->last_name }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="childBirthday"><strong>Date de Naissance</strong></label>
                                    <input type="date" class="form-control" id="childBirthday" name="birthday" value="{{ $child->birthday }}">
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Genre</strong></label>
                                    <div class="d-flex">
                                        <div class="form-check mr-4">
                                            <input class="form-check-input" type="radio" name="gender" id="Garçon" value="Garçon" @if($child->gender === 'Garçon') checked @endif>
                                            <label class="form-check-label" for="Garçon">Garçon</label>
                                        </div>
                                        <div class="form-check mr-4">
                                            <input class="form-check-input" type="radio" name="gender" id="Fille" value="Fille" @if($child->gender === 'Fille') checked @endif>
                                            <label class="form-check-label" for="Fille">Fille</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="Autre" value="Autre" @if($child->gender === 'Autre') checked @endif>
                                            <label class="form-check-label" for="Autre">Autre</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('enfant.index') }}" class="btn btn-secondary mr-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
                
                <div class="card-body">
                    <h4 class="text-primary mb-4">LES RÉSEAUX SOCIAUX DE {{ Str::upper($child->last_name) }}</h4>
                
                    <form action="{{ route('reseaux.store', $child->id) }}" method="POST">
                        @csrf
                        <div class="row g-3" id="reseaux-list">
                            @foreach ($child->reseauxSociaux as $reseau)
                                <div class="col-md-6">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="card-title text-center text-uppercase text-secondary">{{ $reseau->name }}</h5>
                                            <div class="input-group">
                                                <form action="{{ route('reseaux.update', $reseau->id) }}" method="POST" class="w-100">
                                                    @csrf
                                                    @method('PUT')
                                                    <input 
                                                        type="text" 
                                                        name="url" 
                                                        value="{{ old('url', $reseau->url) }}" 
                                                        class="form-control border-primary shadow-sm"
                                                        placeholder="Nom d'utilisateur"
                                                    >
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-primary shadow-sm ms-2"
                                                    >
                                                        <i class="bi bi-save"></i> Enregistrer
                                                    </button>
                                                </form>
                
                                                <form action="{{ route('reseaux.delete', $reseau->id) }}" method="POST" class="d-inline" 
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce réseau social ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger shadow-sm ms-2">
                                                        <i class="bi bi-trash"></i> Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                
                    <div class="mt-4">
                        <button 
                            type="button" 
                            class="btn btn-outline-secondary shadow-sm" 
                            id="add-reseau-button"
                            onclick="addRéseau()"
                        >
                            Ajouter un nouveau réseau
                        </button>
                    </div>
                </div>
                
                
                
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('replacePhotoBtn').addEventListener('click', function() {
        document.getElementById('photoInput').click(); 
    });

    document.getElementById('photoInput').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            document.getElementById('submitPhotoBtn').click(); 
        }
    });
    
</script>
<script>
    document.getElementById('add-reseau-button').addEventListener('click', function() {
        const listContainer = document.getElementById('reseaux-list');

        const newRéseau = document.createElement('div');
        newRéseau.classList.add('col-md-6');
        newRéseau.innerHTML = `
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title text-center text-uppercase text-secondary">Nouveau Réseau</h5>
                    <div class="input-group">
                        <input 
                            type="text" 
                            name="new_reseaux[][name]" 
                            class="form-control border-primary shadow-sm" 
                            placeholder="Nom du réseau (e.g., LinkedIn)"
                        >
                        <input 
                            type="text" 
                            name="new_reseaux[][url]" 
                            class="form-control border-primary shadow-sm ms-2" 
                            placeholder="URL"
                        >
                    </div>
                </div>
            </div>
        `;

        listContainer.appendChild(newRéseau);
    });
</script>

@endsection
