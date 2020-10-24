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
<div class="section-body mt-3">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-3">
        <div class="card">
          <div class="card-body">
            <div class="media">
              {{getUserIcon($db_user->user_first_name, $db_user->user_last_name, "xl")}}
              <div class="media-body ml-3">
                <h5 class="m-0">{{$db_user->user_first_name}} {{$db_user->user_last_name}}</h5>
                <p class="text-muted mb-2">{{$db_user->user_id}}</p>
                @foreach($db_tutorials as $tutorial)
                  {{getTutorialTag($tutorial->tutorial_name, $tutorial->tutorial_day_in_week)}}
                @endforeach
              </div>
            </div>
          </div>
        </div>
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
              <div class="modal fade" id="newScheduleModal" tabindex="-1" role="dialog" aria-labelledby="newScheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header pb-0" style="border-bottom:0px;">
                      <div class="row clearfix">
                        <div class="col-12">
                          <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="pills-tutorial-tab" data-toggle="pill" href="#pills-tutorial" role="tab" aria-controls="pills-tutorial" aria-selected="true">Tutorial Schedule</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="pills-other-tab" data-toggle="pill" href="#pills-other" role="tab" aria-controls="pills-other" aria-selected="false">Other Schedule</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body pb-4 pt-1">
                      <div class="row">
                        <div class="col-12">
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-tutorial" role="tabpanel" aria-labelledby="pills-tutorial-tab">
                              <form action="/coordinator/uos/page/tutor/timesheet/tutorial/store" method="post">
                                @csrf
                                <div class="row">
                                  <div class="col-12">
                                    <div class="form-group">
                                      <div class="form-label">Tutorials</div>
                                      <div>
                                        @foreach($db_tutorials as $tutorial)
                                          <label class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" name="tutorial_ids[]" value="{{$tutorial->tutorial_id}}" checked>
                                            <span class="custom-control-label">{{$tutorial->tutorial_name}}</span>
                                          </label>
                                        @endforeach
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
                                  <div class="col-12 mt-2">
                                    <input type="hidden" name="schedule_user" value="{{$db_user->user_id}}">
                                    <input type="submit" class="btn btn-primary btn-block" value="Add">
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="tab-pane fade" id="pills-other" role="tabpanel" aria-labelledby="pills-other-tab">
                              <form action="/coordinator/uos/page/tutor/timesheet/other/store" method="post">
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
                                      <div class="form-label">Schedule Duration (Hour)</div>
                                      <div>
                                        <input type="number" class="form-control" name="schedule_allocated_duration" value="1" placeholder="Schedule Duration.." min="0.0" step="0.1" required autocomplete="off">
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
                                    <input type="hidden" name="schedule_user" value="{{$db_user->user_id}}">
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
                    </tr>
                  @empty
                      <tr class="text-center"><td colspan="6">No Schedule</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
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
