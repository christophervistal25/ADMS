@extends('templates.guest-templates')
@section('title', 'Patient Login')
@section('content')
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            @include('templates.error')
            <form method="POST" action="{{ route('patient.auth.loginPatient') }}">
              @csrf
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password"  />
              </div>
              <div>
                <input class="btn btn-default submit" type="submit" value="Log in">
                <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="{{ route('patient.auth.register') }}" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
@endsection