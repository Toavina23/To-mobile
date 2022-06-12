@extends('layout.app')
@section('content')
    <div class="row col-md-8 shadow rounded justify-content-center mx-auto p-5">
        <form action="{{ route('chauffeur.update_trajet') }}" method="POST" class="col-md-8">
            @csrf
            <h3 class="text-center mb-4">Details du trajet</h3>
            <input type="hidden" name="id" value="{{ $trajet->id }}">
            <div class="form-group">
                <label for="dateDepart">Lieu de départ</label>
                <input type="text" class="form-control" name="" id="dateDepart"
                    value="{{ $trajet->lieuDepart->lieu_nom }}" disabled>
            </div>
            <div class="form-group">
                <label for="dateDepart">Date de départ</label>
                <input type="text" class="form-control" name="" id="dateDepart"
                    value="{{ $trajet->date_depart }}" disabled>
            </div>
            <div class="form-group">
                <label for="kilometrageDep">Kilométrage de départ</label>
                <input type="number" class="form-control" value="{{ $trajet->kilometrage_depart }}"
                    name="" id="kilometrageDep" disabled>
            </div>
            @if($trajet->lieuArrive)
            <div class="form-group">
                <label for="dateDepart">Lieu d'arrivé</label>
                <input type="text" class="form-control" name="" id="dateDepart"
                    value="{{ $trajet->lieuArrive->lieu_nom }}" disabled>
            </div>
            @else
            <div class="form-group">
                @error('lieuArrive')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="lieuArrive">Lieu d'arrivé<span style="color: red">*</span></label>
                <select id="lieuArrive" name="lieuArrive" class="form-control">
                    @foreach ($lieus as $lieu)
                        <option value="{{ $lieu->id }}">{{ $lieu->lieu_nom}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                @error('dateArrive')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="dateArrive">Date de d'arrivé</label>
                @if ($trajet->date_arrive)
                    <input type="text" name="" class="form-control" value="{{ $trajet->date_arrive }}" id="" disabled>
                @else
                    <input type="datetime-local" class="form-control" name="dateArrive" id="dateArrive">
                @endif
            </div>
            <div class="form-group">
                @error('kilometrageArr')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                @isset($kilometrageError)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    {{ $kilometrageError }}
                </div>
                @endisset
                <label for="kilometrageArr">Kilométrage à l'arrivé</label>
                <input type="number" class="form-control" name="kilometrageArr" id="kilometrageArr"
                    @if ($trajet->kilometrage_arrive) value="{{ $trajet->kilometrage_arrive }}" disabled @endif>
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
                <label for="vehicule">Véhicule utilisé</label>
                <input type="text" class="form-control" name="vehicule" id="vehicule"
                    value="{{ $trajet->vehicule->numero }}" disabled>
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
                <label for="motif">Motif</label>
                <input type="text" class="form-control" value="{{ $trajet->motif }}" name="motif" id="motif" disabled>
            </div>
            @if (!$trajet->date_arrive)
                <div class="form-group">
                    @error('montantCarburantSup')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="montantCarburantSup">Montant supplémentaire de carburant</label>
                    <input type="number" step=".0001" class="form-control" value="{{ $trajet->montant_carburant }}"
                        name="montantCarburant" id="montantCarburant" hidden>
                    <input type="number" step=".0001" class="form-control" name="montantCarburantSup"
                        id="montantCarburantSup">
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
                    <label for="quantiteCarburantSup">Quantite supplémentaire de carburant</label>
                    <input type="number" step=".0001" class="form-control" value="{{ $trajet->quantite_carburant }}"
                        name="quantiteCarburant" id="quantiteCarburant" hidden>
                    <input type="number" step=".0001" class="form-control" name="quantiteCarburantSup"
                        id="quantiteCarburantSup">
                </div>
                <button type="submit" class="btn btn-primary form-control">Mettre à jour</button>
            @else
                <div class="form-group">
                    <label for="montantCarburantSup">Montant de carburant total</label>
                    <input type="text" class="form-control" value="{{ $trajet->montant_carburant }} Ar" name=""
                        id="montantCarburant" disabled>
                </div>
                <div class="form-group">
                    <label for="quantiteCarburantSup">Quantite de carburant total</label>
                    <input type="text" class="form-control" value="{{ $trajet->quantite_carburant }} L" name=""
                        id="quantiteCarburant" disabled>
                </div>
            @endif
        </form>
    </div>
@endsection
