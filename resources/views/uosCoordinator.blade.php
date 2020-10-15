@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">COORDINATOR - MY UNIT OF STUDY</h1>
@endsection

@section('body')
<div class="section-body mt-1">
  <div class="section-body py-3">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="d-md-flex justify-content-between">
                <ul class="nav nav-tabs b-none">
                  <li class="nav-item"><a class="nav-link active" id="grid-tab" data-toggle="tab" href="#grid"><i class="fa fa-th"></i> Grid</a></li>
                  <li class="nav-item"><a class="nav-link" id="list-tab" data-toggle="tab" href="#list"><i class="fa fa-list-ul"></i> List</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="grid" role="tabpanel">
          <div class="row row-deck">
            @foreach($db_uoses as $db_uos)
              <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="/uos/page?id={{$db_uos->uos_id}}">
                  <div class="card">
                    <div class="card-body">
                      <div class="card-status bg-blue"></div>
                      <div class="mb-3 px--2"><img src="/assets/images/course/course_1.png" alt=""></div>
                      <div class="mb-2">
                        <h5 class="mb-0">{{$db_uos->uos_name}}<br><small class="text-muted">{{$db_uos->uos_code}}</small></h5>
                        <p class="text-muted">{{$db_uos->semester_name}}</p>
                      </div>
                      <span class="font-12 text-muted">Coordinators</span>
                      <ul class="list-unstyled team-info margin-0 pt-2">
                        <li><img src="/assets/images/avatar/avatar_1.png" alt="Avatar"></li>
                        <li><img src="/assets/images/avatar/avatar_1.png" alt="Avatar"></li>
                      </ul>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
        <div class="tab-pane fade" id="list" role="tabpanel">
          <div class="table-responsive" id="users">
            <table class="table table-hover table-vcenter text-nowrap table_custom list">
              <tbody>
                @foreach($db_uoses as $db_uos)
                  <tr>
                    <td class="text-center width40">
                      <div class="avatar d-block">
                        <img class="avatar" src="/assets/images/course/course_1.png" alt="avatar">
                      </div>
                    </td>
                    <td>
                      <div><a href="javascript:void(0);">{{$db_uos->uos_name}}</a></div>
                      <div class="text-muted">{{$db_uos->uos_code}}</div>
                    </td>
                    <td class="hidden-xs">
                      <div class="text-muted">{{$db_uos->semester_name}}</div>
                    </td>
                    <td class="hidden-sm">
                      <div class="text-muted">{{$db_uos->uos_description}}</div>
                    </td>
                    <td class="text-right">
                      <!-- <a class="btn btn-sm btn-link" href="javascript:void(0)" data-toggle="tooltip" title="Phone"><i class="fa fa-phone"></i></a> -->
                      <!-- <a class="btn btn-sm btn-link" href="javascript:void(0)" data-toggle="tooltip" title="Mail"><i class="fa fa-envelope"></i></a> -->
                      <a class="btn btn-sm btn-link hidden-xs js-sweetalert" data-type="confirm" href="/uos/delete?id={{$db_uos->uos_id}}" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
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
