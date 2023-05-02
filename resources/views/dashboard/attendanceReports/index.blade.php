@extends('layouts.main')

@section('content')

        <div class="row">
            <div class="col-md-3">
                <div class="card custom-card mr-2">
                    <div class="card-body">
                        <h5 class="card-title">Schools</h5>
                        <div class="form-group">
                            <select class="form-control" id="exampleSelect1">
                                <option>All Schools</option>
                                <option>Kurasini Secondary</option>
                                <option>Minazini Primary</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card custom-card mr-2">
                    <div class="card-body">
                        <h5 class="card-title">Start Date</h5>
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker-input" id="startdatepicker">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card custom-card mr-2">
                    <div class="card-body">
                        <h5 class="card-title">End Date</h5>
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker-input" id="enddatepicker">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="card custom-card">
                    <div class="card-body">
                        <h5 class="card-title">All Grade Levels</h5>
                        <div class="form-group">
                            <select class="form-control" id="exampleSelect1">
                                <option>All Levels</option>
                                <option>Form 1</option>
                                <option>Form 2</option>
                                <option>Form 3</option>
                                <option>Form 4</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Present', 'Absent', 'WithPermit', 'No Permit'],
                    datasets: [{
                        label: '# No of Students',
                        data: [12, 19, 3, 5],
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(255, 99, 132)',
                            'rgba(255, 159, 64)',
                            'rgba(255, 205, 8)',
                            'rgba(75, 192, 192)'
                        ]
                    },
                    ] ,
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#startdatepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });

        $(document).ready(function() {
            $('#enddatepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });

    </script>










@endsection
