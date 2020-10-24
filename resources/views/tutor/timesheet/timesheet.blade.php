@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">Time Sheet</h1>
@endsection

@section('body')
<div class="section-body mt-3">
  <div class="container-fluid">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="page-subtitle ml-0">1 - 10 of 12 Record</div>
            <div class="page-options d-flex">
              <select class="form-control custom-select w-auto">
                <option value="asc">- Select -</option>
                <option value="asc">Semester 1</option>
                <option value="desc">Semester 2</option>
              </select>
              <div class="input-icon ml-2">
                <span class="input-icon-addon">
                  <i class="fe fe-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Search">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-12">
        <div class="card bg-none b-none">
          <div class="card-body pt-0">
            <div class="table-responsive" style="max-height:800px;">
              <table class="table table-hover table-vcenter table_custom spacing5 text-nowrap mb-0">
                <thead>
                  <tr>
                    <th></th>
                    <th>Unit of Study</th>
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
                      <td>{{$schedule->uos_code}} {{$schedule->uos_name}}</td>
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
</div>
@endsection

@section('script')
<script>
</script>
@endsection
