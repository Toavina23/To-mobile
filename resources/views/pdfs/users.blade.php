<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <title>Liste des utilisateurs</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row col-md-8 mx-auto justify-content-center">
            <h1 class="text-center mb-5">Liste de utilisateurs</h1>
            <table class="table table-bordered table-info">
                <tr>
                    <th scope="col">Identifiant</th>
                    <th scope="col">Nom d'utilisateur</th>
                    <th scope="col">Email</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>

</html>
