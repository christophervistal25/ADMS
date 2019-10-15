@extends('templates.dashboard-template')
@section('title', '')
@section('content')
@prepend('meta')
	<meta name="noOfTooth" content="{{ $noOfTooth }}">
@endprepend
@prepend('page-css')
@endprepend
<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          {{-- <div class="x_title"> --}}
          	{{-- <h3>Official Receipt</h3> --}}
            {{-- <div class="clearfix"></div> --}}
          {{-- </div> --}}
            <div class="x_content">
            	<div class="spinner-border text-primary text-center" role="status">
					<i class="fa fa-spinner fa-spin" style="font-size:50px"></i>
					<h5>Generating receipt please wait...</h5>
				</div>
              	<form action="/admin/examination/{{$examination->id}}/payment" method="POST" class="hide">
              		@csrf
              		@method('PUT')
              		 <div class="row">
              		 	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              		 		<div class="form-group">
			                    <label for="received_from">Received From <span class="text-danger">*</span></label>
			                    <input type="text" readonly class="form-control" id="received_from" name="received_from" value="{{ $examination->patient->name }}">
			                 </div>
              		 	</div>

              		 	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              		 		<div class="form-group">
			                    <label for="date">Date <span class="text-danger">*</span></label>
			                    <input type="text" readonly class="form-control" id="date" name="date" value="{{ date('m-d-Y') }}">
			                 </div>
              		 	</div>
              		 </div>

              		 <div class="row">
              		 	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              		 		<div class="form-group">
			                    <label for="sc_tin">TIN/SC-TIN</label>
			                    <input type="text" class="form-control" id="sc_tin" name="sc_tin">
			                 </div>
              		 	</div>

              		 	<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              		 		<div class="form-group">
			                    <label for="pwd_id">PWD ID No</label>
			                    <input type="text" readonly class="form-control" id="pwd_id" name="pwd_id">
			                 </div>
              		 	</div>
              		 </div>

              		 <div class="row">
              		 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              		 		<div class="form-group">
			                    <label for="address">Address</label>
			                    <input type="text" class="form-control" id="address" name="address" value="{{ $examination->patient->info->home_address }}">
			                 </div>
              		 	</div>

              		 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              		 		<div class="form-group">
			                    <label for="sum_of">The sum of </label>
			                    <input type="text" readonly class="form-control" id="sum_of" name="sum_of">
			                 </div>
              		 	</div>
              		 </div>
              		 	<div class="row">
	              		 	<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
	              		 		<div class="form-group">
				                    <input type="text" class="form-control" id="in_settlement" placeholder="In settlement of the following" name="in_settlement">
				                 </div>
	              		 	</div>

	              		 	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	              		 		<div class="form-group">
				                    <input type="text" class="form-control" id="in_settlement_price" placeholder="In settlement amount" name="in_settlement_price">
				                 </div>
	              		 	</div>
              		 </div>

              		 <div class="row">
              		 		<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
	              		 		<div class="form-group">
	              		 			<label for="no_of_tooth">No of Tooth</label>
				                    <input readonly type="number" name="no_of_tooth" class="form-control" value="{{ $noOfTooth }}">
				                 </div>
	              		 	</div>
	              		 	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	              		 		<div class="form-group">
	              		 			<label for="service_rendered">Service Rendered</label>
				                    <select name="service_rendered" id="service_rendered" required class="form-control">
									  <option value="{{ $service->name }}" data-price="{{ $service->price }}" data-pereach="{{ $service->per_each }}">{{ $service->name }}</option>
									</select>
				                 </div>
	              		 	</div>

	              		 	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
	              		 		<div class="form-group">
	              		 			<label for="service_amount">Amount</label>
				                    <input type="text" readonly class="form-control" id="service_amount" placeholder="In settlement of the following" name="service_amount">
				                 </div>
	              		 	</div>

	              		 	<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
	              		 		<div class="form-group">
	              		 			<label for="fee">Fee</label>
				                    <input required type="number" id="fee" name="fee" class="form-control" >
				                 </div>
	              		 	</div>
              		 </div>
					<div class="pull-right">
						<input type="submit" value="Generate Receipt" id="btnGenerateReceipt" class="btn btn-primary">
					</div>
					<div class="clearfix"></div>
              	</form>
            </div>
      </div>
    </div>
</div>
@push('page-scripts')
<script>
	$(document).ready(function () {
		$('#service_rendered').trigger('change');
	});

	$('#service_rendered').change(function (e) {
		let serviceFee       = $('#service_rendered option:selected').attr('data-price');
		let noOfTooth        = $('meta[name="noOfTooth"]').attr('content');
		let isServicePerEach =  $('#service_rendered option:selected').attr('data-pereach') == 1 ? true : false;
		if (isServicePerEach) {
			$('#service_amount').val(`${parseInt(serviceFee) * parseInt(noOfTooth)}.00`);
			$('#fee').val(`${parseInt(serviceFee) * parseInt(noOfTooth)}.00`);
		} else {
			$('#fee').val(serviceFee);
			$('#service_amount').val(serviceFee);
		}

		$('#btnGenerateReceipt').trigger('click');
	});
</script>
@endpush
@endsection