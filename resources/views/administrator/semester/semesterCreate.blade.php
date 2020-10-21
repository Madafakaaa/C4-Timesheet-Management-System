@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">SEMESTER</h1>
@endsection

@section('body')
<div class="section-body my-5">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-9 col-sm-12">
        <div class="card mb-6">
          <form action="/administrator/semester/store" method="post" id="form1" name="form1" onsubmit="submitButtonDisable('submitButton1')">
            @csrf
            <div class="card-header">
              <h3 class="card-title">Create new semester</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">Semester Name</label>
                <input type="text" class="form-control" placeholder="Semester Name..." name="semester_name" required maxlength="50" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="form-label">Start Date</label>
                <input type="text" data-provide="datepicker" data-date-autoclose="true" class="form-control" data-date-format="yyyy-mm-dd" value="{{date('Y-m-d')}}" name="semester_start" required autocomplete="off">
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Week Name</th>
                    <th scope="col">
                      <button type="button" class="btn btn-sm btn-outline-primary" onclick="addNewWeek()">
                        <i class="fe fe-plus mr-1"></i>New Week
                      </button>
                    </th>
                  </tr>
                </thead>
                <tbody id="weekBody">
                  <tr id="tr_1">
                    <td>
                      <input type="text" class="form-control" value="week 1" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_1')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_2">
                    <td>
                      <input type="text" class="form-control" value="week 2" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_2')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_3">
                    <td>
                      <input type="text" class="form-control" value="week 3" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_3')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_4">
                    <td>
                      <input type="text" class="form-control" value="week 4" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_4')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_5">
                    <td>
                      <input type="text" class="form-control" value="week 5" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_5')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_6">
                    <td>
                      <input type="text" class="form-control" value="week 6" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_6')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_7">
                    <td>
                      <input type="text" class="form-control" value="week 7" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_7')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_8">
                    <td>
                      <input type="text" class="form-control" value="midterm break" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_8')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_9">
                    <td>
                      <input type="text" class="form-control" value="week 8" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_9')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_10">
                    <td>
                      <input type="text" class="form-control" value="week 9" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_10')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_11">
                    <td>
                      <input type="text" class="form-control" value="week 10" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_11')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_12">
                    <td>
                      <input type="text" class="form-control" value="week 11" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_12')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_13">
                    <td>
                      <input type="text" class="form-control" value="week 12" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_13')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_14">
                    <td>
                      <input type="text" class="form-control" value="week 13" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_14')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_15">
                    <td>
                      <input type="text" class="form-control" value="review week 1" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_15')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_16">
                    <td>
                      <input type="text" class="form-control" value="review week 2" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_16')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_17">
                    <td>
                      <input type="text" class="form-control" value="exam week 1" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_17')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                  <tr id="tr_18">
                    <td>
                      <input type="text" class="form-control" value="exam week 2" name="week_name[]" maxlength="15" autocomplete="off" required>
                    </td>
                    <td>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek('tr_18')">
                        <i class="fe fe-trash-2 mr-1"></i>Remove
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <input type="hidden" value="18" id="week_num" name="week_num">
              <input type="submit" class="form-control btn btn-pill btn-primary" value="Submit" id="submitButton1">
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
  function addNewWeek(){
      var week_num = Number($("#week_num").val());
      week_num = week_num+1;
      $("#week_num").val(week_num);
      $("#weekBody").append('<tr id="tr_'+week_num+'"><td><input type="text" class="form-control" value="New Week" name="week_name[]" maxlength="15" autocomplete="off" required></td><td><button type="button" class="btn btn-sm btn-outline-danger" onclick="RemoveWeek(\'tr_'+week_num+'\')"><i class="fe fe-trash-2 mr-1"></i>Remove</button></td></tr>');
  }

  dragula([document.getElementById("weekBody")], {
    removeOnSpill: true
  });

  function RemoveWeek(i){
      $("#"+i).remove();
  }
</script>
@endsection
