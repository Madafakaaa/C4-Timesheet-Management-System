@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">Claimed Hours</h1>
@endsection

@section('body')
<div class="section-body mt-3">
  <div class="container-fluid">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form action="">
              <div class="row">
                <div class="col-4">
                  <select class="form-control custom-select" name="filter_semester">
                    <option value="0">All semesters</option>
                    @foreach($db_semesters as $db_semester)
                      <option value="{{$db_semester->semester_id}}" @if($filters['filter_semester']==$db_semester->semester_id) selected @endif>{{$db_semester->semester_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-4">
                  <select class="form-control custom-select" name="filter_tutor" required>
                    <option value="">- Select tutor -</option>
                    @foreach($db_tutors as $db_tutor)
                      <option value="{{$db_tutor->user_id}}" @if($filters['filter_tutor']==$db_tutor->user_id) selected @endif>{{$db_tutor->user_first_name}} {{$db_tutor->user_last_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-2">
                </div>
                <div class="col-2">
                  <button class="btn btn-primary btn-block">Search</nutton>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @if(isset($filters['filter_tutor']))
      <div class="row clearfix">
        <div class="col-12">
          <div class="card">
            <!-- <div class="card-header">
              <h3 class="card-title">#AB0017</h3>
              <div class="card-options">
                <button type="button" class="btn btn-primary"><i class="si si-printer"></i> Export</button>
              </div>
            </div> -->
            <div class="card-body">
              <div class="row my-8">
                <div class="col-6">
                  <p class="h3">{{$db_user->user_first_name}} {{$db_user->user_last_name}}</p>
                  <address>
                    {{$db_user->user_id}}<br>
                    {{$db_user->user_email}}
                  </address>
                </div>
              </div>
              <div class="table-responsive push">
                <table class="table table-bordered table-hover">
                  <tr>
                    <th class="text-center width35"></th>
                    <th>Unit of Study</th>
                    <th class="text-right" style="width: 1%">Allocated</th>
                    <th class="text-right" style="width: 1%">Claimed</th>
                  </tr>
                  @foreach($db_schedules as $db_schedule)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>
                        <p class="font600 mb-1">{{$db_schedule->uos_code}} {{$db_schedule->uos_name}}</p>
                        <div class="text-muted">{{$db_schedule->semester_name}}</div>
                      </td>
                      <td class="text-right">{{$db_schedule->sum_schedule_allocated_duration}}</td>
                      <td class="text-right">{{$db_schedule->sum_schedule_actual_duration}}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <td colspan="3" class="font600 text-right">Total Allocated</td>
                    <td class="text-right">{{$total_allocated_hours}}</td>
                  </tr>
                  <tr class="bg-light">
                    <td colspan="3" class="font600 text-right">Claimed Rate</td>
                    <td class="text-right">{{$total_claimed_rate}} %</td>
                  </tr>
                  <tr class="bg-green text-light">
                    <td colspan="3" class="font700 text-right">Total Claimed</td>
                    <td class="font700 text-right">{{$total_claimed_hours}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection
