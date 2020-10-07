@extends('main')

@section('body')
<div class="section-body mt-4">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-9 col-sm-12">
        <div class="card">
          <form action="/casualAcademic/store" method="post" id="form2" name="form2" onsubmit="submitButtonDisable('submitButton1')">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Create new CasualAcademic</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">CasualAcademic UserId</label>
                <input type="text" class="form-control" placeholder="User Name..." name="user_id" required maxlength="25" autocomplete="off">
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
</div>
@endsection

@section('script')
<script>
</script>
@endsection
