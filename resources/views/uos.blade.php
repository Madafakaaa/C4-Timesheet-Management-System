@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">uos</h1>
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
                    <th scope="col">Uos Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Uos Code</th>
                    <th scope="col">Description</th>
                    <th scope="col">View Tutorial</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($db_uos as $db_uos)
                    <tr>
                      <th>{{$loop->iteration}}</th>
                      <td>{{$db_uos->uos_name}}</td>
                      <td>{{$db_uos->uos_semester}}</td>
                      <td>{{$db_uos->uos_code}}</td>
                      <td>{{$db_uos->uos_description}}</td>
                      <td class="py-2"><a href="/tutorial?tutorial_uos={{$db_uos->uos_id}}" class="btn btn-sm btn-outline-success">View Tutorial</a></td>
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
