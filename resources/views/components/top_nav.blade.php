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
            <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-primary nav-unread"></span></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <ul class="list-unstyled feeds_widget">
                @foreach(Session::get('notifications') as $notification)
                  <li>
                    @if($notification->notification_type=="info")
                      <div class="feeds-left"><i class="fe fe-info"></i></div>
                    @elseif($notification->notification_type=="approved")
                      <div class="feeds-left"><i class="fe fe-user-check text-success"></i></div>
                    @elseif($notification->notification_type=="rejected")
                      <div class="feeds-left"><i class="fe fe-user-x text-danger"></i></div>
                    @else
                      <div class="feeds-left"><i class="fe fe-info"></i></div>
                    @endif
                    <div class="feeds-body">
                      <h4 class="title">{{$notification->notification_type}}<small class="float-right text-muted">{{$notification->notification_create_time}}</small></h4>
                      <small>{{$notification->notification_content}}</small>
                    </div>
                  </li>
                @endforeach
              </ul>
              <div class="dropdown-divider"></div>
              <a href="/notification" class="dropdown-item text-center text-muted-dark readall">View all</a>
            </div>
          </div>
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
