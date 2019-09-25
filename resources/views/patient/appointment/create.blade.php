@extends('templates.dashboard-template')
@section('title', 'Set Appointment')
@section('content')
@prepend('meta')
<meta name="close-days" content="{{ $closeDays }}">
@endprepend
@prepend('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css" integrity="sha256-Fl1s8EQCc9mKf/njo8mWr0MPJR8TnOQb0h0rmVKRoP8=" crossorigin="anonymous" />
@endprepend
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            {{-- <h4><b>Please select service & doctor first.</b></h4> --}}
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
              
              @if(is_null(Auth::user()->info))
                  <h3 class="text-center">Sorry but you can't set an appoint please complete your profile first. <a href="/patient/edit" class="btn btn-success btn-sm">Update profile</a></h3>
                @else
                  <div class="alert alert-danger" role="alert">
                    <b>NOTE: There are some disabled dates which means on that date the clinic is close.</b>
                    <br>
                    <b>NOTE: Please select Service & Doctor first.</b>
                  </div>
                    <form id="setAppointmentForm">
                    <div class="form-group col-lg-6">
                      <label for="services">Select service</label>
                      <select name="service_id" id="services" class="form-control">
                        <option selected disabled>Select service</option>
                        @foreach($services as  $service)
                          <option data-src="{{ $service }}" value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group col-lg-3">
                        <label for="price">Service fee</label>
                        <input type="text" readonly id="price" name="price" class="form-control">
                  </div>

                  <div class="form-group col-lg-3">
                        <label for="hour">Service Hour</label>
                        <input type="text" readonly id="hour" name="duration" class="form-control">
                  </div>
                  

                  <div class="form-group col-lg-12">
                        <label for="doctors">Select doctor</label>
                        <select name="doctor" id="doctors" class="form-control">
                          <option selected disabled>Select doctor</option>
                          @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->title . ' ' .$doctor->fullname }}</option>
                          @endforeach
                        </select>
                  </div>
                  
                  <div class="form-group col-lg-12">
                        <label for="date">Select Date (click the icon to select date)</label>
                      <div class='input-group date' id='datetimepicker1'>
                          <input type='text' class="form-control" readonly />
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                  </div>
                  <div id="recommendTime" class="hide">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <td class="text-center">Time</td>
                          <td class="text-center">Session</td>
                          <td class="text-center">Action</td>
                        </tr>
                      </thead>
                      <tbody id="vacants">
                         
                      </tbody>

                    </table>
                  </div>
                 </form>
              @endif
            </div>
      </div>
    </div>
</div>
@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js" integrity="sha256-sU6nRhzXDAC31Wdrirz7X2A2rSRWj10WnP9CA3vpYKw=" crossorigin="anonymous"></script>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    String.prototype.replaceAll = function(search, replacement) {
        var target = this;
        return target.replace(new RegExp(search, 'g'), replacement);
    };

    let closeDays     = JSON.parse($('meta[name="close-days"]').attr('content'));
    let closeDates = closeDays.map(data => moment(data.start).format('MM/D/Y'));

    let dp = $('#datetimepicker1').datetimepicker({
         pickTime: false,
         todayHighlight: true,
         startDate: new Date(),
         minDate : new Date(),
         disabledDates : closeDates,
    });

    $('#datetimepicker1').find('input').prop('disabled', true);


    function alreadySelectATime(e)
    {
        let confirmation = confirm('Did you double check all information for your appointment?');
        if ( confirmation ) {
          let selectedStart = e.getAttribute('data-start');
          let selectedEnd = e.getAttribute('data-end');
          let data = $('#setAppointmentForm').serialize();
          
          $.ajax({
            url :'/patient/appointment',
            type : 'POST',
            data : `${data}&start_date=${selectedStart}&end_date=${selectedEnd}`,
            success: function (response) {
              alert('Redirecting to appointment confirmation please wait a couple of seconds..');
              window.location.href = `/patient/appointment/confirmation/${response.appointment_id}`;
            }
          });
        }
        
    }

    let displayVacantsTime = (response, property) => {
        if (response.availables[property]) {
          let vacants = "";
          let hasTimeClose = response.time_close.length !== 0;
          // new Set removing the duplicate values.
          let unique = [...new Set(response.availables[property])];
            unique.forEach((data) => {
              let start = `${$('#datetimepicker1').find('input').val()} ${data.split(' - ')[0]}:00:00`;
              let end   = `${$('#datetimepicker1').find('input').val()} ${data.split(' - ')[1]}:00:00`;
              let format = 'hh:mm';
                if (hasTimeClose) {
                    response.time_close.forEach((time) => {
                      let betweenCloseTime = !moment(
                              new Date(start), format).isBetween(moment(new Date(time.start), format),
                              moment(new Date(time.end), format),
                              null,
                              '[)'
                        );

                      if (betweenCloseTime) {
                        vacants += `  <tr>
                              <td class="text-center"><b>${moment(new Date(start)).format('hA')} - ${moment(new Date(end)).format('hA')}</b></td>
                              <td class="text-center"><b>${property.toUpperCase()}</b></td>
                              <td class="text-center"><button onclick="alreadySelectATime(this)" class="btn btn-sm btn-primary" type="button" data-start="${start}" data-end="${end}">Select</button></td>
                            </tr>`;
                          
                      }
                    });
                } else {
                   vacants += `  <tr>
                              <td class="text-center"><b>${moment(new Date(start)).format('hA')} - ${moment(new Date(end)).format('hA')}</b></td>
                              <td class="text-center"><b>${property.toUpperCase()}</b></td>
                              <td class="text-center"><button onclick="alreadySelectATime(this)" class="btn btn-sm btn-primary" type="button" data-start="${start}" data-end="${end}">Select</button></td>
                            </tr>`;
                }

                $('#vacants').append(vacants);
            });
        }
        $('#recommendTime').removeClass('hide');
    };

    function isUserSelectServiceAndDoctor()
    {
        return $('#services').prop('selectedIndex') !== 0 && $('#doctors').prop('selectedIndex') !== 0;
    }

    $('#datetimepicker1').datetimepicker().on('dp.change', function () {
      // If the user already select a service and doctor.
      if (isUserSelectServiceAndDoctor()) {
          let selectedDate = $('#datetimepicker1').find('input').val().replaceAll('/', '-');
          let doctorId = $('#doctors').children('option:selected').val();
          let serviceDuration = JSON.parse($('#services').children('option:selected').attr('data-src')).duration;
          $('#vacants').html('');
          $.ajax({
            url : `/patient/appointment/available/${selectedDate}/${doctorId}/${serviceDuration}`,
            type : 'GET',
            success : function (response) {
                displayVacantsTime(response, 'morning');
                displayVacantsTime(response, 'afternoon');
            },
          });
      } else {
        alert('Please select service and doctor.');
      }
    });
 
    $('#services').change(function(e) {
        let service = JSON.parse($(this).children('option:selected').attr('data-src'));
        $('#price').val(`${service.price} ${service.per_each == 1 ? 'Per each' : '' }`);
        $('#hour').val(service.duration);

        if (isUserSelectServiceAndDoctor()) {
            $('#datetimepicker1').find('input').prop('disabled', false);
        }
    });

    $('#doctors').change(function (e) {
       if (isUserSelectServiceAndDoctor()) {
            $('#datetimepicker1').find('input').prop('disabled', false);
        }
    });
  </script>
@endpush
@endsection