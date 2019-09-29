@extends('templates.dashboard-template')
@section('title', 'List of Service')
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
          <button class="btn btn-primary" id="btnAddService"><i class="fa fa-plus"></i> Add Service</button> 
        </div>
        <table class="table table-striped table-bordered" id="datatable">
          <thead>
                <tr>
                  <td>Name</td>
                  <td>Price</td>
                  <td class="text-center">Per Each</td>
                  <td class="text-center">Service Hour/s</td>
                  <td class="text-center">Actions</td>
                </tr>
          </thead>
          <tbody>
            @foreach($services as $service)
              <tr>
                <td>{{ $service->name }}</td>
                <td class="text-center"><b>{{ $service->price }}</b></td>
                <td class="text-center"><span class="badge"><b>{{ $service->per_each ? 'Yes' : 'No' }}</b></span></td>
                <td class="text-center"><b>{{ $service->duration }}</b></td>
                <td class="text-center">
                  <button class="btn btn-success btn-sm btn-edit-service" data-src="{{ $service }}"><i class="fa fa-edit"></i></button> 
                  <button class="btn btn-danger btn-sm btn-delete-service" data-src="{{ $service }}"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Add Service modal -->
<div class="modal fade bs-add-service-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="AddService">Add Service</h4>
      </div>
      <form id="addServiceForm">
        <div class="modal-body">
          <div class="alert alert-danger hide" id="add-service-error-message"></div>
            <div class="form-group">
                <label for="serviceName">Service Name</label>
                <input type="text" id="serviceName" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="servicePrice">Service Price</label>
                <input type="number" id="servicePrice" class="form-control" name="price">
            </div>

            <div class="form-group">
                <label for="duration">Service Hour/s</label>
                <select name="duration" id="duration" class="form-control">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
            </div>

             <div class="form-group">
                <label for="isServicePerEach">Price per each</label>
                <select name="per_each" id="isServicePerEach" class="form-control">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
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
<!-- /Add Service -->


<!-- Edit Service modal -->
<div class="modal fade bs-edit-service-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="EditService">Edit Service</h4>
      </div>
      <form id="editServiceForm">
        <div class="modal-body">
        <div class="alert alert-danger hide" id="edit-service-error-message"></div>
            <div class="form-group">
                <label for="editServiceName">Service Name</label>
                <input type="text" id="editServiceName"  class="form-control" name="name">
            </div>

            <div class="form-group">
                <label for="editServicePrice">Service Price</label>
                <input type="number" id="editServicePrice"  class="form-control" name="price">
            </div>

            <div class="form-group">
                <label for="editDuration">Service Hour/s</label>
                <select name="duration" id="editDuration" class="form-control">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
            </div>

             <div class="form-group">
                <label for="editIsServicePerEach">Price per each</label>
                <select name="per_each" id="editIsServicePerEach" class="form-control">
                  <option value="false">No</option>
                  <option value="true">Yes</option>
                </select>
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
<!-- /Add Service -->

@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js" integrity="sha256-8HGN1EdmKWVH4hU3Zr3FbTHoqsUcfteLZJnVmqD/rC8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>

<script>
  let serviceId;
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#btnAddService').click(function (e) {
    $('.bs-add-service-modal').modal('toggle');
  });

  $('#addServiceForm').submit(function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
      url : '/admin/service',
      type : 'POST',
      data : data,
      success : function (response) {
          if (response.success) {
              alert('Successfully add new service please wait a couple of seconds.');
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
                $('#add-service-error-message').html(messages);
                $('#add-service-error-message').removeClass('hide');
          }
      }
    })
  });

  $('.btn-edit-service').click(function (e) {
    let service = JSON.parse($(this).attr('data-src'));
    serviceId = service.id;
      $('#editServiceName').val(service.name);
      $('#editServicePrice').val(service.price);
      $('#editIsServicePerEach').val(service.per_each ? 'true' : 'false');
      $('#editDuration').val(service.duration);
      $('.bs-edit-service-modal').modal('toggle');
  });

  $('#editServiceForm').submit(function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
      url : `/admin/service/${serviceId}`,
      type : 'PUT',
      data : data,
      success: function (response) {
          if (response.success) {
            alert('Succesfully update the record please wait a couple of seconds..');
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
                  $('#edit-service-error-message').html(messages);
                  $('#edit-service-error-message').removeClass('hide');
            }
      }
    })
  });

  $('.btn-delete-service').click(function (e) {
      let service = JSON.parse($(this).attr('data-src'));
      let confirmation = confirm('Are you sure that you want to delete this service?');

      if (confirmation) {
        $.ajax({
            url : `/admin/service/${service.id}`,
            type : 'DELETE',
            success: function(response) {
              if (response.success) {
                  alert('Succesfully delete this record please wait a couple of seconds.');
                  window.location.reload();
              }
            }
        })
      }
  });

</script>
@endpush
@endsection