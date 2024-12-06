@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-start align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg mr-2">Modifier mon profil</a>
                    <a href="{{ route('enfant.index') }}" class="btn btn-outline-primary btn-lg">Mes Enfants</a>
                </div>
                <div class="text-center mt-4">
                    
                        <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-danger">Se déconnecter</button>
                    </form>
                </div>
                

                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('storage/No_image.png') }}" 
                            alt="Profile Image" 
                            class="rounded-circle mr-4" 
                            width="200" height="200">

                        <div>
                            <h6 class="mb-3">Votre photo de profil</h6>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm" id="replacePhotoBtn">Remplacer</button>
                                <form action="{{ route('profile.deletePhoto') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>                                
                                <form action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data" id="imageUploadForm">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="photo" id="photoInput" class="d-none" accept="image/*">
                                    <button type="submit" class="d-none" id="submitPhotoBtn">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('profile.updateProfile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"><strong>Nom</strong></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name"><strong>Prénom</strong></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"><strong>Adresse E-mail</strong></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birthday"><strong>Date de Naissance</strong></label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="{{ Auth::user()->birthday }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone"><strong>Téléphone</strong></label>
                                    <div class="input-group">
                                        <select id="countryCode" class="form-control" name="countryCode">
                                            <option value="+33" data-flag="fr">🇫🇷 +33</option>
                                            <option value="+1" data-flag="us">🇺🇸 +1</option>
                                            <option value="+44" data-flag="gb">🇬🇧 +44</option>
                                            <option value="+91" data-flag="in">🇮🇳 +91</option>
                                            <option value="+216" data-flag="tn">🇹🇳 +216</option>
                                        </select>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Numéro">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label><strong>Genre :</strong></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="parent1" value="parent1" 
                                            @if(Auth::user()->gender === 'parent1') checked @endif>
                                        <label class="form-check-label" for="parent1">Parent 1</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="parent2" value="parent2" 
                                            @if(Auth::user()->gender === 'parent2') checked @endif>
                                        <label class="form-check-label" for="parent2">Parent 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="text-center mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary mr-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
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
    fetch('countries.json')
        .then(response => response.json())
        .then(data => {
            populateCountryDropdown(data);
        })
        .catch(error => {
            console.error('Error loading country data:', error);
        });

    function populateCountryDropdown(countries) {
        const countrySelect = document.getElementById('countryCode');
        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country.code;
            option.dataset.flag = country.flag;
            option.textContent = `${country.flag} ${country.code} ${country.name}`;
            countrySelect.appendChild(option);
        });
    }
</script>

@endsection
