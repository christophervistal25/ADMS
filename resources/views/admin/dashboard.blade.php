@extends('templates.dashboard-template')
@section('title', 'Dashboard')
@section('content')

<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2></h2>
            <div class="clearfix"></div>
          </div>
            <div class="x_content">
                <div id='calendar'></div>
           </div>
      </div>
    </div>
</div>
@endsection