@extends('templates.dashboard-template')
@section('title', 'Add new Patient')
@section('content')
@prepend('page-css')
@endprepend
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
                  <span style="color:white;">his/her patient number is <strong>{{ Session::get('patient_no') }}</strong> do you want to add <b>Examination Record Chart?</b> <a href="{{ route('patient.examination.record.create', [Session::get('patient_id') ]) }}" style=" color :white;text-decoration: underline;">(click this underlined text)</a></span>
              </div>
              @else
                @include('templates.error')
              @endif
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
              <form action="{{ route('patient.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="name">Fullname <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                  </div>

                  <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                  </div>

                  <div class="form-group">
                    <label for="mobile">Mobile No. <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="mobile" name="mobile_no" value="{{ old('mobile_no') }}">
                  </div>

                  {{-- <div class="form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password">
                  </div>

                  <div class="form-group">
                    <label for="passwordConfirmation">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation">
                  </div> --}}

                  <div class="form-group">
                    <label for="nickname">Nickname <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname') }}">
                  </div>

                  <div class="form-group">
                    <label for="birthdate">Birthdate <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" >
                  </div>

                  <div class="form-group">
                    <label for="martial_status">Martial Status <span class="text-danger">*</span></label>
                    <select class="form-control" id="martial_status" name="martial_status">
                        <option value="Single" {{ old('martial_status') === 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('martial_status') === 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Divorced" {{ old('martial_status') === 'Divorced' ? 'selected' :  '' }}>Divorced</option>
                        <option value="Widowed" {{ old('martial_status') === 'Widowed' ? 'selected' :  '' }}>Widowed</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="sex">Sex <span class="text-danger">*</span></label>
                    <select class="form-control" id="sex" name="sex">
                        <option value="Women" {{ old('sex') === 'Women' ? 'selected' : '' }}>Women</option>
                        <option value="Men" {{ old('sex') === 'Men' ? 'selected' :  '' }}>Men</option>
                        <option value="Choose not to say" {{ old('sex') === 'Choose not to say' ? 'selected' :  '' }}>Choose not to say</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="occupation">Occupation <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation') }}" >
                  </div>

                  <div class="form-group">
                    <label for="home_address">Home Address <span class="text-danger">*</span></label>
                    <textarea name="home_address" id="home_address" class="form-control" cols="30" rows="10">{{ old('home_address') }}</textarea>
                  </div>

                 <div class="pull-right">
                   <input type="submit" class="btn btn-primary" value="Add patient" >
                 </div>
                 <div class="clearfix"></div>
              </form>
            </div>
      </div>
    </div>
</div>
@push('page-scripts')

</script>
@endpush
@endsection