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
                    <th>Casual Academic</th>
                    <th>Unit of Study</th>
                    <th>Schedule Name</th>
                    <th>Week</th>
                    <th>Working Hours</th>
                    <th class="text-right"></th>
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
                      <td>{{$schedule->user_first_name}} {{$schedule->user_last_name}}</td>
                      <td>{{$schedule->uos_code}} {{$schedule->uos_name}}</td>
                      <td>{{$schedule->schedule_name}}</td>
                      <td>{{$schedule->week_name}}</td>
                      <td>
                        <strong>{{$schedule->schedule_actual_duration}}H / {{$schedule->schedule_allocated_duration}}H</strong>
                      </td>
                      <td class="text-right">
                        <a href="/administrator/timesheet/approve?schedule_id={{$schedule->schedule_id}}" class="btn btn-success btn-sm ml-2">Approve</a>
                        <a href="/administrator/timesheet/reject?schedule_id={{$schedule->schedule_id}}" class="btn btn-danger btn-sm ml-2">Reject</a>
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
