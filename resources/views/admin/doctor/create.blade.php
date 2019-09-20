@extends('templates.dashboard-template')
@section('title', 'Add new Doctor')
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
              <form method="POST" action="{{ route('doctor.store') }}" class="form-horizontal form-label-left" >
                @csrf
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Full Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="fullname" required="required" value="{{ old('fullname') }}" name="fullname" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" required="required" name="title" class="form-control col-md-7 col-xs-12" value="{{ old('title') }}">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group text-center">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
            </div>
      </div>
    </div>
</div>
@push('page-scripts')

@endpush
@endsection