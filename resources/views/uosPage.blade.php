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
            <a class="nav-link active" id="pills-tutor-tab" data-toggle="pill" href="#pills-tutor" role="tab" aria-controls="pills-tutor" aria-selected="false">Casual Academics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-tutorial-tab" data-toggle="pill" href="#pills-tutorial" role="tab" aria-controls="pills-tutorial" aria-selected="true">Tutorials</a>
          </li>
        </ul>
      </div>
      <div class="col-lg-8 col-md-12">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-tutor" role="tabpanel" aria-labelledby="pills-tutor-tab">
            <div class="row clearfix">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body py-2">
                    <div class="d-md-flex justify-content-between">
                      <ul class="nav nav-tabs b-none">
                        <li class="nav-item"><a class="nav-link active" id="list-tab" data-toggle="tab" href="#tutor_list"><i class="fa fa-list-ul"></i> List</a></li>
                        <li class="nav-item"><a class="nav-link" id="addnew-tab" data-toggle="tab" href="#tutor_add_new"><i class="fa fa-plus"></i> Add New</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tutor_list" role="tabpanel">
                <div class="table-responsive" id="tutors">
                  <table class="table table-hover table-vcenter text-nowrap table_custom list">
                    <tbody>
                      @forelse($db_tutors as $db_tutor)
                        <tr>
                          <td class="text-center width40">
                            <div class="avatar d-block">
                              <img class="avatar" src="/assets/images/avatar/avatar_1.png" alt="avatar">
                            </div>
                          </td>
                          <td>
                            <div><a href="javascript:void(0);">{{$db_tutor->user_first_name}} {{$db_tutor->user_last_name}}</a></div>
                            <div class="text-muted">{{$db_tutor->user_id}}</div>
                          </td>
                          <td class="hidden-xs">
                            <div class="text-muted">{{$db_tutor->user_email}}</div>
                          </td>
                          <td class="text-right">
                            <!-- <a class="btn btn-sm btn-link" href="javascript:void(0)" data-toggle="tooltip" title="Phone"><i class="fa fa-phone"></i></a> -->
                            <!-- <a class="btn btn-sm btn-link" href="javascript:void(0)" data-toggle="tooltip" title="Mail"><i class="fa fa-envelope"></i></a> -->
                            <a class="btn btn-sm btn-link hidden-xs" href="/uos/page/tutor/delete?user_id={{$db_tutor->user_id}}&uos_id={{$db_uos->uos_id}}"><i class="fa fa-trash text-danger"></i></a>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td class="hidden-xs">
                            <div class="text-muted">No Casual Academics!</div>
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
                    <form action="/uos/page/tutor/store" method="post" id="form1" name="form1" onsubmit="submitButtonDisable('submitButton1')">
                      @csrf
                      <div class="row clearfix">
                        <div class="col-9">
                          <div class="form-group multiselect_div">
                            <select id="single-selection" name="uos_casual_academic_user" class="multiselect multiselect-custom" required autocomplete="off">
                              <option value="">Choose Casual Academic</option>
                              @foreach($db_users as $db_user)
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
                        <li class="nav-item"><a class="nav-link active" id="list-tab" data-toggle="tab" href="#tutorial_list"><i class="fa fa-list-ul"></i> List</a></li>
                        <li class="nav-item"><a class="nav-link" id="addnew-tab" data-toggle="tab" href="#tutorial_add_new"><i class="fa fa-plus"></i> Add New</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tutorial_list" role="tabpanel">
                <div class="table-responsive" id="tutorials">
                  <table class="table table-hover table-vcenter text-nowrap table_custom list">
                    <tbody>
                      @forelse($db_tutorials as $db_tutorial)
                        <tr>
                          <td class="text-center width40">
                            <div class="avatar d-block">
                              <img class="avatar" src="/assets/images/avatar/avatar_1.png" alt="avatar">
                            </div>
                          </td>
                          <td>
                            <div><a href="javascript:void(0);">{{$db_tutorial->tutorial_name}}</a></div>
                            <div class="text-muted">{{$db_tutorial->tutorial_day_in_week}}</div>
                          </td>
                          <td class="hidden-xs">
                            <div class="text-muted">{{$db_tutorial->tutorial_day_in_week}} {{$db_tutorial->tutorial_start_time}} - {{$db_tutorial->tutorial_end_time}}</div>
                          </td>
                          <td class="text-right">
                            <!-- <a class="btn btn-sm btn-link" href="javascript:void(0)" data-toggle="tooltip" title="Phone"><i class="fa fa-phone"></i></a> -->
                            <!-- <a class="btn btn-sm btn-link" href="javascript:void(0)" data-toggle="tooltip" title="Mail"><i class="fa fa-envelope"></i></a> -->
                            <a class="btn btn-sm btn-link hidden-xs" href="/uos/page/tutorial/delete?user_id={{$db_tutorial->tutorial_id}}"><i class="fa fa-trash text-danger"></i></a>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td class="hidden-xs">
                            <div class="text-muted">No Casual Academics!</div>
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
                    <form action="/uos/page/tutor/store" method="post" id="form1" name="form1" onsubmit="submitButtonDisable('submitButton1')">
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
                            <label class="form-label">ZIP Code</label>
                            <select name="Day in week" id="select-beast" class="form-control custom-select" required>
                              <option value="">Day in week...</option>
                              <option value="1">Chuck Testa</option>
                              <option value="4">Sage Cattabriga-Alosa</option>
                              <option value="3">Nikola Tesla</option>
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
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <!-- <div class="card">
          <div class="card-body">
            <div class="widgets1">
              <div class="icon">
                <i class="icon-trophy text-success font-30"></i>
              </div>
              <div class="details">
                <h6 class="mb-0 font600">Total Earned</h6>
                <span class="mb-0">$96K +</span>
              </div>
            </div>
          </div>
        </div> -->
        <div class="card">
          <div class="card-header pb-0">
            <h3 class="card-title">Coordinators</h3>
          </div>
          <div class="card-body">
            <ul class="right_chat list-unstyled mb-0">
              @forelse($db_coordinators as $db_coordinator)
                <li class="online">
                  <a href="javascript:void(0);">
                    <div class="media">
                      <img class="media-object " src="/assets/images/avatar/avatar_1.png" alt="">
                      <div class="media-body">
                        <span class="name">{{$db_coordinator->user_first_name}} {{$db_coordinator->user_last_name}}</span>
                        <span class="message">{{$db_coordinator->user_id}}</span>
                        <span class="badge badge-outline status"></span>
                      </div>
                    </div>
                  </a>
                </li>
              @empty
                <li class="online">
                  <div class="text-muted">No Coordinators!</div>
                </li>
              @endforelse
            </ul>
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