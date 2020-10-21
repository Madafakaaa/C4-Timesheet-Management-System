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
        <ul class="nav nav-pills">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#"><i class="dropdown-icon fa fa-file-excel-o"></i>page1</a>
              <a class="dropdown-item" href="#"><i class="dropdown-icon fa fa-file-word-o"></i>page2</a>
              <a class="dropdown-item" href="#"><i class="dropdown-icon fa fa-file-pdf-o"></i>page3</a>
            </div>
          </li>
        </ul>
        <div class="notification d-flex">
          <div class="dropdown d-flex">
            <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success nav-unread"></span></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <ul class="right_chat list-unstyled w250 p-0">
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
              <div class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="dropdown-item text-center text-muted-dark readall">Mark all as read</a>
            </div>
          </div>
          <div class="dropdown d-flex">
            <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-primary nav-unread"></span></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <ul class="list-unstyled feeds_widget">
                <li>
                  <div class="feeds-left"><i class="fa fa-check"></i></div>
                  <div class="feeds-body">
                    <h4 class="title text-danger">Issue Fixed <small class="float-right text-muted">11:05</small></h4>
                    <small>WE have fix all Design bug with Responsive</small>
                  </div>
                </li>
                <li>
                  <div class="feeds-left"><i class="fa fa-shopping-cart"></i></div>
                  <div class="feeds-body">
                    <h4 class="title">7 New Orders <small class="float-right text-muted">11:35</small></h4>
                    <small>You received a new oder from Tina.</small>
                  </div>
                </li>
              </ul>
              <div class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="dropdown-item text-center text-muted-dark readall">Mark all as read</a>
            </div>
          </div>
          <div class="dropdown d-flex">
            <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-user"></i></a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
              <a class="dropdown-item" href="page-profile.html"><i class="dropdown-icon fe fe-user"></i> Profile</a>
              <a class="dropdown-item" href="app-setting.html"><i class="dropdown-icon fe fe-settings"></i> Settings</a>
              <a class="dropdown-item" href="app-email.html"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="dropdown-icon fe fe-mail"></i> Inbox</a>
              <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-send"></i> Message</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-help-circle"></i> Need help?</a>
              <a class="dropdown-item" href="/exit"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
