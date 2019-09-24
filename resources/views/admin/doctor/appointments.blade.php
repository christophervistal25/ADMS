@extends('templates.dashboard-template')
@section('title', $doctor->fullname . ' Appointments')
@section('content')
@prepend('page-css')
<!-- FullCalendar -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.0/fullcalendar.css' />
<!-- iCheck -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/green.css" integrity="sha256-5zuyx5fuDf6aU3/8tSuuR31yFxkMHjsTq43zd5dpNnU=" crossorigin="anonymous" />
<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
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

<!-- Find Patient Modal -->
<div class="modal fade bs-find-patient-modal" tabindex="-1" style="z-index: 9999;" role="dialog" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="findPatient">Find Patient</h4>
      </div>
        <div class="modal-body">
          <div class="alert alert-info" role="alert"><span style="color :white;">Enter the name of patient then press enter</span></div>
          <div class="form-group">
            <input type="text" name="name" placeholder="Search patient firstname or lastname..." class="form-control" id="searchPatient" autocomplete="off">
          </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Mobile no</td>
                <td>Registered on</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody id="fetchedPatients">
              
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
<!-- /Find Patient Modal -->

<!-- Add Appointment -->
<div class="modal fade bs-appointment-add-modal" tabindex="-1"  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="addAppointment">Add Appointment for {{ $doctor->title . ' ' . $doctor->fullname }}</h4>
      </div>
      <form id="addAppointmentForm">
        <div class="modal-body">
            <div class="pull-right">
                <button type="button" data-toggle="modal" class="btn btn-primary btn-sm" data-target=".bs-find-patient-modal">Find patient</button>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-lg-6">
                     <input type="hidden" name="patient_id" id="patientId">
                     <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="name" name="name" readonly class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" id="email" readonly class="form-control">
                    </div>

                    <div class="form-group">
                      <label for="mobile_no">Mobile no.</label>
                      <input type="text" id="mobile_no" name="mobile_no" readonly class="form-control">
                    </div>
              </div>

              <div class="col-lg-6">
                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                     <div class="form-group">
                        <label for="doctor">Doctor</label>
                        <input type="text" id="doctor" name="doctor" readonly class="form-control" value="{{ $doctor->fullname }}">
                    </div>
              </div>
                
              <div class="col-lg-6">
                <div class="form-group">
                    <label for="service">Service</label>
                    <input type="hidden" name="service_id" id="serviceId">
                    <select name="service" id="service" class="form-control">
                        <option selected disabled>Select service</option>
                        @foreach($services as $service)
                            <option data-src="{{$service}}" value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                  </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                    <label for="serviceFee">Service Fee</label>
                    <input type="text" name="price" id="serviceFee" readonly class="form-control">
                  </div>
              </div>

              <div class="col-lg-3">
                <div class="form-group">
                    <label for="serviceHour">Service Hour</label>
                    <input type="text" name="duration" id="serviceHour" readonly class="form-control">
                  </div>
              </div>

            </div>
            <hr>

            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                    <label for="startTime">Start time</label>
                    <input type="text" name="start_date" id="startTime" readonly class="form-control" readonly>
                  </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                    <label for="endTime">End time</label>
                    <input type="text" name="end_date" id="endTime" readonly class="form-control" readonly>
                  </div>
              </div>
            </div>
            

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Add Appointment -->

@push('page-scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js" integrity="sha256-8HGN1EdmKWVH4hU3Zr3FbTHoqsUcfteLZJnVmqD/rC8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
 <script>
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   $(document).ready(function () {
       let doctorId = {{$doctor->id}};

       let calendar = $('#calendar').fullCalendar({
        editable: true,
        allDaySlot: false,
        minTime : '8:00:00',
        maxTime : '18:00:00',

        header: {
            left: 'prev,next today',
            center: 'title',
            right:'agendaWeek,agendaDay'
          },
          defaultView: 'agendaDay',
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
          select: function(start, end, allDay)
          {
              let confirmation = confirm('Do you want to add a appointment?');;
              if(confirmation) {
                  let formatedStart = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                  let formatedEnd = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                  if (formatedStart != null && formatedEnd != null) {
                      $('.bs-appointment-add-modal').modal('toggle');
                      $('#startTime').val(formatedStart);
                      $('#endTime').val(formatedEnd);
                   }            
              }
             
          },
           eventDrop:function(event)
           {
              let confirmation = confirm('Do you want to re-schedule this appointment?');
              if (confirmation) {
                // Request ajax;
                console.log(`Event has been drop.`);

              }
               // var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
               // var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
               // var title = event.title;
               // var id = event.id;
           },

      });
   });


   $('#service').change(function () {
      let service = JSON.parse($(this).children('option:selected').attr('data-src'));
      $('#serviceId').val(service.id);
      $('#serviceFee').val(service.price);
      $('#serviceHour').val(service.duration);
   });

   $('#addAppointmentForm').submit(function (e) {
      e.preventDefault();
      let data = $(this).serialize();
      $.ajax({
        url : '/admin/doctorappointment',
        type : 'POST',
        data : data,
        success : function (response) {
            if (response.success) {
                alert('Succesfully add new appointment please wait a couple of seconds...')
                window.location.reload();
            }
        }
      });
   });

   function saveToAddAppointmentForm(buttonClicked) {
      let patient = JSON.parse($(buttonClicked).attr('data-src'));
      $('#patientId').val(patient.id);
      $('#name').val(patient.name);
      $('#email').val(patient.email);
      $('#mobile_no').val(patient.mobile_no);
      $('.bs-find-patient-modal').modal('hide');
   }

   // Search patient
   $('#searchPatient').keyup(function (e) {
        if (e.keyCode == 13) { // If the user press enter.
            if ($(this).val().length !== 0) {
                $.ajax({
                    url : `/admin/patient/search/${$(this).val()}`,
                    type : 'GET',
                    success : function (patients) {
                      let tableBody = "";
                      $('#fetchedPatients').html('');
                      if (patients.length !== 0) {
                            patients.forEach((patient) => {
                            tableBody += `
                            <tr>
                              <td>${patient.name}</td>
                              <td>${patient.email}</td>
                              <td>${patient.mobile_no}</td>
                              <td>${patient.created_at}</td>
                              <td><button class='btn btn-sm btn-primary' onclick="saveToAddAppointmentForm(this)" data-src='${JSON.stringify(patient)}'>SELECT</button></td>
                            </tr>
                            `;
                          });
                      } else {
                          tableBody = `
                            <tr>
                              <td class='text-center' colspan="5">
                                    Can't find any record.
                              </td>
                            </tr>
                          `;
                      }
                      $('#fetchedPatients').append(tableBody);
                    },
                });
            } else {
                alert('Please enter some name..');
            }
        }
   });

 </script>
@endpush
@endsection