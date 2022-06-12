@extends('layout.app')
@section('content')
    <div class="col-md-8 mx-auto bordered rounded shadow row justify-content-center p-5">
        <form action="{{route('all.enregistrement_payement_echeance')}}" class="col-md-8" method="POST">
            @csrf
            <h1 class="text-center mb-4">Mise à jour echeance</h1>
            <div class="form-group">
                @error('echeance')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="echeance">Type écheance</label>
                <select class="form-control" name="echeance" id="echeance">
                    @foreach ($typeEcheances as $typeEcheance)
                        <option value="{{ $typeEcheance->id }}">{{ $typeEcheance->echeance_nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @error('vehicule')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="vehicule">Véhicule concerné</label>
                <select class="form-control" name="vehicule" id="vehicule">
                    @foreach ($vehicules as $vehicule)
                        <option value="{{ $vehicule->id }}">{{ $vehicule->numero }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @error('debutValidite')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="debutValidite">Debut de validité</label>
                <input type="date" class="form-control" name="debutValidite" id="debutValidite">
            </div>
            <div class="form-group">
                @error('finValidite')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="finValidite">Fin de validité</label>
                <input type="date" class="form-control" name="finValidite" id="finValidite">
            </div>
            <div class="form-group">
                @error('montant')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="montant">Montant payé</label>
                <input type="number" step=".001" class="form-control" name="montant" id="montant">
            </div>

            <button type="submit" class="btn btn-primary form-control">Enregistrer</button>
        </form>
    </div>
@endsection