<!-- Top Navigator Content -->
<div id="page_top" class="section-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="left">
        <!-- Top Navigator Page Name-->
        @section('top_nav_page_name')
          <h1 class="page-title">CS46-4 System</h1>
        @show
      </div>
      <div class="right">
        <div class="notification d-flex">
          <div class="dropdown d-flex">
            <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-user"></i></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <a class="dropdown-item" href="page-profile.html"><i class="dropdown-icon fe fe-user"></i> Profile</a>
              <a class="dropdown-item" href="app-setting.html"><i class="dropdown-icon fe fe-settings"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/exit"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
