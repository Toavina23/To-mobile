@extends('layout.app')
@section('content')
    <div class="row col-md-8 bordered shadow rounded mx-auto justify-content-center p-5">
        <form class="col-md-6" action="{{route('all.enregistrer_type_echeance')}}" method="POST">
            @csrf
            <h1 class="text-center mb-4">Ajout type écheance</h1>
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
                <label for="echeance">Nom de l'écheance</label>
                <input type="text" class="form-control" name="echeance" id="echeance">
            </div>
            <button type="submit" class="btn btn-primary form-control">Enregistrer</button>
        </form>
    </div>
@endsection