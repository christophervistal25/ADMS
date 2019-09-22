@extends('templates.dashboard-template')
@section('title', 'Appointment Details')
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
            </div>
      </div>
    </div>
</div>

@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
@endpush
@endsection