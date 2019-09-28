@extends('templates.dashboard-template')
@section('title', 'List of your appointments')
@section('content')
@prepend('page-css')
<!-- iCheck -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/green.css" integrity="sha256-5zuyx5fuDf6aU3/8tSuuR31yFxkMHjsTq43zd5dpNnU=" crossorigin="anonymous" />
<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
@endprepend
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table class="table table-striped table-bordered" id="datatable">
          <thead>
            <tr>
              <th>Service</th>
              <th>Service Fee</th>
              <th>Service Hour/s</th>
              <th>Doctor</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach($patient->appointments as $appointment)
                <tr>
                    <td>{{ $appointment->service->name }}</td>
                    <td>{{ $appointment->service->price }}</td>
                    <td class="text-center">{{ $appointment->service->duration }} Hour/s</td>
                    <td>{{ $appointment->doctor->title . ' ' . $appointment->doctor->fullname }}</td>
                    <td class="text-center"><b>{{ $appointment->start_date->format('l jS \\of F Y h:i A') . ' to ' . $appointment->end_date->format('h:i A') }}</b></td>
                    <td class="text-center"><a href="/patient/appointment/confirmation/{{ $appointment->id }}" class="btn btn-success btn-sm">Print confirmation</a></td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js" integrity="sha256-8HGN1EdmKWVH4hU3Zr3FbTHoqsUcfteLZJnVmqD/rC8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
@endpush
@endsection