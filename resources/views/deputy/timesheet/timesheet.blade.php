@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">Time Sheet Approval</h1>
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
      @foreach($array_schedules as $array_schedule)
        <div class="col-12">
          <div class="card card-collapsed">
            <div class="card-status bg-blue"></div>
            <div class="card-header">
              <h3 class="card-title">{{$array_schedule['uos_code']}} {{$array_schedule['uos_name']}} <small>{{$array_schedule['semester_name']}}</small> {{$array_schedule['user_first_name']}} {{$array_schedule['user_last_name']}} | {{$array_schedule['schedule_allocated_duration_sum']}} Hours</h3>
              <div class="card-options">
                <a href="#" class="btn btn-primary btn-sm card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="/deputy/timesheet/approve?uos_id={{$array_schedule['uos_id']}}&user_id={{$array_schedule['user_id']}}" class="btn btn-success btn-sm ml-2">Approve</a>
                <a href="/deputy/timesheet/reject?uos_id={{$array_schedule['uos_id']}}&user_id={{$array_schedule['user_id']}}" class="btn btn-danger btn-sm ml-2">Reject</a>
              </div>
            </div>
            <div class="card-body py-0" style="border-top:1px solid #dee2e6;">
              <div class="table-responsive">
                <table class="table card-table">
                  <tbody>
                    @foreach($array_schedule['schedules'] as $schedule)
                      <tr>
                        <td>{{$schedule['week_name']}}</td>
                        <td class="text-right">{{$schedule['schedule_allocated_duration_sum']}} Hours</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection
