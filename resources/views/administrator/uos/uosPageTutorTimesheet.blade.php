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
      <div class="col-lg-4 col-md-12">
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
          <div class="card-header">
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
            <div class="card-options">
              <a class="text-primary" data-toggle="modal" data-target="#newScheduleModal"><i class="fa fa-plus" data-toggle="tooltip" data-placement="right" title="Add New"></i></a>
              <!-- Modal -->
              <div class="modal fade" id="newScheduleModal" tabindex="-1" role="dialog" aria-labelledby="newScheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="newScheduleModalLabel">Add New</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
</div>
@endsection

@section('script')
<script>
</script>
@endsection
