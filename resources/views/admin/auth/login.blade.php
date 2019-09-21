@extends('templates.guest-templates')
@section('title', 'Administrator Login')
@section('content')
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            @include('templates.error')
            <form method="POST" action="{{ route('admin.auth.loginAdmin') }}">
              @csrf
              <h1>Admin Login</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" />
              </div>
              <div>
                <input class="btn btn-default submit" type="submit" value="Log in">
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
@endsection