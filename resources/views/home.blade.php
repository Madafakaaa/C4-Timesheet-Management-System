@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">HOME</h1>
@endsection

@section('body')
<div class="section-body mt-4">
  <div class="container-fluid">
    <div class="row clearfix row-deck">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Dashboard</h3>
          </div>
          <div class="card-body">
            <div class="d-md-flex">
              <div class="card mr-1">
                <div class="card-body">
                  <div class="text">User</div>
                  <h5 class="counter">479</h5>
                </div>
              </div>
              <div class="card mr-1">
                <div class="card-body">
                  <div class="text">Courses</div>
                  <h5 class="counter">82</h5>
                </div>
              </div>
              <div class="card mr-1">
                <div class="card-body">
                  <div class="text">Tutorials</div>
                  <h5 class="counter">253</h5>
                </div>
              </div>
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
