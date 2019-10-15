@inject('service', 'App\Service')
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
        <div class="pull-right">
            <button type="submit" class="btn btn-primary" disabled id="btnPrintSelectedRecord">PRINT</button>  
        </div>
        <div class="clearfix"></div>
        <table class="table table-striped table-bordered jambo_table " id="datatable">
          <thead>
                <tr>
                    <td class="text-center"> <label for="select-all-record"><input type="checkbox" id="select-all-record" /> Select</label> </td>
                    <td class="text-center">Date</td>
                    <td>Tooth</td>
                    <td>Surface</td>
                    <td>Treatment Rendered</td>
                    <td>Fee</td>
                    <td>Paid</td>
                    <td>Balance</td>
                    <td>Actions</td>
                </tr>
          </thead>
          <tbody>
            @foreach($records->examinations as $key => $record)
                <tr class="record-row" data-key="{{$record->id}}">
                  <td class="text-center text-bold">
                        <input class="child-checkbox" type="checkbox" data-key="{{$record->id}}" id="select-{{$record->id}}">
                  </td>
                  <td class="text-center text-bold"><strong>{{ $record->created_at->format('l jS \\of F h:i A Y') }}</strong></td>
                  <td class="text-center"><strong>{{ $record->teeths->pluck('tooth_description')->implode(', ') }}</strong></td>
                  <td class="text-center"><strong>{{ $record->teeths->pluck('surface')->implode(', ') }}</strong></td>
                  <td class="text-center"><strong>{{ $record->teeths->pluck('treatment')->implode(', ') }}</strong>
                  </td>
                  <td class="text-center font-weight-bold">{{ $record->payments->fee }}</td>
                  <td class="text-center font-weight-bold">{{ $record->payments->paid }}</td>
                  <td class="text-center font-weight-bold">{{ $record->payments->fee -  $record->payments->paid }}</td>
                 <th class="text-center">
                    @if(!$record->isOneDay())
                    <a href="{{ route('patient.examination.edit', $record) }}" data-toggle="tooltip" title="Edit Record" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> </a>
                    @endif
                    <a href="{{ route('patient.examination.show', $record->id) }}" data-toggle="tooltip" title="View Record" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> </a>
                    <a href="/admin/examination/{{$record->id}}/{{$record->teeths->pluck('id')->count() }}/{{$service::where('name',$record->payments->service_rendered)->first()->id}}/payment" data-toggle="tooltip" title="Generate Receipt" class="btn btn-info btn-sm"><i class="fas fa-receipt"></i> </a>
                 </th>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@push('page-scripts')
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
<script>

  $('a').click(function (e) {
      e.stopPropagation();
  });

  $('#select-all-record').click(function (e) {
       e.stopPropagation();
       let state = $(this).prop('checked');
       $('.child-checkbox').each(function (e) {
          $(this).prop('checked', state);
       });
       hasCheck();
  });

  $('label[for="select-all-record"]').click(() => false);

  function hasCheck()
  {
    if ($('.child-checkbox:checked').length !== 0) {
      $('#btnPrintSelectedRecord').prop('disabled', false);
    } else {
      $('#btnPrintSelectedRecord').prop('disabled', true);
      $('#select-all-record').prop('checked', false);
    }
  }

  $('tr.record-row').click(function () {
      let recordId = $(this).attr('data-key');
      if (!$(`#select-${recordId}`).prop('checked')) {
          $(`#select-${recordId}`).prop('checked', true);  
      } else {
          $(`#select-${recordId}`).prop('checked', false);
      }
      hasCheck();
  });

  $('#btnPrintSelectedRecord').click(function () {
      let params = "";
      $('input[type="checkbox"]:checked').each(function (index) {
        let checkbox = $(this);
          if (checkbox.attr('data-key')) {
              params += `record[]=${(checkbox.attr('data-key'))}`;
          }
      });
      if (params == "") {
          window.location.reload();
      } else {
        window.location.href = `/admin/patient/examination/history/print/${params}`;
      }
  });
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
@endpush
@endsection