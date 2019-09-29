@extends('templates.dashboard-template')
@section('title', 'Dashboard')
@prepend('meta')
<meta name="services" content="{{ $serviceNames }}">
<meta name="serviceReport" content="{{ $serviceReport }}">
@endprepend
@prepend('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
@endprepend
@section('content')
<div class="">
  <div class="row top_tiles">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
        <div class="count">{{ $doctorsCount }}</div>
        <h3>Doctors</h3>
        <p><a href="/admin/doctor">Click this to view.</a></p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-comments-o"></i></div>
        <div class="count">{{ $patients }}</div>
        <h3>Patients</h3>
        <p><a href="/admin/patient">Click this to view.</a></p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
        <div class="count">{{ $services }}</div>
        <h3>Services</h3>
        <p><a href="/admin/service">Click this to view.</a></p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-check-square-o"></i></div>
        <div class="count">{{ $closeDays }}</div>
        <h3>Close Days</h3>
        <p><a href="/admin/close">Click this to view.</a></p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        <h4>Doctor's who have an appointment for today</h4>
      <div class="x_content">
        <table class="table table-striped table-bordered" id="datatable" >
          <thead>
            <tr>
              <th>Name</th>
              <th class="text-center">No. of appointments</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($appointments as $doctor)
              <tr>
                <td> {{ $doctor->title }} {{ $doctor->fullname }}</td>
                <td class="text-center"><strong> <span class="badge">{{ $doctor->appointments_count }}</span></strong></td>
                <td class="text-center"> <a style="text-decoration: underline;" href="/admin/doctor/{{$doctor->id}}">View {{ $doctor->appointments_count}} Appointments</a></td>
              </tr>
            @empty
               <tr>
                <td class="text-center text-danger" colspan="3"><strong>No data available</strong></td>
              </tr>    
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        <h4>Appointments visit for service</h4>
      <div class="x_content">
        <canvas id="myChart" width="300" height="300"></canvas>
      </div>
    </div>
  </div>
</div>
@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
<script>
  let services = $('meta[name="services"]').attr('content');
  let serviceValues = $('meta[name="serviceReport"]').attr('content');
  console.log(serviceValues);
  let pieChart = $('#myChart');
  var myChart = new Chart(pieChart, {
    type: 'doughnut',
    data: {
          labels: JSON.parse(services),
          datasets: [{
              data: JSON.parse(serviceValues),
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
              ],
              borderWidth: 1
          }]
      }
  });
</script>
@endpush
@endsection