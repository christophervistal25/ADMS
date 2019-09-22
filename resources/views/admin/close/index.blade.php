@extends('templates.dashboard-template')
@section('title', 'List of Close days')
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
          <button class="btn btn-success" id="btnAddService"><i class="fa fa-plus"></i> Add Close day</button> 
        </div>
        <table class="table table-striped table-bordered" id="datatable">
          <thead>
                <tr>
                  <td>Date</td>
                  <td>Created on</td>
                  <td>Updated on</td>
                </tr>
          </thead>
          <tbody>
            
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
            <div class="form-group">
                <label for="serviceName">Service Name</label>
                <input type="text" id="serviceName" required class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="servicePrice">Service Price</label>
                <input type="number" id="servicePrice" required class="form-control" name="price">
            </div>

            <div class="form-group">
                <label for="duration">Duration</label>
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
            <div class="form-group">
                <label for="editServiceName">Service Name</label>
                <input type="text" id="editServiceName" required class="form-control" name="name">
            </div>

            <div class="form-group">
                <label for="editServicePrice">Service Price</label>
                <input type="number" id="editServicePrice" required class="form-control" name="price">
            </div>

            <div class="form-group">
                <label for="editDuration">Duration</label>
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

@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js" integrity="sha256-8HGN1EdmKWVH4hU3Zr3FbTHoqsUcfteLZJnVmqD/rC8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
@endpush
@endsection