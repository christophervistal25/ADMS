@extends('templates.dashboard-template')
@section('title', 'Set Appointment')
@section('content')
@prepend('page-css')
  <!-- FullCalendar -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
@endprepend
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2></h2>
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
                <form action="">
                  <select name="doctor" id="doctor" class="form-control">
                    @foreach($doctors as $doctor)
                      <option value="{{ $doctor->id }}">{{ $doctor->title . $doctor->fullname }}</option>
                    @endforeach
                  </select>

                  
                </form>
            </div>
      </div>
    </div>
</div>
@push('page-scripts')
@endpush
@endsection