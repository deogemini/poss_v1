@extends('layouts.main')

@section('content')
<h2>Summary of POSS Data</h2>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <!-- Link to the page related to schools -->
        <a href="{{ url('/schools') }}" class="text-decoration-none">
            <!-- small box -->
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Schools</h5>
                        <span class="fa-stack fa-2x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i> <!-- Circle background -->
                            <i class="fas fa-school fa-stack-1x fa-inverse"></i> <!-- School icon -->
                        </span>
                    </div>
                    <p class="card-text">{{ \App\Models\School::all()->count() }} Schools</p>
                </div>
            </div>
        </a>
    </div>


    <div class="col-lg-3 col-md-6">
        <!-- small box -->
        <div class="card border-secondary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Teachers</h5>
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x text-secondary"></i> <!-- Circle background -->
                        <i class="fas fa-chalkboard-teacher fa-stack-1x fa-inverse"></i> <!-- Teacher icon -->
                    </span>
                </div>
                <p class="card-text">{{$teacherNumbers}} Teachers</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <!-- small box -->
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Wards</h5>
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-circle fa-stack-2x text-success"></i> <!-- Circle background -->
                        <i class="fas fa-map fa-stack-1x fa-inverse"></i> <!-- Ward icon -->
                    </span>
                </div>
                <p class="card-text">{{ \App\Models\Ward::all()->count() }} Wards</p>
            </div>
        </div>
    </div>

            <div class="col-lg-3 col-md-6">
                <!-- small box -->
                <div class="card border-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Students</h5>
                            <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x text-info"></i> <!-- Circle background -->
                                <i class="fas fa-user-graduate fa-stack-1x fa-inverse"></i> <!-- Student icon -->
                            </span>
                        </div>
                        <p class="card-text">{{ \App\Models\Student::all()->count() }} Students</p>
                    </div>
                </div>
            </div>


    </div>


@endsection
