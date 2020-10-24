@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">{{ $db_uos->uos_code }} {{ $db_uos->uos_name }} <small>{{ $db_uos->semester_name }}</small></h1>
@endsection

@section('body')
<div class="section-body">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card card-profile mb-0">
          <div class="card-body text-center py-0">
            <img class="card-profile-img" src="../assets/images/sm/avatar1.jpg" alt="" />
            <h4 class="mb-3">{{ $db_uos->uos_code }} {{ $db_uos->uos_name }}</h4>
            <h5 class="mb-3">{{ $db_uos->semester_name }}</h5>
            <p class="mb-4">{{ $db_uos->uos_description }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section-body py-1">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-12">
        <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-timesheet-tab" data-toggle="pill" href="#pills-timesheet" role="tab" aria-controls="pills-timesheet" aria-selected="false">My Timesheet</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-tutorial-tab" data-toggle="pill" href="#pills-tutorial" role="tab" aria-controls="pills-tutorial" aria-selected="false">My Tutorial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-preference-tab" data-toggle="pill" href="#pills-preference" role="tab" aria-controls="pills-preference" aria-selected="true">Tutorial Preference</a>
          </li>
        </ul>
      </div>
      <div class="col-12">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-timesheet" role="tabpanel" aria-labelledby="pills-timesheet-tab">
            <div class="row clearfix">
              <div class="col-3">
                <div class="card">
                  <div class="card-body px-2">
                    <div class="widgets1">
                      <div class="icon">
                        <i class="fe fe-clock text-success font-30"></i>
                      </div>
                      <div class="details">
                        <h6 class="mb-0 font600">{{$schedule_actual_duration_sum_now}} Hours</h6>
                        <span class="mb-0">Total Working Hours <br>Til {{date('Y-m-d')}}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body px-2">
                    <div class="widgets1">
                      <div class="icon">
                        <i class="fe fe-list text-info font-30"></i>
                      </div>
                      <div class="details">
                        <h6 class="mb-0 font600">{{$schedule_allocated_duration_sum_now}} Hours</h6>
                        <span class="mb-0">Total Allocated Hours <br>Til {{date('Y-m-d')}}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Statistics</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      <div class="row">
                        <div class="col-6 pb-3">
                          <label class="mb-0">Working Hours</label>
                          <h4 class="font-30 font-weight-bold">{{$schedule_actual_duration_sum_now}}</h4>
                        </div>
                        <div class="col-6 pb-3">
                          <label class="mb-0">Completion</label>
                          <h4 class="font-30 font-weight-bold">
                          @if($schedule_allocated_duration_sum_now!=0)
                            {{round($schedule_actual_duration_sum_now/$schedule_allocated_duration_sum_now*100,1)}}%
                          @else
                            -
                          @endif
                          </h4>
                        </div>
                      </div>
                    </div>
                    @foreach($db_weekly_schedules as $weekly_schedule)
                      <div class="form-group">
                        <label class="d-block">{{$weekly_schedule->week_name}}<span class="float-right">{{round($weekly_schedule->schedule_actual_duration_sum/$weekly_schedule->schedule_allocated_duration_sum*100,1)}}%</span></label>
                        <div class="progress progress-xs">
                          @if($weekly_schedule->schedule_actual_duration_sum==0)
                            <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                          @elseif($weekly_schedule->schedule_actual_duration_sum<$weekly_schedule->schedule_allocated_duration_sum)
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{round($weekly_schedule->schedule_actual_duration_sum/$weekly_schedule->schedule_allocated_duration_sum*100,1)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round($weekly_schedule->schedule_actual_duration_sum/$weekly_schedule->schedule_allocated_duration_sum*100,1)}}%;"></div>
                          @elseif($weekly_schedule->schedule_actual_duration_sum==$weekly_schedule->schedule_allocated_duration_sum)
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                          @else
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                          @endif
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="col-9">
                <div class="card mb-0">
                  <div class="card-header">
                    <h3 class="card-title">Time Sheet</h3>
                    <div class="card-options">

                      <a class="text-primary" data-toggle="modal" data-target="#newScheduleModal"><i class="fa fa-plus" data-toggle="tooltip" data-placement="right" title="Add New"></i></a>
                      <!-- Modal -->
                      <div class="modal fade" id="newScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="/tutor/uos/page/timesheet/store" method="post">
                                @csrf
                                <div class="row">
                                  <div class="col-12">
                                    <div class="form-group">
                                      <div class="form-label">Schedule Name</div>
                                      <div>
                                        <input type="text" class="form-control" name="schedule_name" placeholder="Schedule Name.." max-length="50" required autocomplete="off">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                      <div class="form-label">Working Duration (Hour)</div>
                                      <div>
                                        <input type="number" class="form-control" name="schedule_actual_duration" value="1" placeholder="Schedule Duration.." min="0.0" step="0.1" required autocomplete="off">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                      <div class="form-label">Weeks</div>
                                      <div>
                                        @foreach($db_weeks as $db_week)
                                          <label class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" name="week_ids[]" value="{{$db_week->week_id}}" checked>
                                            <span class="custom-control-label">{{$db_week->week_name}}</span>
                                          </label>
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                      <div class="form-label">Schedule Type</div>
                                      <div class="custom-controls-stacked">
                                        <label class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" class="custom-control-input" name="schedule_is_marking" value="1" checked>
                                          <span class="custom-control-label">Marking</span>
                                        </label>
                                        <label class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" class="custom-control-input" name="schedule_is_marking" value="0">
                                          <span class="custom-control-label">Non-marking</span>
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <input type="hidden" name="schedule_uos" value="{{$db_uos->uos_id}}">
                                    <input type="hidden" name="schedule_user" value="{{Session::get('user_id')}}">
                                    <input type="submit" class="btn btn-primary btn-block" value="Add">
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
                <div class="card bg-none b-none">
                  <div class="card-body pt-0">
                    <div class="table-responsive" style="max-height:800px;">
                      <table class="table table-hover table-vcenter table_custom spacing5 text-nowrap mb-0">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Schedule Name</th>
                            <th>Week</th>
                            <th>Due Date</th>
                            <th class="text-right">Working Hours</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($db_schedules as $schedule)
                            <tr>
                              <td>
                                @if($schedule->schedule_is_marking==1)
                                  <i class="fe fe-check-square"></i>
                                @else
                                  <i class="fe fe-book"></i>
                                @endif
                              </td>
                              <td>{{$schedule->schedule_name}}</td>
                              <td>{{$schedule->week_name}}</td>
                              <td><span>{{$schedule->schedule_due_date}}</span></td>
                              <td>
                                <div class="form-group text-right">
                                  <label>{{$schedule->schedule_actual_duration}}H / {{$schedule->schedule_allocated_duration}}H</label>
                                  <div class="progress progress-xs">
                                    @if($schedule->schedule_allocated_duration!=0)
                                      @if($schedule->schedule_status==0)
                                        <div class="progress-bar bg-grey" role="progressbar" aria-valuenow="{{round($schedule->schedule_actual_duration/$schedule->schedule_allocated_duration*100,1)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round($schedule->schedule_actual_duration/$schedule->schedule_allocated_duration*100,1)}}%;"></div>
                                      @elseif($schedule->schedule_status==1)
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{round($schedule->schedule_actual_duration/$schedule->schedule_allocated_duration*100,1)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round($schedule->schedule_actual_duration/$schedule->schedule_allocated_duration*100,1)}}%;"></div>
                                      @elseif($schedule->schedule_status==2)
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{round($schedule->schedule_actual_duration/$schedule->schedule_allocated_duration*100,1)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round($schedule->schedule_actual_duration/$schedule->schedule_allocated_duration*100,1)}}%;"></div>
                                      @else
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{round($schedule->schedule_actual_duration/$schedule->schedule_allocated_duration*100,1)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{round($schedule->schedule_actual_duration/$schedule->schedule_allocated_duration*100,1)}}%;"></div>
                                      @endif
                                    @else
                                      @if($schedule->schedule_status==0)
                                        <div class="progress-bar bg-grey" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                      @elseif($schedule->schedule_status==1)
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                      @elseif($schedule->schedule_status==2)
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                      @else
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                              </td>
                              <td>
                                @if($schedule->schedule_status==0)
                                  <span class="status-icon bg-default"></span>Proposed Hour Pending
                                @elseif($schedule->schedule_status==1)
                                  <span class="status-icon bg-primary"></span>Due in {{$schedule->week_name}}
                                @elseif($schedule->schedule_status==2)
                                  <span class="status-icon bg-danger"></span>Working Hour Pending
                                @else
                                  <span class="status-icon bg-success"></span>Pass
                                @endif
                              </td>
                              <td class="text-right">
                                @if($schedule->schedule_status==1)
                                  <!-- Button trigger modal -->
                                  <button type="button" class="btn btn-sm btn-link hidden-xs" data-toggle="modal" data-target="#scheduleModal-{{$schedule->schedule_id}}">
                                      <i class="fe fe-edit text-primary"></i>
                                  </button>
                                  <!-- Modal -->
                                  <div class="modal fade text-left" id="scheduleModal-{{$schedule->schedule_id}}" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel-{{$schedule->schedule_id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="scheduleModalLabel-{{$schedule->schedule_id}}">{{$schedule->schedule_name}}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="/tutor/uos/page/timesheet/update" method="post">
                                            @csrf
                                            <div class="row">
                                              <div class="col-12">
                                                <div class="form-group">
                                                  <div class="form-label">Working Duration (Hour)</div>
                                                  <div>
                                                    <input type="number" class="form-control" name="schedule_actual_duration" value="{{$schedule->schedule_allocated_duration}}" min="0.0" step="0.1" required autocomplete="off">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-12 mt-2">
                                                <input type="hidden" name="schedule_id" value="{{$schedule->schedule_id}}">
                                                <input type="submit" class="btn btn-primary btn-block" value="Submit">
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @elseif($schedule->schedule_status==3)
                                  @if($schedule->schedule_allocated_duration>=$schedule->schedule_actual_duration)
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-link hidden-xs" data-toggle="modal" data-target="#scheduleModal-{{$schedule->schedule_id}}">
                                        <i class="fe fe-edit text-primary"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade text-left" id="scheduleModal-{{$schedule->schedule_id}}" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel-{{$schedule->schedule_id}}" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="scheduleModalLabel-{{$schedule->schedule_id}}">{{$schedule->schedule_name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="/tutor/uos/page/timesheet/update" method="post">
                                              @csrf
                                              <div class="row">
                                                <div class="col-12">
                                                  <div class="form-group">
                                                    <div class="form-label">Working Duration (Hour)</div>
                                                    <div>
                                                      <input type="number" class="form-control" name="schedule_actual_duration" value="{{$schedule->schedule_allocated_duration}}" min="0.0" step="0.1" required autocomplete="off">
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                  <input type="hidden" name="schedule_id" value="{{$schedule->schedule_id}}">
                                                  <input type="submit" class="btn btn-primary btn-block" value="Submit">
                                                </div>
                                              </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  @endif
                                @endif
                              </td>
                            </tr>
                          @empty
                            <tr class="text-center"><td colspan="7">No Schedule</td></tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="tab-pane fade" id="pills-tutorial" role="tabpanel" aria-labelledby="pills-tutorial-tab">
            <div class="row clearfix">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body py-2">
                    <div class="d-md-flex justify-content-between">
                      <ul class="nav nav-tabs b-none">
                        <li class="nav-item"><a class="nav-link active" id="list-tab" data-toggle="tab" href="#tutorial_calendar"><i class="fa fa-th"></i> Grid</a></li>
                        <li class="nav-item"><a class="nav-link" id="list-tab" data-toggle="tab" href="#tutorial_list"><i class="fa fa-list-ul"></i> List</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tutorial_calendar" role="tabpanel">
                <div class="row">
                  @forelse($array_tutorials as $tutorial)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                      <div class="card">
                        <div class="card-body pb-3">
                          <div class="mb-1">
                            {{getTutorialTag($tutorial['tutorial_name'], $tutorial['tutorial_day_in_week'])}}
                            <p class="mt-3 mb-0"><i class="fe fe-clock"></i> {{ date('H:i', strtotime($tutorial['tutorial_start_time'])) }} - {{ date('H:i', strtotime($tutorial['tutorial_end_time'])) }} | {{ dateToDay($tutorial['tutorial_day_in_week']) }} </p>
                            <span><i class="fe fe-navigation"></i> {{$tutorial['tutorial_location']}}</span>
                          </div>
                          <span class="font-12 text-muted">Casual Academics</span>
                          <div class="avatar-list mt-1">
                            @foreach($tutorial['tutors'] as $tutor)
                              {{getUserIcon($tutor['user_first_name'], $tutor['user_last_name'])}}
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  @empty
                    <div class="col-12">
                      <div class="text-muted text-center">No Tutorial</div>
                    </div>
                  @endforelse
                </div>
              </div>
              <div class="tab-pane fade" id="tutorial_list" role="tabpanel">
                <div class="table-responsive">
                  <table class="table table-hover table-vcenter text-nowrap table_custom list">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Tutorial</th>
                        <th>Time</th>
                        <th>Casual Academic</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($array_tutorials as $tutorial)
                        <tr>
                          <td class="text-center width40">
                            {{getTutorialTag($tutorial['tutorial_name'], $tutorial['tutorial_day_in_week'])}}
                          </td>
                          <td>
                            <div><a href="javascript:void(0);">{{$tutorial['tutorial_name']}}</a></div>
                            <div class="text-muted"><i class="fe fe-navigation"></i> {{$tutorial['tutorial_location']}}</div>
                          </td>
                          <td class="hidden-xs">
                            <div class="text-muted">{{ dateToDay($tutorial['tutorial_day_in_week']) }} {{ date('H:i', strtotime($tutorial['tutorial_start_time'])) }} - {{ date('H:i', strtotime($tutorial['tutorial_end_time'])) }}</div>
                          </td>
                          <td class="hidden-xs">
                            @foreach($tutorial['tutors'] as $tutor)
                            {{getUserIcon($tutor['user_first_name'], $tutor['user_last_name'])}}
                            @endforeach
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td class="hidden-xs" colspan="4">
                            <div class="text-muted text-center">No Tutorial</div>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="pills-preference" role="tabpanel" aria-labelledby="pills-preference-tab">
            <form action="/tutor/uos/page/preference/store" method="post" name="form1" onsubmit="submitButtonDisable('submitButton1')">
              @csrf
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                      <div class="form-group multiselect_div">
                        <label class="form-label">Preference 1</label>
                        <select name="preference_casual_academic_tutorial_1" class="single-selection multiselect multiselect-custom" required autocomplete="off">
                          <option value="">Choose Tutorial...</option>
                          @foreach($all_tutorials as $tutorial)
                            <option value="{{$tutorial->tutorial_id}}" @if($preferences[0]==$tutorial->tutorial_id) selected @endif>{{$tutorial->tutorial_name}} [ {{ dateToDay($tutorial->tutorial_day_in_week) }} {{ date('H:i', strtotime($tutorial->tutorial_start_time)) }} - {{ date('H:i', strtotime($tutorial->tutorial_end_time)) }} ]</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                      <div class="form-group multiselect_div">
                        <label class="form-label">Preference 2</label>
                        <select name="preference_casual_academic_tutorial_2" class="single-selection multiselect multiselect-custom" required autocomplete="off">
                          <option value="">Choose Tutorial...</option>
                          @foreach($all_tutorials as $tutorial)
                            <option value="{{$tutorial->tutorial_id}}" @if($preferences[1]==$tutorial->tutorial_id) selected @endif>{{$tutorial->tutorial_name}} [ {{ dateToDay($tutorial->tutorial_day_in_week) }} {{ date('H:i', strtotime($tutorial->tutorial_start_time)) }} - {{ date('H:i', strtotime($tutorial->tutorial_end_time)) }} ]</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                      <div class="form-group multiselect_div">
                        <label class="form-label">Preference 3</label>
                        <select name="preference_casual_academic_tutorial_3" class="single-selection multiselect multiselect-custom" required autocomplete="off">
                          <option value="">Choose Tutorial...</option>
                          @foreach($all_tutorials as $tutorial)
                            <option value="{{$tutorial->tutorial_id}}" @if($preferences[2]==$tutorial->tutorial_id) selected @endif>{{$tutorial->tutorial_name}} [ {{ dateToDay($tutorial->tutorial_day_in_week) }} {{ date('H:i', strtotime($tutorial->tutorial_start_time)) }} - {{ date('H:i', strtotime($tutorial->tutorial_end_time)) }} ]</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-8"></div>
                    <div class="col-2">
                      <div class="form-group">
                        <input type="hidden" name="tutorial_uos" value="{{$db_uos->uos_id}}">
                        <button type="submit" class="btn btn-primary btn-block" id="submitButton1">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection
