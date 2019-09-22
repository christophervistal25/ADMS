@extends('templates.dashboard-template')
@section('title', 'Edit your account')
@section('content')
@prepend('page-css')
@endprepend
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
              @include('templates.error')
              <form action="{{ route('account.settings.update', [Auth::user()]) }}" method="POST">
                <div class="alert alert-{{ \Session::has('success') ? 'success' : 'info' }}" role="alert">
                  @if(\Session::has('success'))
                    {{ \Session::get('success') }}
                    @else
                    Password field is optional if you want to change your password just fill it.
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
                    <label for="mobile">Mobile No.</label>
                    <input type="text" class="form-control" id="mobile" name="mobile_no" value="{{ old('mobile_no') ?? Auth::user()->mobile_no }}">
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                  </div>

                  <div class="form-group">
                    <label for="passwordConfirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
                  </div>
    
                 <hr>
                  <div class="alert alert-info" role="alert">
                      If you are planning to set an appointment you must fill these fields.
                  </div>

                  <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname') ?? $patient->info->nickname ?? '' }}">
                  </div>

                  <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') ?? $patient->info->birthdate ?? '' }}">
                  </div>

                  <div class="form-group">
                    <label for="martial_status">Martial Status</label>
                    <select class="form-control" id="martial_status" name="martial_status">
                        <option value="Single" {{ old('martial_status') === 'Single' ? 'selected' : @$patient->info->martial_status === 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('martial_status') === 'Married' ? 'selected' : @$patient->info->martial_status === 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Divorced" {{ old('martial_status') === 'Divorced' ? 'selected' : @$patient->info->martial_status === 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="Widowed" {{ old('martial_status') === 'Widowed' ? 'selected' : @$patient->info->martial_status === 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="sex">Sex</label>
                    <select class="form-control" id="sex" name="sex">
                        <option value="Women" {{ old('sex') === 'Women' ? 'selected' : @$patient->info->sex === 'Women' ? 'selected' : '' }}>Women</option>
                        <option value="Men" {{ old('sex') === 'Men' ? 'selected' : @$patient->info->sex === 'Men' ? 'selected' : '' }}>Men</option>
                        <option value="Choose not to say" {{ old('sex') === 'Choose not to say' ? 'selected' : @$patient->info->sex === 'Choose not to say' ? 'selected' : '' }}>Choose not to say</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation') ?? $patient->info->occupation ?? '' }}">
                  </div>

                  <div class="form-group">
                    <label for="home_address">Home Address</label>
                    <textarea name="home_address" id="home_address" class="form-control" cols="30" rows="10">{{ old('home_address') ?? $patient->info->home_address ?? '' }}</textarea>
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