@extends('layout.app')
@section('content')
    <div class="row col-md-8 mx-auto bordered rounded shadow row justify-content-center ">
        <div class="row col-md-12 mt-3 mb-2 justify-content-center">
            <h3>Etat des échéances</h3>
        </div>
        <div class="row justify-content-center">
            @foreach ($etatEcheances as $etatEcheance)
                <div class="card {{ $etatEcheance->color }} mt-3 mb-3 mx-3">
                    <div class="card-header {{ $etatEcheance->color }}">
                        <p class="text-center">{{ $etatEcheance->numero }}</p>
                    </div>
                    <div class="card-body">
                        <p><b>Marque:</b> {{ $etatEcheance->marque }}</p>
                        <p><b>Modéle:</b>{{ $etatEcheance->modele }}</p>
                        <p><b>Echéance:</b> {{ $etatEcheance->echeance_nom }}</p>
                        <p><b>Debut validité:</b> {{ $etatEcheance->debut_validite }}</p>
                        <p><b>Fin validité:</b> {{ $etatEcheance->fin_validite }}</p>
                        <p>
                            @if ($etatEcheance->jour_restant > 0)
                            {{ $etatEcheance->jour_restant }}
                            @else
                                0
                            @endif jour(s) restant
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
