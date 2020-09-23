<!-- User Info Content -->
<div class="user_div">
  <h5 class="brand-name mb-4">COMP5703<a href="javascript:void(0)" class="user_btn"><i class="icon-logout"></i></a></h5>
  <div class="card">
    <div class="card-body">
      <div class="media">
        <img class="avatar avatar-xl mr-3" src="/assets/images/avatar/avatar1.png" alt="avatar">
        <div class="media-body">
          <h5 class="m-0">{{ Session::get('user_first_name') }} {{ Session::get('user_last_name') }}</h5>
          <p class="text-muted mb-0">{{ Session::get('user_id') }}</p>
          <ul class="social-links list-inline mb-0 mt-2">
            <li class="list-inline-item"><a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="1234567890"><i class="fa fa-phone"></i></a></li>
            <li class="list-inline-item"><a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="@skypename"><i class="fa fa-skype"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Statistics</h3>
      <div class="card-options">
        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
      </div>
    </div>
    <div class="card-body">
      <div class="text-center">
        <div class="row">
          <div class="col-6 pb-3">
            <label class="mb-0">Balance</label>
            <h4 class="font-30 font-weight-bold">$545</h4>
          </div>
          <div class="col-6 pb-3">
            <label class="mb-0">Growth</label>
            <h4 class="font-30 font-weight-bold">27%</h4>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="d-block">Total Income<span class="float-right">77%</span></label>
        <div class="progress progress-xs">
          <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
        </div>
      </div>
      <div class="form-group">
        <label class="d-block">Total Expenses <span class="float-right">50%</span></label>
        <div class="progress progress-xs">
          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
        </div>
      </div>
      <div class="form-group mb-0">
        <label class="d-block">Gross Profit <span class="float-right">23%</span></label>
        <div class="progress progress-xs">
          <div class="progress-bar bg-green" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Friends</h3>
      <div class="card-options">
        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
      </div>
    </div>
    <div class="card-body">
      <ul class="right_chat list-unstyled">
        <li class="online">
          <a href="javascript:void(0);">
            <div class="media">
              <img class="media-object " src="/assets/images/xs/avatar4.jpg" alt="">
              <div class="media-body">
                <span class="name">Donald Gardner</span>
                <span class="message">Designer, Blogger</span>
                <span class="badge badge-outline status"></span>
              </div>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="card b-none">
    <ul class="list-group">
      <li class="list-group-item d-flex">
        <div class="box-icon sm rounded bg-blue"><i class="fa fa-credit-card"></i> </div>
        <div class="ml-3">
          <div>+$29 New sale</div>
          <a href="javascript:void(0)">Admin Template</a>
          <div class="text-muted font-12">5 min ago</div>
        </div>
      </li>
      <li class="list-group-item d-flex">
        <div class="box-icon sm rounded bg-pink"><i class="fa fa-upload"></i> </div>
        <div class="ml-3">
          <div>Project Update</div>
          <a href="javascript:void(0)">New HTML page</a>
          <div class="text-muted font-12">10 min ago</div>
        </div>
      </li>
    </ul>
  </div>
</div>
