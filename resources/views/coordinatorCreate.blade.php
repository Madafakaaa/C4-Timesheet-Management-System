@extends('main')

@section('body')
<div class="section-body mt-4">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-9 col-sm-12">
        <div class="card">
          <form action="/semester/store" method="post" id="form1" name="form1" onsubmit="submitButtonDisable('submitButton1')">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Create new coordinator</h3>
            </div>
            <div class="card-footer">
              <input type="existing user" class="form-control btn btn-pill btn-primary" value="Existing User" id="existingUserButton1">
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">coordinator id</label>
                <input type="text" class="form-control" placeholder="coordinator id..." id="coordinator_id" required maxlength="8" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="form-label">coordinator first name</label>
                <input type="text" class="form-control" placeholder="coordinator first name..." id="coordinator_first_name" required maxlength="8" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="form-label">coordinator last name</label>
                <input type="text" class="form-control" placeholder="coordinator last name..." id="coordinator_last_name" required maxlength="8" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="form-label">coordinator gender</label>
                <input type="text" class="form-control" placeholder="coordinator gender..." id="coordinator_gender" required maxlength="8" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="form-label">coordinator birthday</label>
                <input type="text" class="form-control" placeholder="coordinator birthday..." id="coordinator_birthday" required maxlength="8" autocomplete="off">
              </div>
               <div class="form-group">
                 <label class="form-label">coordinator email</label>
                 <input type="text" class="form-control" placeholder="coordinator email..." id="coordinator_email" required maxlength="8" autocomplete="off">
               </div>
            </div>
            <div class="card-footer">
              <input type="submit" class="form-control btn btn-pill btn-primary" value="Submit" id="submitButton1">
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
