@extends('layout.app')
@section('content')
    <div class="row col-md-8 bordered shadow rounded mx-auto justify-content-center p-5">
        <form class="col-md-6" action="{{route('all.enregistrer_maintenance')}}" method="POST">
            @csrf
            <h1 class="text-center mb-4">Ajout maintenance</h1>
            <div class="form-group">
                @error('maintenance')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="maintenance">Type de maintenance</label>
                <select class="form-control" name="maintenance" id="maintenance">
                    @foreach ($typeMaintenances as $typeMaintenance)
                        <option value="{{ $typeMaintenance->id }}">{{ $typeMaintenance->nom_maintenance }}</option>
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
                @error('dateMaintenance')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="dateMaintenance">Date maintenance</label>
                <input type="datetime-local" class="form-control" name="dateMaintenance" id="dateMaintenance">
            </div>
            
            <button type="submit" class="btn btn-primary form-control">Enregistrer</button>
        </form>
    </div>
@endsection