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
              <h3 class="card-title">Create new semester</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">Semester Name</label>
                <input type="text" class="form-control" placeholder="Semester Name..." name="semester_name" required maxlength="8" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="form-label">Start Date</label>
                <input type="text" data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="yyyy-mm-dd" value="{{date('Y-m-d')}}" name="semester_start" required autocomplete="off">
              </div>
              <div class="form-group">
                <label class="form-label">End Date</label>
                <input type="text" data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="yyyy-mm-dd" value="{{date('Y-m-d')}}" name="semester_end" required autocomplete="off">
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
