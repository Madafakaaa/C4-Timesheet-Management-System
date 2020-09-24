@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">CasualAcademic</h1>
@endsection

@section('body')
<div class="section-body mt-4">
  <div class="container-fluid">
    <div class="row clearfix row-deck">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4 offset-lg-6">
                <input type="text" class="form-control search" placeholder="Search...">
              </div>
            </div>
            <div class="table-responsive mt-4">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">CasualAcademic Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthday</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($db_casualAcademics as $db_casualAcademic)
                    <tr>
                      <th>{{$loop->iteration}}</th>
                      <td>{{$db_casualAcademic->user_first_name}} {{$db_casualAcademic->user_last_name}}</td>
                      <td>{{$db_casualAcademic->user_email}}</td>
                      <td>{{$db_casualAcademic->user_gender}}</td>
                      <td>{{$db_casualAcademic->user_birthday}}</td>
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
