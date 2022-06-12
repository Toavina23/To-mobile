@extends('layout.app')
@section('content')
<div class="row col-md-8 mx-auto bordered rounded shadow row justify-content-center ">
    <div class="row col-md-12 mt-3 mb-2 justify-content-center">
        <h3>Liste des véhicules disponnibles</h3>
    </div>
    <div class="row justify-content-center">
        @forelse($vehicules as $vehicule)
        <div class="card col-md-10 mt-3 mb-3 mx-3">
            <div class="card-header">
                <p class="text-center">{{ $vehicule->numero }}</p>
            </div>
            <div class="card-body">
                <p><b>Marque:</b> {{ $vehicule->marque }}</p>
                <p><b>Modéle:</b>{{ $vehicule->modele }}</p>
            </div>
        </div>
        @empty
            <h5 class="text-disabled mt-5 mb-5">Pas de véchicules disponnibles</h5>
        @endforelse 
    </div>
</div>
@endsection