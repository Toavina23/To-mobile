@extends('layout.app')
@section('content')
    <div class="row col-md-8 shadow rounded justify-content-center mx-auto p-5">
        <form action="{{ route('chauffeur.create_trajet') }}" method="POST" class="col-md-8">
            @csrf
            <h3 class="text-center mb-4">Nouveau trajet</h3>
            <div class="form-group">
                @error('lieuDepart')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="lieuDepart">Lieu de départ<span style="color: red">*</span></label>
                <select id="lieuDepart" name="lieuDepart" class="form-control">
                    @foreach ($lieus as $lieu)
                        <option value="{{ $lieu->id }}" {{ old('lieuDepart') == $lieu->id ? "selected" : "" }}>{{ $lieu->lieu_nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @error('dateDepart')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="dateDepart">Date de départ<span style="color: red">*</span></label>
                <input type="datetime-local" class="form-control" name="dateDepart" id="dateDepart" value="{{ old('dateDepart') }}">
            </div>
            <div class="form-group">
                @error('kilometrageDep')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="kilometrageDep">Kilométrage de départ<span style="color: red">*</span></label>
                <input type="number" class="form-control" name="kilometrageDep" id="kilometrageDep" value="{{ old('kilometrageDep') }}">
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
                <label for="vehicule">Véhicule utilisé<span style="color: red">*</span></label>
                <select class="form-control" name="vehicule" id="vehicule">
                    @foreach ($vehicules as $vehicule)
                        <option value="{{ $vehicule->id }}" {{old('vehicule') == $vehicule->id ? "selected" : ""}}>{{ $vehicule->numero }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @error('motif')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="motif">Motif<span style="color: red">*</span></label>
                <input type="text" class="form-control" name="motif" id="motif" value="{{ old('motif') }}">
            </div>
            <div class="form-group">
                @error('montantCarburant')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="montantCarburant">Montant carburant</label>
                <input type="number" step=".0001" class="form-control" name="montantCarburant" id="montantCarburant" value="{{ old('montantCarburant') }}">
            </div>
            <div class="form-group">
                @error('quantiteCarburant')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="quantiteCarburant">Quantite de carburant</label>
                <input type="number" step=".0001" class="form-control" name="quantiteCarburant" 
                    id="motquantiteCarburantif" value="{{ old('quantiteCarburant') }}">
            </div>
            <button type="submit" class="btn btn-primary form-control">Enregistrer</button>
        </form>
    </div>
@endsection
