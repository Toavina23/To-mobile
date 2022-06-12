@extends('layout.app')
@section('content')
<div class="row col-md-8 mx-auto bordered rounded shadow row justify-content-center ">
    <div class="row col-md-12 mt-3 mb-2 justify-content-center">
        <h3>Etat des maintenances</h3>
    </div>
    <div class="row justify-content-center">
        @foreach ($etatMaintenances as $etatMaintenance)
            <div class="card {{ $etatMaintenance->color }} mt-3 mb-3 mx-3">
                <div class="card-header {{ $etatMaintenance->color }}">
                    <p class="text-center">{{ $etatMaintenance->numero }}</p>
                </div>
                <div class="card-body">
                    <p><b>Marque:</b> {{ $etatMaintenance->marque }}</p>
                    <p><b>Modéle:</b>{{ $etatMaintenance->modele }}</p>
                    <p><b>Maintenance:</b> {{ $etatMaintenance->nom_maintenance }}</p>
                    <p>{{ $etatMaintenance->km_restant }} kilomètre(s) restant</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection