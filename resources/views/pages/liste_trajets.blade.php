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
                    <div class="col-md-12 table-responsive custom-table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Voiture</th>
                                    <th scope="col">Motif</th>
                                    <th scope="col">Date de départ</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trajets as $trajet)
                                    <tr scope="row">
                                        <td>{{ $trajet->vehicule->numero }}</td>
                                        <td class="text-right">{{ $trajet->motif }}</td>
                                        <td class="text-right">{{ $trajet->date_depart }}</td>
                                        <td class="text-center">
                                            <a href="{{route('chauffeur.show_trajet', ['id' => $trajet->id])}}" class="btn btn-primary mx-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <div class="row justify-content-end mt-4 p-3">
                        {{ $trajets->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
