@extends('layout.app')
@section('content')
    <div class="row col-md-10 mx-auto justify-content-center mt-5 p-5 shadow rounded">
        <form action="{{ route('admin.create_vehicule') }}" method="POST" class="col-md-6 p-5">
            @csrf
            <h1 class="text-center">Nouveau véhicule</h1>
            <div class="form-group">
                @error('numero')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="numero">Numero</label>
                <input type="text" class="form-control" name="numero" id="numero">
            </div>
            <div class="form-group">
                @error('marque')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="marque">Marque du véhicule</label>
                <input type="text" class="form-control" name="marque" id="marque">
            </div>
            <div class="form-group">
                @error('modele')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="modele">Modèle</label>
                <input type="text" class="form-control" name="modele" id="modele">
            </div>
            <div class="form-group">
                @error('type')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @enderror
                <label for="type">Type du véhicule</label>
                <select class="form-control" name="type" id="type">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type_nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary form-control">Enregister</button>
        </form>
    </div>
@endsection
