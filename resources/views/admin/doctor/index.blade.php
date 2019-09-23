@extends('templates.dashboard-template')
@section('title', 'List of Doctors')
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
        <button class="btn btn-primary btn-sm pull-right" data-target=".bs-doctor-add-modal" data-toggle="modal"><i class="fas fa-plus"></i> Add Doctor</button>
        <table class="table table-striped table-bordered" id="datatable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($doctors as $doctor)
            <tr id="doctor-data-{{$doctor->id}}">
              <td>{{ $doctor->id }}</td>
              <td class="text-center"><b>{{ $doctor->title . ' ' .  $doctor->fullname }}</b></td>
              <td class="text-center">
                <button class="btn btn-success btn-sm edit-doctor" data-src="{{ $doctor }}"><i class="fa fa-edit"></i></button>
                <button data-src="{{ $doctor }}" class="btn btn-danger btn-sm delete-doctor"><i class="fa fa-trash"></i></button>
                <a href="{{ route('doctor.show', [$doctor]) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Appointments</a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Add modal -->
<div class="modal fade bs-doctor-add-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="addDoctor">Add Doctor</h4>
      </div>
      <form id="addDoctorForm">
        <div class="modal-body">
            <div class="form-group">
                <label for="addDoctorFullname">Fullname</label>
                <input type="text" id="addDoctorFullname" class="form-control" name="fullname">
            </div>
            <div class="form-group">
                <label for="addDoctortitle">Title</label>
                <input type="text" id="addDoctortitle" class="form-control" name="title">
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
<!-- /modals -->

<!-- Edit modal -->
<div class="modal fade bs-doctor-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="editDoctor">Edit Doctor</h4>
      </div>
      <form id="editDoctorForm">
        <div class="modal-body">
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" id="fullname" class="form-control" name="fullname">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title">
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
<!-- /modals -->
@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js" integrity="sha256-8HGN1EdmKWVH4hU3Zr3FbTHoqsUcfteLZJnVmqD/rC8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>

<script>
  let doctorId;

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
  $('#addDoctorForm').submit(function (e) {
      e.preventDefault();
      let data = $(this).serialize();
      $.ajax({
        url : '/admin/doctor',
        type : 'POST',
        data : data,
        success : function (response) {
            if (response.success) {
                alert('Succesfully add new doctor please wait a couple of seconds...');
                window.location.reload();
            }
        }
      })
  });

  $('.edit-doctor').click(function () {
      let doctor = JSON.parse($(this).attr('data-src'));
      doctorId = doctor.id;
      $('#fullname').val(doctor.fullname);
      $('#title').val(doctor.title);
      $('.bs-doctor-edit-modal').modal('toggle');
  });

  $('#editDoctorForm').submit(function (e) {
      e.preventDefault();
     let formData = $(this).serialize();
     $.ajax({
        url : `/admin/doctor/${doctorId}`,
        type : 'PUT',
        data : formData,
        success : function (response) {
            if (response.success) {
                alert('Doctor information successfully update please wait a couple of seconds.');
                $('.bs-doctor-edit-modal').modal('toggle');
                window.location.reload();
            }
        }
     });
  });

  $('.delete-doctor').click(function () {
      let confirmation = confirm('Are you sure deleting this record?');
      let doctor = JSON.parse($(this).attr('data-src'));
      if (confirmation) {
        $.ajax({
            url : `/admin/doctor/${doctor.id}`,
            type : 'DELETE',
            success : function (response) {
                if (response.success) {
                    alert('Record succesfully deleted please wait a couple of seconds...');
                    window.location.reload();
                }
            }
        });
      }
  });
</script>
@endpush
@endsection