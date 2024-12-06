@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-start align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg mr-2">Modifier mon profil</a>
                    <a href="{{ route('enfant.index') }}" class="btn btn-primary btn-lg">Mes Enfants</a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <a href="{{ route('enfant.create') }}" class="card shadow-sm text-center py-5 bg-success text-white rounded">
                                <h5 class="mb-0">+ Ajouter un Enfant</h5>
                            </a>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($children as $child)
                        <div class="col">
                            <a href="{{ route('enfant.edit', $child->id) }}" class="text-decoration-none">
                                <div class="card shadow-sm border-0 rounded h-100 bg-white">
                                    <img src="{{ $child->photo ? asset('storage/' . $child->photo) : asset('storage/No_image.png') }}"
                                        class="card-img-top rounded-circle mx-auto mt-3" alt="Photo de l'enfant"
                                        style="width: 100px; height: 100px; object-fit: cover; cursor: pointer;">

                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $child->name }} {{ $child->last_name }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
