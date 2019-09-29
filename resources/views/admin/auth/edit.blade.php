@extends('templates.dashboard-template')
@section('title', 'Edit your account')
@section('content')
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
              @include('templates.error')
              <form action="{{ route('admin.update.account.setting', [Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
                <div class="alert alert-{{ \Session::has('success') ? 'success' : 'info' }}" role="alert">
                  @if(\Session::has('success'))
                    {{ \Session::get('success') }}
                    @else
                  <span style="color:white;"><strong><u>Password</u> field & <u>Profile</u> are optional if you want to change just add some values.</strong></span>
                  @endif
                </div>
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="name">Fullname</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? Auth::user()->name }}">
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?? Auth::user()->email }}">
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                  </div>

                  <div class="form-group">
                    <label for="passwordConfirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
                  </div>
            
                  <div class="form-group">
                      <label for="profile">Profile</label>
                      <input type="file" id="profile" name="profile">
                  </div>

                 <input type="submit" value="Update" class="btn btn-primary  btn-success pull-right">
              </form>
            </div>
      </div>
    </div>
</div>
@push('page-scripts')
<script>
</script>
@endpush
@endsection