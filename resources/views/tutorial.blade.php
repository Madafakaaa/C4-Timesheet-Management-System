@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">tutorial</h1>
@endsection

@section('body')
<div class="section-body mt-4">
  <div class="container-fluid">
    <div class="row clearfix row-deck">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-2 mb-2">
                <a href="/uos" class="btn btn-outline-secondary btn-block"><i class="fe fe-plus mr-2"></i>Return Uos</a>
              </div>
              <div class="col-lg-4 offset-lg-6">
                <input type="text" class="form-control search" placeholder="Search...">
              </div>
            </div>
            <div class="table-responsive mt-4">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Uos Name</th>
                    <th scope="col">Tutorial Name</th>
                    <th scope="col">Day In Week</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Control</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($db_tutorial as $db_tutorial)
                    <tr>
                      <th>{{$loop->iteration}}</th>
                      <td>{{$db_tutorial->tutorial_uos}}</td>
                      <td>{{$db_tutorial->tutorial_name}}</td>
                      <td>{{$db_tutorial->tutorial_day_in_week}}</td>
                      <td>{{$db_tutorial->tutorial_duration}}</td>
                      <td class="py-2"><a href="/tutorial/assign}" class="btn btn-sm btn-outline-success">Assign</a></td>

                    </tr>
                  @empty
                    <tr>
                      <th colspan="5" class="text-center">Empty</th>
                    </tr>
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
