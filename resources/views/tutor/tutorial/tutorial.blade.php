@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">Tutorial</h1>
@endsection

@section('body')
<div class="section-body mt-3">
  <div class="container-fluid">
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
                  <div class="mb-3 h5"><a href="javascript:void(0);">{{$tutorial['uos_code']}} {{$tutorial['uos_name']}}</a></div>
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
                <th>Unit of Study</th>
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
                    <div><a href="javascript:void(0);">{{$tutorial['uos_code']}} {{$tutorial['uos_name']}}</a></div>
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
</div>
@endsection

@section('script')
<script>
</script>
@endsection
