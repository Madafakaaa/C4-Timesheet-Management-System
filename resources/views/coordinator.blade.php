@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">coordinator</h1>
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
                <a href="/coordinator/create" class="btn btn-outline-secondary btn-block"><i class="fe fe-plus mr-2"></i>Add New</a>
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
                    <th scope="col">coordinator Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthday</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($db_coordinator as $db_coordinator)
                    <tr>
                      <th>{{$loop->iteration}}</th>
                      <td>{{$db_coordinator->user_first_name}} {{$db_coordinator->user_last_name}}</td>
                      <td>{{$db_coordinator->user_email}}</td>
                      <td>{{$db_coordinator->user_gender}}</td>
                      <td>{{$db_coordinator->user_birthday}}</td>
                      <td class="py-2"><a href="" class="btn btn-sm btn-outline-success">View Uos</a></td>
                      <td class="py-2"><a href="" class="btn btn-sm btn-outline-danger">Delete</a></td>
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