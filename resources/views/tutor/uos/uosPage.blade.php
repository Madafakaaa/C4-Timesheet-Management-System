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
              <div class="col-lg-4 col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="widgets1">
                      <div class="icon">
                        <i class="fe fe-list text-info font-30"></i>
                      </div>
                      <div class="details">
                        <h6 class="mb-0 font600">Total Allocated Hours</h6>
                        <span class="mb-0">11 Hours</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <div class="widgets1">
                      <div class="icon">
                        <i class="fe fe-clock text-success font-30"></i>
                      </div>
                      <div class="details">
                        <h6 class="mb-0 font600">Total Working Hours</h6>
                        <span class="mb-0">6.7 Hours</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header pb-0">
                    <h3 class="card-title">Statistics</h3>
                    <div class="card-options">
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                      <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="text-center">
                      <div class="row">
                        <div class="col-6 pb-3">
                          <label class="mb-0">Working Hours</label>
                          <h4 class="font-30 font-weight-bold">6.7</h4>
                        </div>
                        <div class="col-6 pb-3">
                          <label class="mb-0">Completion</label>
                          <h4 class="font-30 font-weight-bold">74.4%</h4>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="d-block">Week 1<span class="float-right">100%</span></label>
                      <div class="progress progress-xs">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="d-block">Week 2<span class="float-right">90%</span></label>
                      <div class="progress progress-xs">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="d-block">Week 3<span class="float-right">0%</span></label>
                      <div class="progress progress-xs">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="d-block">Week 4<span class="float-right">100%</span></label>
                      <div class="progress progress-xs">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="d-block">Week 5<span class="float-right">0%</span></label>
                      <div class="progress progress-xs">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8 col-md-12">
                <div class="card mb-0">
                  <div class="card-header">
                    <h3 class="card-title">Time Sheet</h3>
                  </div>
                </div>
                <div class="card bg-none b-none">
                  <div class="card-body pt-0">
                    <div class="table-responsive">
                      <table class="table table-hover table-vcenter table_custom spacing5 text-nowrap mb-0">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Schedule Name</th>
                            <th>Week</th>
                            <th>Due Date</th>
                            <th class="text-right">Working / Allocated Hours</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <i class="fe fe-book text-success"></i>
                            </td>
                            <td>Tutorial - Mon10A</td>
                            <td>Week 1</td>
                            <td><span>Oct 7, 2020</span></td>
                            <td>
                              <div class="form-group text-right text-success">
                                <label>2H / 2H</label>
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <i class="fe fe-check-square text-danger"></i>
                            </td>
                            <td>Quiz 1</td>
                            <td>Week 2</td>
                            <td><span>Oct 38, 2020</span></td>
                            <td>
                              <div class="form-group text-right text-danger">
                                <label>1.5H / 1H</label>
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="150" aria-valuemin="0" aria-valuemax="100" style="width: 150%;"></div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <i class="fe fe-book text-warning"></i>
                            </td>
                            <td>Tutorial - Mon10A</td>
                            <td>Week 2</td>
                            <td><span>Oct 14, 2020</span></td>
                            <td>
                              <div class="form-group text-right text-warning">
                                <label>1.2H / 2H</label>
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <i class="fe fe-book"></i>
                            </td>
                            <td>Tutorial - Mon10A</td>
                            <td>Week 3</td>
                            <td><span>Oct 21, 2020</span></td>
                            <td>
                              <div class="form-group text-right">
                                <label>- / 2H</label>
                                <div class="progress progress-xs">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <i class="fe fe-book text-success"></i>
                            </td>
                            <td>Tutorial - Mon10A</td>
                            <td>Week 4</td>
                            <td><span>Oct 28, 2020</span></td>
                            <td>
                              <div class="form-group text-right text-success">
                                <label>2H / 2H</label>
                                <div class="progress progress-xs">
                                  <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <i class="fe fe-book"></i>
                            </td>
                            <td>Tutorial - Mon10A</td>
                            <td>Week 5</td>
                            <td><span>Nov 4, 2020</span></td>
                            <td>
                              <div class="form-group text-right">
                                <label>- / 2H</label>
                                <div class="progress progress-xs">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                </div>
                              </div>
                            </td>
                          </tr>
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
