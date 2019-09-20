
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | Patient Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" integrity="sha256-AIodEDkC8V/bHBkfyxzolUMw57jeQ9CauwhVW6YJ9CA=" crossorigin="anonymous" />
    <!-- NProgress -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha256-pMhcV6/TBDtqH9E9PWKgS+P32PVguLG8IipkPyqMtfY=" crossorigin="anonymous" />

    <!-- Animate.css -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.css" integrity="sha256-a2tobsqlbgLsWs7ZVUGgP5IvWZsx8bTNQpzsqCSm5mk=" crossorigin="anonymous" />

    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gentelella/1.4.0/css/custom.css" integrity="sha256-qR/R6JievOwe1ujDTc46UsTvEjq5yAj4wiNoyt7yllU=" crossorigin="anonymous" />
  </head>

  <body class="login">
    <div>

      <div class="login_wrapper">
          <section class="login_content">
            @include('templates.error')
            <form method="POST" action="{{ route('patient.auth.registerPatient') }}">
              @csrf
              <h1>Create Account</h1>
              <div>
                <label for="fullname">Fullname</label>
                <input type="text" id="fullname" name="name" class="form-control" placeholder="Fullname" value="{{ old('name') }}" />
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
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
      </div>
    </div>
  </body>
</html>
