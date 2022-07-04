@extends('layouts.main')

@section('content')
<h2>Summary of POSS Data</h2>
<div class="row">
            <div class="col-lg-3 col-md-6">
                <!-- small box -->
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="card-title">Schools</div>
                        <p class="card-text">{{ \App\Models\School::all()->count() }}</p>
                        
                    </div>
                    <!-- <div class="icon">
                        <i class="fa fa-stats-bars"></i>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <!-- small box -->
                <div class="card border-secondary">
                    <div class="card-body">
                        <div class="card-title">Wards</div>
                        <p class="card-text">{{ \App\Models\Ward::all()->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-success">
                    <div class="card-body">
                        <div class="card-title">Districts</div>
                        <p class="card-text">{{ \App\Models\District::all()->count() }}</p>
                        
                    </div>
                    <!-- <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-info">
                    <div class="card-body">
                        <div class="card-title">Students</div>
                        <p class="card-text">{{ \App\Models\Student::all()->count() }}</p>
                       
                    </div>
                    <!-- <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div> -->
                </div>
            </div>

    </div>


@endsection
