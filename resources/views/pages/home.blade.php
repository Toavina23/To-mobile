@extends('layout.app')
@section('content')
    <div class="col-md-10 mx-auto">
        @if (isset($trajets))
            <div class="card shadow mb-4 p-3">
                <div class="row card-header">
                    <div class="col-md-9">
                        <h5 style="color:#4e73df;">Liste de vos trajets</h5>
                        <a href="{{ route('chauffeur.ajout_trajet') }}" class="btn btn-info btn-sm mx-2">
                            <i class="fas fa-plus"></i> Nouveau
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($trajets as $trajet)
                            <div class="card rounded shadow bordered  mx-2 mt-4">
                                <div class="card-header">
                                    <p class="text-center">{{ $trajet->vehicule->numero }}</p>
                                </div>
                                <div class="card-body">
                                    <p><b>Motif: {{ $trajet->motif }}</b></p>
                                    <p><b>Date de départ:</b> {{ $trajet->date_depart }} </p>
                                    <a href="{{route('chauffeur.show_trajet', ['id' => $trajet->id])}}" class="btn btn-primary mx-2 form-control">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            
                        @endforelse
                    </div>
                    <div class="row justify-content-end mt-4 p-3">
                        {{ $trajets->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
