@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">User</h1>
@endsection

@section('body')
<div class="section-body mt-4">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-9 col-sm-12">
        <div class="card">
          <form action="/administrator/user/store" method="post" id="form2" name="form2" onsubmit="submitButtonDisable('submitButton1')">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Create new User</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">User Id</label>
                <input type="text" class="form-control" placeholder="User Id..." name="user_id" required minlength="8" maxlength="8" autocomplete="off">
              </div>
                <div class="form-group">
                  <label class="form-label">Password</label>
                  <input type="text" class="form-control" placeholder="Password..." name="user_password" required maxlength="15" autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" placeholder="First Name..." name="user_first_name" required maxlength="30" autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" placeholder="Last Name..." name="user_last_name" required maxlength="30" autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="form-label">Select Title</label>
                  <select name="user_title" class="form-control" required>
                    <option value="Mr">Mr</option>
                    <option value="Ms">Ms</option>
                    <option value="Ms">Mrs</option>
                    <option value="Ms">Miss</option>
                    <option value="Dr">Dr</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Birthday</label>
                  <input type="text" data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="yyyy-mm-dd" value="{{date('Y-m-d')}}" name="user_birthday" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="form-label">E-Mail</label>
                  <input type="text" class="form-control" placeholder="E-Mail..." name="user_email" required maxlength="50" autocomplete="off">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="checkbox" name="user_is_casual_academic" aria-label="Checkbox for following text input">
                    </div>
                  </div>
                  <label type="text" class="form-control" aria-label="Text input with checkbox">CASUALAC ADEMIC</label>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="checkbox" name="user_is_uos_coordinator" aria-label="Checkbox for following text input">
                    </div>
                  </div>
                  <label type="text" class="form-control" aria-label="Text input with checkbox">COORDINATOR</label>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="checkbox" name="user_is_deputy_hos" aria-label="Checkbox for following text input">
                    </div>
                  </div>
                  <label type="text" class="form-control" aria-label="Text input with checkbox">DEPUTY HOS</label>
                </div>
                <div class="card-footer">
                  <input type="submit" class="form-control btn btn-pill btn-primary" value="Submit" id="submitButton2">
                </div>
            </div>
          </form>
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
