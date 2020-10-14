@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">User</h1>
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
                <a href="/user/create" class="btn btn-outline-secondary btn-block"><i class="fe fe-plus mr-2"></i>Add New</a>
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
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Administrator</th>
                    <th scope="col">Casual Academic</th>
                    <th scope="col">Coordinator</th>
                    <th scope="col">Deputy HOS</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($db_users as $db_user)
                    <tr>
                      <th>{{$loop->iteration}}</th>
                      <td>{{$db_user->user_first_name}} {{$db_user->user_last_name}}</td>
                      <td>{{$db_user->user_email}}</td>
                      <td>
                        @if($db_user->user_is_administrator )
                          <span class="text-success">Yes</span>
                        @else
                          <span class="text-danger">No</span>
                        @endif
                      </td>
                      <td>
                        @if($db_user->user_is_casual_academic === 1)
                          <span class="text-success">Yes</span>
                          <a href="/user/edit?user_id={{$db_user->user_id}}&type=1" class="btn btn-sm btn-default py-0 ml-2">Revoke</a>
                        @else
                          <span class="text-danger">No</span>
                          <a href="/user/edit?user_id={{$db_user->user_id}}&type=1" class="btn btn-sm btn-default py-0 ml-2">Grant&nbsp;</a>
                        @endif
                      </td>
                      <td>
                        @if($db_user->user_is_uos_coordinator === 1)
                          <span class="text-success">Yes</span>
                          <a href="/user/edit?user_id={{$db_user->user_id}}&type=2" class="btn btn-sm btn-default py-0 ml-2">Revoke</a>
                        @else
                          <span class="text-danger">No</span>
                          <a href="/user/edit?user_id={{$db_user->user_id}}&type=2" class="btn btn-sm btn-default py-0 ml-2">Grant&nbsp;</a>
                        @endif
                      </td>
                      <td>
                        @if($db_user->user_is_deputy_hos === 1)
                          <span class="text-success">Yes</span>
                          <a href="/user/edit?user_id={{$db_user->user_id}}&type=3" class="btn btn-sm btn-default py-0 ml-2">Revoke</a>
                        @else
                          <span class="text-danger">No</span>
                          <a href="/user/edit?user_id={{$db_user->user_id}}&type=3" class="btn btn-sm btn-default py-0 ml-2">Grant&nbsp;</a>
                        @endif
                      </td>
                      <td>
                        <a href="/user/delete?user_id={{$db_user->user_id}}" class="btn btn-sm btn-outline-danger py-0">Delete</a>
                      </td>
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
