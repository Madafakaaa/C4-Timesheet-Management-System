<!-- Left Sidebar Content Content -->
<div id="left-sidebar" class="sidebar">
  <h5 class="brand-name">CS46-4 System<a href="javascript:void(0)" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
  <nav id="left-sidebar-nav" class="sidebar-nav">
    <ul class="metismenu mt-4">
      <li id="dashboard"><a href="/home"><i class="icon-home"></i><span>Home</span></a></li>
      @if(Session::get('user_is_administrator')==1)
        <li class="g_heading">Administrator</li>
        <li><a href="/administrator/semester"><i class="fa fa-calendar"></i><span>Semester</span></a></li>
        <li><a href="/administrator/user"><i class="fe fe-user"></i><span>User</span></a></li>
        <li><a href="/administrator/uos"><i class="fe fe-book"></i><span>UoS</span></a></li>
        <li><a href="/administrator/timesheet"><i class="fe fe-check-square"></i><span>Timesheet Approval</span></a></li>
        <li><a href="/administrator/hours"><i class="fe fe-clock"></i><span>Claimed Hours</span></a></li>
      @endif
      @if(Session::get('user_is_deputy_hos')==1)
        <li class="g_heading">Deputy</li>
        <li><a href="/deputy/timesheet"><i class="fe fe-check-square"></i><span>Proposed Timesheet</span></a></li>
      @endif
      @if(Session::get('user_is_uos_coordinator')==1)
        <li class="g_heading">Coordinator</li>
        <li><a href="/coordinator/uos"><i class="fe fe-book"></i><span>UoS</span></a></li>
        <li><a href="/coordinator/tutor"><i class="fe fe-user"></i><span>Casual Academic</span></a></li>
        <li><a href="/coordinator/timesheet"><i class="fe fe-check-square"></i><span>Timesheet Approval</span></a></li>
      @endif
      @if(Session::get('user_is_casual_academic')==1)
        <li class="g_heading">Casual Academic</li>
        <li><a href="/tutor/uos"><i class="fe fe-book"></i><span>UoS</span></a></li>
        <li><a href="/tutor/timesheet"><i class="fa fa-list"></i><span>Time Sheet</span></a></li>
        <li><a href="/tutor/tutorial"><i class="fe fe-users"></i><span>Tutorial</span></a></li>
      @endif
      <li><a href="/notification"><i class="fe fe-bell"></i><span>Notification</span></a></li>
      <!-- sublist template
      <li>
        <a href="javascript:void(0)" class="has-arrow"><i class="icon-lock"></i><span>Layer1</span></a>
        <ul>
          <li><a href="#">page1</a></li>
          <li><a href="#">page2</a></li>
          <li><a href="#">page3</a></li>
          <li><a href="#">page4</a></li>
        </ul>
      </li>
      -->
    </ul>
  </nav>
</div>
