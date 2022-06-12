@extends('layout.app')
@section('content')
    <div class="row col-md-8 justify-content-center mx-auto bordered rounded shadow">
        <canvas id="chart" class="col-md-12"></canvas>
        <script src="{{ asset('js/chart.js') }}"></script>
        <script src="{{ asset('js/chart-min.js') }}"></script>
        <?php ?>
        <script>
            let km = {{ Illuminate\Support\Js::from($km) }}
            let date = {{ Illuminate\Support\Js::from($date) }}
            let vehicule = {{Illuminate\Support\Js::from($vehicule)}}
        </script>
        <script>
            let canvas = document.getElementById('chart').getContext('2d');
            let chartData = {
                labels: date,
                datasets: [{
                    label: 'Kilomètre parcourue',
                    data: km,
                    borderColor: 'rgb(255, 99, 132)'
                }]
            }
            let chart = new Chart(canvas, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: `Kilométres parcourue par ${vehicule.numero}`
                        }
                    }
                },
            })
        </script>
    </div>
@endsection
