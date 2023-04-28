@extends('layouts.main')

@section('content')

    <div class="container card-container">
        <div class="row">
            <div class="col-md-3">
                <div class="card custom-card mr-3">
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
                <div class="card custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Start Date</h5>
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="text" class="form-control" id="startdatepicker">
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
                        <h5 class="card-title">End Date</h5>
                        <div class="form-group">
                            <div class="input-group date">
                                <input type="text" class="form-control" id="enddatepicker">
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
                        <h5 class="card-title">All Levels</h5>
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
    </div>



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
