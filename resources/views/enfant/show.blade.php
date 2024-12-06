@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Profil de l'Enfant</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>Nom:</strong>
                            <p class="mb-0">{{ $enfant->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Prénom:</strong>
                            <p class="mb-0">{{ $enfant->last_name }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>Date de Naissance:</strong>
                            <p class="mb-0">{{ \Carbon\Carbon::parse($enfant->birthday)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Genre:</strong>
                            <p class="mb-0">{{ ucfirst($enfant->gender) }}</p>
                        </div>
                    </div>

                    @if($enfant->photo)
                        <div class="row mb-4">
                            <div class="col-md-12 text-center">
                                <strong>Photo:</strong><br>
                                <img src="{{ asset('storage/' . $enfant->photo) }}" alt="Photo de l'enfant" class="img-fluid rounded-circle" width="150">
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('enfant.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-2">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
