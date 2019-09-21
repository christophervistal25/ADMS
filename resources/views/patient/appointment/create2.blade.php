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
            </div>
      </div>
    </div>
</div>
@push('page-scripts')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script>
 $(document).ready(function() {
  let dates = '[{"title": "event1", "start": "2019-09-20" , "end": "2019-09-22"}]';
  dates = JSON.parse(dates);

  let calendar = $('#calendar').fullCalendar({
      editable : true,
      header:{
         left:'prev,next today',
         center:'title',
         right:'month,agendaWeek,agendaDay'
      },
      events : dates
   });
 }); -->
</script>
@endpush
@endsection