  @extends('templates.dashboard-template')
  @section('title', "Examination record")
  @section('content')
  @prepend('meta')
  <meta name="teeth_numbers" content="{{ $record->teeths->pluck('tooth_number')->implode('|') }}">
  @endprepend
  @prepend('page-css')
  <style>
      .tooth-chart {
        width: 450px;
      }

      /* On screens that are 1900px or less, set the background color to olive */
    @media screen and (max-width: 1900px) {
      .tooth-chart {
        width : auto;
      }
    }
  </style>

  @endprepend
  <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                      <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">
                          <div id="crop-avatar">
                            <!-- Current avatar -->
                            <img class="img-responsive avatar-view" src="{{ $record->patient->profile }}" alt="Avatar" title="Change the avatar">
                          </div>
                        </div>
                        <h3>{{ $record->patient->firstname }} {{ $record->patient->middlename }} {{ $record->patient->lastname }}</h3>

                        <ul class="list-unstyled user_data">
                          <li><i class="fas fa-fax"></i> {{ $record->patient->email }}
                          </li>

                          <li>
                            <i class="fas fa-mobile"></i> {{ $record->patient->mobile_no }}
                          </li>

                           <li>
                            <i class="fas fa-umbrella"></i> {{ $record->patient->info->home_address }}
                          </li>

                        
                        </ul>
                        <br>
                      </div>
                      <div class="col-md-9 col-sm-9 col-xs-12">

                        <div class="profile_title">
                          <div class="col-md-6">
                            <h2>{{ $record->patient->name }}</h2>
                          </div>
                          <div class="col-md-6">
                            <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                              <span>{{ $record->created_at->format('l jS \\of F h:i A Y')  }}</span> 
                            </div>
                          </div>
                        </div>
                     

                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                          <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class=""><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Tooth Chart</a>
                            </li>
                            <li role="presentation" class="active"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Examination Details</a>
                            </li>
                          </ul>
                          <div id="myTabContent" class="tab-content">

                            <div role="tabpanel" class="tab-pane fade " id="tab_content1" aria-labelledby="home-tab">
                              <div class="row">
                                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                      @include('templates.adult-tooth-chart')
                                  </div>
                                  <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                      <table class="table table-bordered table-responsive">
                                        <thead>
                                          <tr>
                                              <td>Tooth Number</td>
                                              <td>Tooth Description</td>
                                              <td>Surface</td>
                                              <td>Treatment</td>
                                              <td>Status</td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($record->teeths as $tooth)
                                          <tr id="teeth-row-{{$tooth->tooth_number}}">
                                              <td>{{ $tooth->tooth_number }}</td>
                                              <td>{{ $tooth->tooth_description }}</td>
                                              <td>{{ $tooth->surface }}</td>
                                              <td>{{ $tooth->treatment }}</td>
                                              <td>{{ $tooth->status }}</td>
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                  </div>
                              </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="profile-tab">
                                  <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                              <label for="occlusion">Occulusion</label>
                                              <textarea readonly name="occlusion" id="occlusion" cols="30" rows="2" class="form-control">{{ $record->occlusion }}</textarea>    
                                            </div>
                                          </div>

                                          <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                              <label for="periodontal_condition">Periodontal Condtion</label>
                                              <input readonly type="text" name="periodontal_condition" id="periodontal_condition" class="form-control" value=" {{ $record->periodontal_condition }}">
                                            </div>
                                          </div>

                                          <div class="col-lg-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                              <label for="oral_hygiene">Oral Hygiene</label>
                                              <input readonly type="text" name="oral_hygiene" id="oral_hygiene" class="form-control" value="{{ $record->oral_hygiene }}">
                                            </div>
                                          </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                                <input onclick="return {{ $record->denture_upper === 1 ? "false;" : '' }}" type="checkbox" {{ $record->denture_upper === 1 ? 'checked' : 'disabled' }} name="denture_upper" id="denture_upper">
                                                <label for="denture_upper">Denture Upper</label>
                                                <input {{ $record->denture_upper === 1 ? 'readonly' : 'disabled' }} type="number" name="denture_upper_since" id="denture_upper_since" class="form-control" placeholder="Enter denture upper since" value="{{ $record->denture_upper_since }}">
                                              </div>
                                         </div>

                                            <div class="col-lg-3 col-sm-12 col-xs-12">
                                              <input onclick="return {{ $record->denture_lower === 1 ? "false;" : '' }}" type="checkbox" {{ $record->denture_lower === 1 ? 'checked' : 'disabled' }} name="denture_lower" id="denture_lower">
                                                <label for="denture_lower">Denture Lower</label>
                                               <input {{ $record->denture_lower === 1 ? 'readonly' : 'disabled' }} type="number" name="denture_lower_since" id="denture_lower_since" class="form-control" placeholder="Enter denture lower since" value="{{ $record->denture_lower_since }}">
                                            </div>

                                         <p>&nbsp;</p>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                              <label for="abnormalities">Abnormalities</label>
                                              <input readonly type="text" name="abnormalities" id="abnormalities" class="form-control" value="{{ $record->abnormalities }}">
                                            </div>
                                         </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                              <label for="general_condition">General Condition</label>
                                              <input readonly type="text" name="general_condition" id="general_condition" class="form-control" value="{{ $record->general_condition }}">
                                           </div>
                                         </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                              <label for="physician">Physician</label>
                                              <input readonly type="text" name="physician" id="physician" class="form-control" value="{{ $record->physician }}">
                                           </div>
                                         </div>

                                        <div class="col-lg-3 col-sm-12 col-xs-12">
                                          <div class="form-group">
                                              <label for="nature_of_treatment">Nature of Treatment</label>
                                              <input readonly type="text" name="nature_of_treatment" id="nature_of_treatment" class="form-control" value="{{ $record->nature_of_treatment }}">
                                          </div>
                                        </div>
                                        
                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                              <label for="allergies">Allergies</label>
                                              <input readonly type="text" name="allergies" id="allergies" class="form-control" value="{{ $record->allergies }}">
                                          </div>
                                         </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                              <label for="previous_bleeding_history">Previous History of Bleeding</label>
                                              <input readonly type="text" name="previous_bleeding_history" id="previous_bleeding_history" class="form-control" value="{{ $record->history_bleeding }}">
                                         </div>
                                         </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                              <label for="chronic_ailment">Chronic Ailment</label>
                                              <input readonly type="text" name="chronic_ailment" id="chronic_ailment" class="form-control" value="{{ $record->chronic_ailment }}">
                                         </div>
                                         </div>

                                         <div class="col-lg-3 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                              <label for="blood_pressure">Blood Pressure</label>
                                              <input readonly type="text" name="blood_pressure" id="blood_pressure" class="form-control" value="{{ $record->blood_pressure }}">
                                            </div>
                                         </div>

                                         <div class="col-lg-6 col-sm-12 col-xs-12">
                                           <div class="form-group">
                                              <label for="drugs_taken">Drugs Being Taken</label>
                                              <input readonly type="text" name="drugs_taken" id="drugs_taken" class="form-control" value="{{ $record->drugs_taken }}">
                                           </div>
                                         </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
        </div>
      </div>
  </div>


  @push('page-scripts')
  <script>
    let hoveredTeeth = "";
    $(document).ready(function () {
        let teeths = $('meta[name="teeth_numbers"]').attr('content').split("|");

        teeths.forEach(tooth => $(`#Tooth${tooth}`).css('fill', 'yellow') );

        // Make an ID to all teeths
        $('#Tooth' + teeths.join(', #Tooth')).on('mouseover', function (e) {
            // Get the selected teeth number 
            let teethNumber = $(this).attr('data-key');

            $(this).css('cursor', 'pointer');
            $(`#teeth-row-${teethNumber}`).css('background' , 'gray');
            $(`#teeth-row-${teethNumber}`).css('color' , 'white');
            hoveredTeeth = $(this);
        });

        $('#Tooth' + teeths.join(', #Tooth')).on('mouseleave', function (e) {
            let teethNumber = hoveredTeeth.attr('data-key');
            $(`#teeth-row-${teethNumber}`).css('background' , '');
            $(`#teeth-row-${teethNumber}`).css('color' , '');
        });
    });


  </script>
  @endpush
  @endsection