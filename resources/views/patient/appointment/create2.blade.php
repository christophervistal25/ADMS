@extends('templates.dashboard-template')
@section('title', 'Set Appointment')
@section('content')
@prepend('page-css')
  <!-- FullCalendar -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.css' />
  <style>
    .fc-time-grid-event.fc-short .fc-time span {
          display: inline;
      }

      .fc-time-grid-event.fc-short .fc-time:before {
          content: normal;
      }  

      .fc-time-grid-event.fc-short .fc-time:after {
          content: normal;
      }
  </style>
@endprepend
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2></h2>
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
                <div class="form-group">
                  <label for="doctors">Select doctor</label>
                  <select name="doctor" id="doctors" class="form-control">
                    @foreach($doctors as $doctor)
                      <option value="{{ $doctor->id }}">{{ $doctor->title . $doctor->fullname }}</option>
                    @endforeach
                  </select>
                </div>
                  <hr>
                  <div class="container">
                    <div id='calendar'></div>
                  </div>
            </div>
      </div>
    </div>
</div>

<!-- Appointment Create modal -->
<div class="modal fade bs-set-appointment-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="SetAppointment">Set appointment</h4>
      </div>
      <form id="setAppointmentForm">
        <div class="modal-body" id="modalSetAppointmentBody">
             <div class="form-group">
                <label for="service">Service</label>
                <select name="service" id="service" class="form-control">
                  <option selected disabled>Select Service</option>
                  @foreach($services as $service)
                    <option data-src="{{ $service }}" value="{{ $service->id }}">{{ $service->name }}</option>
                  @endforeach
                </select>
            </div>
          
            <div class="form-group">
              <label for="price">Price</label>
              <input type="number" name="price" class="form-control" readonly id="price">
              <span id="pricePerEach"></span>
            </div>

            <div class="form-group">
              <input type="hidden" name="doctor_id" class="form-control" readonly id="doctor">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Appointment Create Modal -->
@push('page-scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<script>

  $(document).ready(function() {
    
    $('#doctors').change(function(e) {
      let value = e.target.value;
      console.log(value);
    });

    $('#service').change(function(e) {
      let selectedService = JSON.parse($(this).children("option:selected").attr('data-src'));
      $('#price').val(selectedService.price);
      $('#pricePerEach').html((selectedService.per_each) ? `<span class="text-danger"><b>${selectedService.price} Per each</b></span>` : '');
    });

    let calendar = $('#calendar').fullCalendar({
        editable: true,
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
              url: '/sample',
              method: 'GET',
              failure: function() {
                alert('there was an error while fetching events!');
              },
            }
          ],
          eventAfterRender: function (event, $el, view) {
                $el.removeClass('fc-short');
          },
          select: function(start, end, allDay)
          {
             let formatedStart = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
             let formatedEnd = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

             if (formatedStart != null && formatedEnd != null) {
                $('.bs-set-appointment-modal').modal('toggle');
                let selectedDoctorId = $('#doctors').children('option:selected').val();
                $('#doctor').val(selectedDoctorId);  
             }            
          },
           eventDrop:function(event)
              {
               var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
               var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
               var title = event.title;
               var id = event.id;
              },

      });


    $('#setAppointmentForm').submit(function(e) {
        e.preventDefault();
        console.log('Set Appointment!');
    });

});
</script>
@endpush
@endsection