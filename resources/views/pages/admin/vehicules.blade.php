@extends('layout.app')
@section('content')
<div class="col-md-10 mx-auto">
    @if (isset($vehicules))
        <div class="card shadow mb-4 p-3">
            <div class="row card-header py-3">
                <div class="col-md-9">
                    <h5 style="color:#4e73df;">Liste des vehicules</h5>
                </div>
                <div class="row col-md-3 justify-content-end">
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12 table-responsive custom-table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th scope="col">Numéro vehicule</th>
                                <th scope="col">Marque</th>
                                <th scope="col">Modèle</th>
                                <th scope="col">Type</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicules as $vehicule)
                                <tr scope="row">
                                    <td>{{ $vehicule->numero }}</td>
                                    <td class="text-right">{{ $vehicule->marque }}</td>
                                    <td class="text-right">{{ $vehicule->modele }}</td>
                                    <td class="text-right">{{ $vehicule->type->type_nom }}</td>
                                    <td class="text-center">
                                        <a  href="{{route('admin.trajets_vehicule_pdf', ['id' => $vehicule->id])}}" class="btn btn-primary mx-2">
                                            <i class="fas fa-file-pdf"></i> PDF des trajets
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a  href="{{route('admin.chart-vehicule', ['id' => $vehicule->id])}}" class="btn btn-primary mx-2">
                                            <i class="fas fa-chart-line"></i> Statistiques kilométrage
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>

                    </table>
                </div>
                <div class="row justify-content-end mt-4 p-3">
                    {{ $vehicules->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection