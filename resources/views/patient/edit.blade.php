@extends('templates.dashboard-template')
@section('title', 'Edit your account')
@section('content')
@prepend('page-css')
@endprepend
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2></h2>
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
              @include('templates.error')
              @include('templates.success')
              <form action="{{ route('account.settings.update', [request()->user()]) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="name">Fullname</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? request()->user()->name }}">
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?? request()->user()->email }}">
                  </div>

                  <div class="form-group">
                    <label for="mobile">Mobile No.</label>
                    <input type="text" class="form-control" id="mobile" name="mobile_no" value="{{ old('mobile_no') ?? request()->user()->mobile_no }}">
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                  </div>

                  <div class="form-group">
                    <label for="passwordConfirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
                  </div>

                  <input type="submit" value="Update" class="btn btn-primary  btn-success pull-right">
              </form>
            </div>
      </div>
    </div>
</div>
@push('page-scripts')

</script>
@endpush
@endsection