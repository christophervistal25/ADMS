@extends('templates.dashboard-template')
@section('title', 'List of Patients')
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
        <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('patient.create') }}"><i class="fa fa-plus"></i> Add patient</a> 
        </div>
        <table class="table table-striped table-bordered" id="datatable">
          <thead>
                <tr>
                    <td>Patient Number</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Mobile</td>
                    <td>Registered at</td>
                    <td class="text-center">Actions</td>
                </tr>
          </thead>
          <tbody>
              @foreach($patients as $patient)
                <tr>
                    <td class="text-center font-weight-bold">{{ $patient->patient_number }}</td>
                    <td class="text-center">{{ $patient->name }}</td>
                    <td class="text-center">{{ $patient->email }}</td>
                    <td class="text-center">{{ $patient->mobile_no }}</td>
                    <td class="text-center">{{ $patient->created_at->format('l jS \\of F Y') }}</td>
                    <td class="text-center" >
                      <button class="btn btn-sm btn-success btn-edit-info" data-src="{{ $patient }}"><i class="fa fa-user"></i> Information</button>
                      <a class="btn btn-primary btn-sm" href="{{ route('patient.examination.record.create', [$patient->id]) }}"> <i class="fas fa-plus"></i> Add Examination Record</a>
                       <a class="btn btn-info btn-sm" href="{{ route('patient.examination.history', [$patient->id]) }}"> <i class="fas fa-history"></i> Examination Record History <span class="badge" style="color:black;">{{ $patient->examinations_count }}</span> </a>
                    </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Edit Patient Information modal --}}
{{-- DON'T REMOVE THE CLASS OF THIS OR ELSE THE MODAL WILL NOT DISPLAY --}}
{{-- ALSO DON'T CHANGE SOME NAME ATTRIBUTES OF THE FIELDS FILLABLES IN PATIENT MODEL MUST BE EQUAL TO THE NAME ATTRIBUTES OF INPUT FIELDS --}}
<div class="modal bs-edit-patient-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="editPatientInfo">Patient Information</h4>
      </div>
      <form id="editPatientInfoForm">
        <div class="modal-body" id="informationContainer">
            <div class="alert alert-danger hide" id="edit-patient-error-message"></div>
            <div class="form-group">
                <label for="name">Fullname <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" >
              </div>

              <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="email" name="email" >
              </div>

              <div class="form-group">
                <label for="mobile">Mobile No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="mobile" name="mobile_no" >
              </div>

              <div class="form-group">
                <label for="nickname">Nickname <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nickname" name="nickname" >
              </div>

              <div class="form-group">
                <label for="birthdate">Birthdate <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" >
              </div>

              <div class="form-group">
                <label for="martial_status">Martial Status <span class="text-danger">*</span></label>
                <select class="form-control" id="martial_status" name="martial_status">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
              </div>

              <div class="form-group">
                <label for="sex">Sex <span class="text-danger">*</span></label>
                <select class="form-control" id="sex" name="sex">
                    <option value="Women">Women</option>
                    <option value="Men">Men</option>
                    <option value="Choose not to say">Choose not to say</option>
                </select>
              </div>

              <div class="form-group">
                <label for="occupation">Occupation <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="occupation" name="occupation" >
              </div>

              <div class="form-group">
                <label for="home_address">Home Address <span class="text-danger">*</span></label>
                <textarea name="home_address" id="home_address" class="form-control" cols="30" rows="10"></textarea>
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
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $(document).ready(function() {
    let patientInformation;
    $('.btn-edit-info').click(function () {        
        patientInformation = JSON.parse($(this).attr('data-src'));
        // Get all the input fields in edit modal
        let inputFields = $('#informationContainer').children().find('input');

        $('#home_address').val(patientInformation.info.home_address);

        inputFields.map((index, element) => {
          let name = $(element).attr('name');
          if (patientInformation.hasOwnProperty(name)) {
            // set field values for basic information of patient.
              $(element).val(patientInformation[name]);
          } else {
              // Set field values for patient other information.
              $(element).val(patientInformation.info[name]);
          }
        });

        // Open the modal
        $('.bs-edit-patient-info-modal').modal('toggle');
    });

    $('#editPatientInfoForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
          url : `/admin/patient/${patientInformation.id}`,
          type : 'PUT',
          data : $(this).serialize(),
          success : function (response) {
              if (response.success) {
                  alert('Succesfully update the information of patient please wait a couple of seconds...');
                  window.location.reload();
              }
          },
          error : function (response) {
             if (response.status === 422) {
                let errors = response.responseJSON.errors;
                let messages = "";
                  Object.values(errors).forEach((error) => {
                      messages += `<li>${error}</li>`;
                  });
                  $('#edit-patient-error-message').html(messages);
                  $('#edit-patient-error-message').removeClass('hide');
            }
          }
        });
    });
  });
</script>
@endpush
@endsection