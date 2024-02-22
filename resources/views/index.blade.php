@extends('layouts.app')

@section('content')

<br>
<br>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <form action="{{ url('/login')}}" method="post">
            @csrf
            <div class="card p-4">
                <div class="card-body">
                    <h1>Login</h1>
                    <p class="text-muted">Sign In to your account</p>
                    <form action="your_login_endpoint" method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-addon pr-2"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-addon pr-2"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">Login</button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-link px-0"><i class="fa fa-question-circle"></i> Forgot password?</button> <!-- Added icon within the button -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>



          </form>

          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>POSS</h2>
                <p>POSS (Protecting Our students at Schools) is a software program that is used in schools daily to collect reports on students' attendance.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    @endsection
