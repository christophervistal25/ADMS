@extends('templates.guest-templates')
@section('title', 'Patient Register')
@section('content')
    <div>
      <div class="login_wrapper">
          <section class="login_content">
            @include('templates.error')
            <form method="POST" action="{{ route('patient.auth.registerPatient') }}">
              @csrf
              <h1>Create Account</h1>
              <div>
                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Firstname" value="{{ old('firstname') }}" />
              </div>
              <div>
                <label for="middlename">Middlename</label>
                <input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middlename" value="{{ old('middlename') }}" />
              </div>
              <div>
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="lastname" value="{{ old('lastname') }}" />
              </div>
              <div>
                <label for="emailAddress">Email Address</label>
                <input type="email" id="emailAddress" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}"  />
              </div>
              <div>
                <label for="mobileNo">Mobile No.</label>
                <input type="text" name="mobile_no" class="form-control" placeholder="+639193693499" value="{{ old('mobile_no') }}" />
              </div>
              <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"  />
              </div>
              <div>
                <label for="retypePassword">Re-type Password</label>
                <input type="password" id="retypePassword" name="password_confirmation" class="form-control" placeholder="Re-type password"  />
              </div>
              <div>
                <input class="btn btn-default submit" value="Create an account" type="submit">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="{{ route('patient.auth.login') }}" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
      </div>
    </div>
@endsection
