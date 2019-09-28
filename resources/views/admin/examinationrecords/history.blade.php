@extends('templates.dashboard-template')
@section('title', $records->name  . ' Examination Records')
@section('content')
@prepend('page-css')
<!-- iCheck -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/green.css" integrity="sha256-5zuyx5fuDf6aU3/8tSuuR31yFxkMHjsTq43zd5dpNnU=" crossorigin="anonymous" />
<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
<style>
   .table {
      table-layout:fixed;
    }

    .table td {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
</style>
@endprepend
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <div class="alert alert-danger"><strong>NOTE: You only have 24 hours access to edit a new record.</strong></div>
      </div>
      <div class="x_content">
        <table class="table table-striped table-bordered" id="datatable">
          <thead>
                <tr>
                    <td class="text-center">Date</td>
                    <td>Tooth</td>
                    <td>Surface</td>
                    <td>Treatment Rendered</td>
                    <td>Free</td>
                    <td>Paid</td>
                    <td>Balance</td>
                    <td>Actions</td>
                </tr>
          </thead>
          <tbody>
            @foreach($records->examinations as $record)
                <tr>
                  <td class="text-center text-bold"><strong>{{ $record->created_at->format('l jS \\of F h:i A Y') }}</strong></td>
                  <td class="text-center"><strong>{{ $record->teeths->pluck('tooth_description')->implode(', ') }}</strong></td>
                  <td class="text-center"><strong>{{ $record->teeths->pluck('surface')->implode(', ') }}</strong></td>
                  <td class="text-center"><strong>{{ $record->teeths->pluck('treatment')->implode(', ') }}</strong>
                  </td>
                  <td>(Free)</td>
                  <td>(Paid)</td>
                  <td>(Balance)</td>
                 <td class="text-center">
                    @if(!$record->isOneDay())
                    <a href="{{ route('patient.examination.edit', $record) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    @endif
                    <a href="{{ route('patient.examination.show', $record->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a>
                 </td>
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