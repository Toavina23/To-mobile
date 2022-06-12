<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Trajets du véhicule {{ $vehicule->numero }} </title>
</head>

<body>
    <div class="container mt-5">
        <div class="row col-md-12 mx-auto justify-content-center">
            <h1 class="text-center mb-5">Trajets du véhicule {{ $vehicule->numero }}</h1>
            {{-- <table class="table table-bordered table-info">
                <tr>
                    <th scope="col">Date de départ</th>
                    <th scope="col">Kilométrage au départ</th>
                    <th scope="col">Lieu de départ</th>
                    <th scope="col">Date d'arrivé</th>
                    <th scope="col">Kilométrage à l'arrivé</th>
                    <th scope="col">Lieu d'arrivé</th>
                    <th scope="col">Montant carburant total</th>
                    <th scope="col">Quantité carburant total</th>
                </tr>
                @foreach ($trajets as $trajet)
                    <tr>
                        <td>{{ $trajet->date_depart }}</td>
                        <td>{{ $trajet->kilometrage_depart }}</td>
                        <td>{{ $trajet->lieuDepart->lieu_nom }}</td>
                        <td>{{ $trajet->date_arrive }}</td>
                        <td>{{ $trajet->kilometrage_arrive }}</td>
                        <td>{{ $trajet->lieuArrive->lieu_nom }}</td>
                        <td>{{ $trajet->montant_carburant }}</td>
                        <td>{{ $trajet->quantite_carburant }}</td>
                    </tr>
                @endforeach
            </table> --}}
            @foreach ($trajets as $trajet)
                <div class="row mt-3 mb-3 alert-secondary rounded col-md-8 mx-auto pl-5 pt-3 pb-3">
                    <p><b>Date de départ:</b> {{ $trajet->date_depart }}</p>
                    <p><b>Kilométrage au départ:</b> {{ $trajet->kilometrage_depart }}</p>
                    <p><b>Lieu de départ:</b> {{ $trajet->lieuDepart->lieu_nom }}</p>
                    <p><b>Date d'arrivé:</b>
                        @if ($trajet->date_arrive)
                            {{ $trajet->date_arrive }}
                        @else
                            {{ '---' }}
                        @endif
                    </p>
                    <p><b>Kilométrage à l'arrivé:</b>
                        @if ($trajet->kilometrage_arrive)
                            {{ $trajet->kilometrage_arrive }}
                        @else
                            {{ '---' }}
                        @endif
                    </p>
                    <p><b>Lieu d'arrivé:</b>
                        @if ($trajet->lieuArrive)
                            {{ $trajet->lieuArrive->lieu_nom }}
                        @else
                            {{ '---' }}
                        @endif
                    </p>
                    <p><b>Montant carburant total:</b>
                        @if ($trajet->montant_carburant)
                            {{ $trajet->montant_carburant }}
                        @else
                            {{ '---' }}
                        @endif
                    </p>
                    <p><b>Quantité carburant total:</b>
                        @if ($trajet->quantite_carburant)
                            {{ $trajet->quantite_carburant }}
                        @else
                            {{ '---' }}
                        @endif
                    </p>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</body>

</html>
