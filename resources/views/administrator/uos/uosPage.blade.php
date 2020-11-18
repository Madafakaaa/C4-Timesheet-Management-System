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
            <a class="nav-link active" id="pills-coordinator-tab" data-toggle="pill" href="#pills-coordinator" role="tab" aria-controls="pills-coordinator" aria-selected="true">Coordinators</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-tutor-tab" data-toggle="pill" href="#pills-tutor" role="tab" aria-controls="pills-tutor" aria-selected="false">Casual Academics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-tutorial-tab" data-toggle="pill" href="#pills-tutorial" role="tab" aria-controls="pills-tutorial" aria-selected="false">Tutorials</a>
          </li>
        </ul>
      </div>
      <div class="col-12">
        <div class="tab-content" id="pills-tabContent">

          <div class="tab-pane fade show active" id="pills-coordinator" role="tabpanel" aria-labelledby="pills-coordinator-tab">
            <div class="row clearfix">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body py-2">
                    <div class="d-md-flex justify-content-between">
                      <ul class="nav nav-tabs b-none">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#coordinator_list"><i class="fa fa-list-ul"></i> List</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#coordinator_add_new"><i class="fa fa-plus"></i> Add New</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="coordinator_list" role="tabpanel">
                <div class="table-responsive">
                  <table class="table table-hover table-vcenter text-nowrap table_custom list">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Coordinator</th>
                        <th>Email</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($db_coordinators as $db_coordinator)
                        <tr>
                          <td class="text-center width40">
                            {{getUserIcon($db_coordinator->user_first_name, $db_coordinator->user_last_name)}}
                          </td>
                          <td>
                            <div><a href="javascript:void(0);">{{$db_coordinator->user_first_name}} {{$db_coordinator->user_last_name}}</a></div>
                            <div class="text-muted">{{$db_coordinator->user_id}}</div>
                          </td>
                          <td class="hidden-xs">
                            <div class="text-muted">{{$db_coordinator->user_email}}</div>
                          </td>
                          <td class="text-right">
                            <a class="btn btn-sm btn-link hidden-xs" href="/administrator/uos/page/coordinator/delete?user_id={{$db_coordinator->user_id}}&uos_id={{$db_uos->uos_id}}"><i class="fa fa-trash text-danger"></i></a>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td class="hidden-xs" colspan="4">
                            <div class="text-muted text-center">No Coordinator</div>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="coordinator_add_new" role="tabpanel">
                <div class="card pb-0">
                  <div class="card-body">
                    <form action="/administrator/uos/page/coordinator/store" method="post" id="form1" name="form1" onsubmit="submitButtonDisable('submitButton1')">
                      @csrf
                      <div class="row clearfix">
                        <div class="col-9">
                          <div class="form-group multiselect_div">
                            <select name="uos_coordinator_user" class="single-selection multiselect multiselect-custom" required autocomplete="off">
                              <option value="">Choose Coordinator</option>
                              @foreach($coordinator_users as $db_user)
                                <option value="{{$db_user->user_id}}">{{$db_user->user_first_name}} {{$db_user->user_last_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-3">
                          <input type="hidden" name="uos_coordinator_uos" value="{{$db_uos->uos_id}}">
                          <button type="submit" class="btn btn-primary btn-block" id="submitButton1">Add</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="pills-tutor" role="tabpanel" aria-labelledby="pills-tutor-tab">
            <div class="row clearfix">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body py-2">
                    <div class="d-md-flex justify-content-between">
                      <ul class="nav nav-tabs b-none">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tutor_list"><i class="fa fa-list-ul"></i> List</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tutor_add_new"><i class="fa fa-plus"></i> Add New</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tutor_list" role="tabpanel">
                <div class="table-responsive">
                  <table class="table table-hover table-vcenter text-nowrap table_custom list">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Casual Academic</th>
                        <th>Email</th>
                        <th>Tutorials</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($array_tutors as $tutor)
                        <tr>
                          <td class="text-center width40">
                            {{getUserIcon($tutor['user_first_name'], $tutor['user_last_name'])}}
                          </td>
                          <td>
                            <div><a href="javascript:void(0);">{{$tutor['user_first_name']}} {{$tutor['user_last_name']}}</a></div>
                            <div class="text-muted">{{$tutor['user_id']}}</div>
                          </td>
                          <td class="hidden-xs">
                            <div class="text-muted">{{$tutor['user_email']}}</div>
                          </td>
                          <td class="hidden-xs">
                             @foreach($tutor['tutorials'] as $tutorial)
                               {{getTutorialTag($tutorial['tutorial_name'], $tutorial['tutorial_day_in_week'])}}
                             @endforeach
                          </td>
                          <td class="text-left">
                            <a class="btn btn-sm btn-link hidden-xs" href="/administrator/uos/page/tutor/timesheet?user_id={{$tutor['user_id']}}&uos_id={{$db_uos->uos_id}}"><i class="fa fa-list text-primary"></i></a>
                            <a class="btn btn-sm btn-link hidden-xs" href="/administrator/uos/page/tutor/delete?user_id={{$tutor['user_id']}}&uos_id={{$db_uos->uos_id}}"><i class="fa fa-trash text-danger"></i></a>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td class="hidden-xs" colspan="4">
                            <div class="text-muted text-center">No Casual Academic</div>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="tutor_add_new" role="tabpanel">
                <div class="card pb-0">
                  <div class="card-body">
                    <form action="/administrator/uos/page/tutor/store" method="post" id="form1" name="form1" onsubmit="submitButtonDisable('submitButton1')">
                      @csrf
                      <div class="row clearfix">
                        <div class="col-9">
                          <div class="form-group multiselect_div">
                            <select name="uos_casual_academic_user" class="single-selection multiselect multiselect-custom" required autocomplete="off">
                              <option value="">Choose Casual Academic</option>
                              @foreach($tutor_users as $db_user)
                                <option value="{{$db_user->user_id}}">{{$db_user->user_first_name}} {{$db_user->user_last_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-3">
                          <input type="hidden" name="uos_casual_academic_uos" value="{{$db_uos->uos_id}}">
                          <button type="submit" class="btn btn-primary btn-block" id="submitButton1">Add</button>
                        </div>
                      </div>
                    </form>
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
                        <li class="nav-item"><a class="nav-link" id="addnew-tab" data-toggle="tab" href="#tutorial_add_new"><i class="fa fa-plus"></i> Add New</a></li>
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
                            <!-- Button trigger modal -->
                            <span class="avatar avatar-red text-white" data-toggle="modal" data-target="#addTutorModal_{{$tutorial['tutorial_id']}}" style="cursor:pointer;">+</span>
                            <!-- Modal -->
                            <div class="modal fade" id="addTutorModal_{{$tutorial['tutorial_id']}}" tabindex="-1" role="dialog" aria-hidden="true">
                              <form action="/administrator/uos/page/tutorial/tutor/store" method="post">
                                @csrf
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">{{$tutorial['tutorial_name']}}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-12">
                                          <div class="form-group">
                                            <label class="form-label">New Tutor</label>
                                            <div class="form-group multiselect_div">
                                              <select name="tutorial_casual_academic_user" class="single-selection multiselect multiselect-custom" required autocomplete="off">
                                                <option value="">Choose Tutor</option>
                                                @if(count($tutorial['candidates'])>0)
                                                  <optgroup label="Tutors With Preference">
                                                    @foreach($tutorial['candidates'] as $candidate)
                                                      <option value="{{$candidate->user_id}}">{{$candidate->user_first_name}} {{$candidate->user_last_name}} [ Preference: {{$candidate->preference_casual_academic_rank}} ]</option>
                                                    @endforeach
                                                  </optgroup>
                                                @endif
                                                @if(count($tutorial['other_candidates'])>0)
                                                  <optgroup label="Tutors Without Preference">
                                                    @foreach($tutorial['other_candidates'] as $candidate)
                                                      <option value="{{$candidate->user_id}}">{{$candidate->user_first_name}} {{$candidate->user_last_name}}</option>
                                                    @endforeach
                                                  </optgroup>
                                                @endif
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <input type="hidden" name="tutorial_casual_academic_tutorial" value="{{$tutorial['tutorial_id']}}">
                                      <button type="submit" class="btn btn-primary">Add tutor</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
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
                        <th></th>
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
                          <td class="text-right">
                            <a class="btn btn-sm btn-link hidden-xs" href="/administrator/uos/page/tutorial/delete?tutorial_id={{$tutorial['tutorial_id']}}"><i class="fa fa-trash text-danger"></i></a>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td class="hidden-xs" colspan="5">
                            <div class="text-muted text-center">No Tutorial</div>
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="tutorial_add_new" role="tabpanel">
                <div class="card pb-0">
                  <div class="card-body">
                    <form action="/administrator/uos/page/tutorial/store" method="post" id="form1" name="form1" onsubmit="submitButtonDisable('submitButton1')">
                      @csrf
                      <div class="row clearfix">
                        <div class="col-6">
                          <div class="form-group">
                            <label class="form-label">Tutorial Name</label>
                            <input type="text" class="form-control" name="tutorial_name" maxlength="15" placeholder="Tutorial Name..." autocomplete="off" required>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label class="form-label">Day in week</label>
                            <select name="tutorial_day_in_week" class="select-beast form-control custom-select" required>
                              <option value="">Day in week...</option>
                              <option value="0">Sunday</option>
                              <option value="1">Monday</option>
                              <option value="2">Tuesday</option>
                              <option value="3">Wednesday</option>
                              <option value="4">Thursday</option>
                              <option value="5">Friday</option>
                              <option value="6">Saturday</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="demo-masked-input">
                            <div class="form-group">
                              <label class="form-label">Start Time</label>
                              <input type="text" class="form-control time24" name="tutorial_start_time" placeholder="Eg: 23:59" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="demo-masked-input">
                            <div class="form-group">
                              <label class="form-label">End Time</label>
                              <input type="text" class="form-control time24" name="tutorial_end_time" placeholder="Eg: 23:59" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label class="form-label">Tutorial Location</label>
                            <input type="text" class="form-control" name="tutorial_location" maxlength="255" placeholder="Tutorial Location..." autocomplete="off" required>
                          </div>
                        </div>
                        <div class="col-12">
                          <input type="hidden" name="tutorial_uos" value="{{$db_uos->uos_id}}">
                          <button type="submit" class="btn btn-primary" id="submitButton1">Add</button>
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
@endsection

@section('script')
<script>
</script>
@endsection
