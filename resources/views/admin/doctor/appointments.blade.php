@extends('templates.dashboard-template')
@section('title', $doctor->fullname . ' Appointments')
@section('content')
@prepend('page-css')
  <!-- FullCalendar -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.css' />
@endprepend
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            {{-- <h2>Today's Appointments</h2>
            <div class="clearfix"></div> --}}
          </div>
            <div class="x_content">
                <div id='calendar'></div>
           </div>
      </div>
    </div>
</div>
@push('page-scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
 <script>
   $(document).ready(function () {
       let doctorId = {{$doctor->id}};

       let calendar = $('#calendar').fullCalendar({
        // editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek'
          },
          defaultView: 'agendaWeek',
          selectable:true,
          selectHelper:true,
          eventSources: [
            {
              url: `/admin/doctorappointment/${doctorId}`,
              method: 'GET',
              failure: function() {
                alert('there was an error while fetching events try to reload the page.');
              },
            }
          ],
          eventAfterRender: function (event, $el, view) {
                $el.removeClass('fc-short');
          },
          // select: function(start, end, allDay)
          // {
          //    let formatedStart = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
          //    let formatedEnd = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

          //    if (formatedStart != null && formatedEnd != null) {
          //       $('.bs-set-appointment-modal').modal('toggle');
          //       let selectedDoctorId = $('#doctors').children('option:selected').val();
          //       $('#doctor').val(selectedDoctorId);  
          //    }            
          // },
          //  eventDrop:function(event)
          //     {
          //      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          //      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          //      var title = event.title;
          //      var id = event.id;
          //     },

      });
   });
 </script>
@endpush
@endsection