@extends('templates.dashboard-template')
@section('title', 'List of Close days')
@section('content')
@prepend('page-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css" integrity="sha256-Fl1s8EQCc9mKf/njo8mWr0MPJR8TnOQb0h0rmVKRoP8=" crossorigin="anonymous" />
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
        <div class="pull-right">
          <button class="btn btn-success" data-toggle="modal" data-target=".bs-add-close-day-modal"><i class="fa fa-plus"></i> Add Close day</button> 
        </div>
        <table class="table table-striped table-bordered" id="datatable">
          <thead>
                <tr>
                  <td>Date</td>
                  <td>All Day</td>
                  <td>Created on</td>
                  <td>Actions</td>
                </tr>
          </thead>
          <tbody>
            @foreach($dates as $date)
              <tr>
                <td class="text-center"><b>{{ $date->start->format('l jS \\of F h:i A') }} to {{ $date->end->format('h:i A - Y') }}</b></td>
                <td class="text-center">{{ ($date->all_day === 1) ? 'Close All Day' : '' }}</td>
                <td class="text-center">{{ $date->created_at->diffForHumans() }}</td>
                <td class="text-center">
                  <button data-src="{{ $date }}" class="btn btn-info btn-success btn-edit-close-day"><i class="fas fa-edit"></i></button>
                  <button  data-src="{{ $date->id }}" class="btn btn-info btn-danger btn-delete-close-day"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            @endforeach            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Add Close day modal -->
<div class="modal fade bs-add-close-day-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="addCloseDay">Add Close day</h4>
      </div>
      <form id="addCloseDayForm">
        <div class="modal-body">
            <div class="alert alert-success " role="alert">
              Please review your inputs this data will effect in patient setting an appointment.
            </div>
                <div class="form-group">
                  <label for="date">Start</label>
                  <div class='input-group date' id='datetimepicker1'>
                      <input type='text' name="start" class="form-control"  />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="date">End</label>
                      <div class='input-group date' id='datetimepicker2'>
                          <input type='text' name="end" class="form-control" />
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                </div>

                <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /Add Close day -->


<!-- Edit Close day modal -->
<div class="modal fade bs-edit-close-day-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="editCloseDay">Edit Close day</h4>
      </div>
      <form id="editCloseDayForm">
        <div class="modal-body">
            <div class="form-group">
                  <label for="date">Start</label>
                  <div class='input-group date' id='editDatetimepicker1'>
                      <input type='text' name="start" class="form-control"  />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="date">End</label>
                      <div class='input-group date' id='editDatetimepicker2'>
                          <input type='text' name="end" class="form-control" />
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
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
<!-- /Edit Close day -->

@push('page-scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js" integrity="sha256-sU6nRhzXDAC31Wdrirz7X2A2rSRWj10WnP9CA3vpYKw=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js" integrity="sha256-8HGN1EdmKWVH4hU3Zr3FbTHoqsUcfteLZJnVmqD/rC8=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
  <script>
    let closeDayId;
    let startTemp = null;
    let endTemp   = null;

       $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

       $('#datetimepicker1').datetimepicker({todayHighlight : true});
       $('#datetimepicker2').datetimepicker({todayHighlight: true});
       $('#editDatetimepicker1, #editDatetimepicker2').datetimepicker({todayHighlight: true});


       $('#addCloseDayForm').submit(function (e) {
          e.preventDefault();
          let data = $(this).serialize();
          $.ajax({
            url : '/admin/close',
            type : 'POST',
            data : data,
            success : function (response) {
                if (response.success) {
                  alert('Succesfully add new close day please wait a couple of seconds...');
                  window.location.reload();
                }
            }
          });
       });

       $('.btn-edit-close-day').click(function (e) {
          let data = JSON.parse($(this).attr('data-src'));
          closeDayId = data.id;
          $('#editDatetimepicker1').find('input').val(moment(data.start).format('MM/DD/YYYY hh:mm A'))
          $('#editDatetimepicker2').find('input').val(moment(data.end).format('MM/DD/YYYY hh:mm A'))
          $('.bs-edit-close-day-modal').modal('toggle');
       });

       $('#editCloseDayForm').submit(function (e) {
          e.preventDefault();
          let data = $(this).serialize();
          $.ajax({
            url : `/admin/close/${closeDayId}`,
            type : 'PUT',
            data : data,
            success : function (response) {
                if (response.success) {
                    alert('Succesfully update the close day please wait a couple of seconds..');
                    window.location.reload();
                }
            }
          });
       });

       $('.btn-delete-close-day').click(function (e) {
          let id = $(this).attr('data-src');
          let confirmation = confirm('Do you want to remove this date?');
          if (confirmation) {
              $.ajax({
                url : `/admin/close/${id}`,
                type : 'DELETE',
                success : function (response) {
                    if (response.success) {
                        alert('Succesfully delete the date please wait a couple of seconds...');
                        window.location.reload();
                    }
                },
              });
          }
       });
  </script>
@endpush
@endsection