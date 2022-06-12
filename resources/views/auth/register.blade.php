<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Se connecter</title>
</head>

<body>
    <div style="height: 100vh;" class="container-fluid d-flex justify-content-center align-items-center login-view">
        <div class="row col-md-6">
            {{-- <div class="col-md-6">
                <h1>Se connecter</h1>
                <h3>Bienvenu sur notre page de connexion</h3>
            </div> --}}
            <div class="col-md-6 border rounded p-3 shadow login-form mx-auto">
                @forelse ($errors as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ $error }}</strong>
                    </div>
                @empty
                @endforelse
                <form action="/register" method="post" class="mb-2">
                    @csrf
                    <div class="row justify-content-center mb-2 mt-3">
                        <img src="{{ asset('images/laravel.png') }}" alt="logo" class="w-25">
                    </div>
                    <div class="form-group form-comp">
                        {{-- <label for="email">Email</label> --}}
                        <input type="text" name="name" id="nom" class="form-control" placeholder="Nom">
                    </div>
                    <div class="form-group form-comp">
                        {{-- <label for="email">Email</label> --}}
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group form-comp">
                        {{-- <label for="password">Mot de passe</label> --}}
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Mot de passe">
                    </div>
                    <div class="form-group form-comp">
                        {{-- <label for="password">Mot de passe</label> --}}
                        <input type="password" name="password_confirmation" id="passwordConf" class="form-control"
                            placeholder="Confirmer votre mot de passe">
                    </div>
                    <div class="form-group form-comp">
                        <button class="btn btn-primary w-100 " type="submit">S'inscrire</button>
                    </div>
                    <hr>
                    <div class="form-group form-comp d-flex justify-content-left ">
                        <a name="" id="" class="w-75 p-2" href="/login" role="button">
                            vous avez déja un compte? Se connecter
                        </a>
                        {{-- <span class="btn btn-success w-75 p-2"></span> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-slim-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>