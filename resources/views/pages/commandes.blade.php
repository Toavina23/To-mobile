@extends('layout.app')
@section('content')
    <div class="col-md-10 mx-auto">
        @if (isset($commands))
            <div class="card shadow mb-4 p-3">
                <div class="row card-header py-3">
                    <div class="col-md-9">
                        <h5 style="color:#4e73df;">Liste des commandes</h5>
                    </div>
                    <div class="row col-md-3 justify-content-end">
                        <a href="#" class="btn btn-info btn-sm mx-2">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                        <a href="#" class="btn btn-info btn-sm mx-2">
                            <i class="fas fa-file-excel"></i> EXCEL
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 table-responsive custom-table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Quantite</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($commands as $command)
                                    <tr scope="row">
                                        <td>{{ $command->produit }}</td>
                                        <td class="text-right">{{ $command->quantite }}</td>
                                        <td class="text-right">{{ $command->montant }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary mx-2">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-danger mx-2">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <div class="row justify-content-end mt-4 p-3">
                        {{ $commands->links() }}
                    </div>
                </div>
            </div>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                </div>
        @endif
    </div>
@endsection
