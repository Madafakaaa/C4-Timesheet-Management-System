@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">Notification</h1>
@endsection

@section('body')
<div class="section-body">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
      <ul class="nav nav-tabs page-header-tab">
        <li class="nav-item"><a class="nav-link active" id="all-tab" data-toggle="tab" href="#all">All</a></li>
        <li class="nav-item"><a class="nav-link" id="unread-tab" data-toggle="tab" href="#unread">Unread</a></li>
        <li class="nav-item"><a class="nav-link" id="read-tab" data-toggle="tab" href="#read">Read</a></li>
      </ul>
      <div class="header-action">
        <a href="/notification/markall" class="btn btn-primary" title="">Mark all as read</a>
      </div>
    </div>
  </div>
</div>
<div class="section-body pt-3">
  <div class="container-fluid">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="all">
        @foreach($db_all_notifications as $notification)
          <div class="accordion">
            <div class="card mb-1 inbox @if($notification->notification_is_read==0) unread @endif">
              <div class="card-header">
                @if($notification->notification_type=="info")
                  <i class="fe fe-info"></i>
                @elseif($notification->notification_type=="approved")
                  <i class="fe fe-user-check text-success"></i>
                @elseif($notification->notification_type=="rejected")
                  <i class="fe fe-user-x text-danger"></i>
                @else
                  <i class="fa fa-star-o"></i>
                @endif
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button">{{$notification->notification_create_time}}</button>
                </h5>
                <span class="text_ellipsis xs-hide">{{$notification->notification_content}}</span>
                <div class="card-options">
                  @if($notification->notification_is_read==0)
                    <a href="/notification/mark?id={{$notification->notification_id}}"><i class="fa fa-eye"></i></a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="tab-pane fade show" id="unread">
        @foreach($db_unread_notifications as $notification)
          <div class="accordion">
            <div class="card mb-1 inbox @if($notification->notification_is_read==0) unread @endif">
              <div class="card-header">
                <a href="javascript:void(0);" class="mail-star xs-hide"><i class="fa fa-star-o"></i></a>
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button">{{$notification->notification_create_time}}</button>
                </h5>
                <span class="text_ellipsis xs-hide">{{$notification->notification_content}}</span>
                <div class="card-options">
                  @if($notification->notification_is_read==0)
                    <a href="/notification/mark?id={{$notification->notification_id}}"><i class="fa fa-eye"></i></a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="tab-pane fade show" id="read">
        @foreach($db_read_notifications as $notification)
          <div class="accordion">
            <div class="card mb-1 inbox @if($notification->notification_is_read==0) unread @endif">
              <div class="card-header">
                <a href="javascript:void(0);" class="mail-star xs-hide"><i class="fa fa-star-o"></i></a>
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button">{{$notification->notification_create_time}}</button>
                </h5>
                <span class="text_ellipsis xs-hide">{{$notification->notification_content}}</span>
                <div class="card-options">
                  @if($notification->notification_is_read==0)
                    <a href="/notification/mark?id={{$notification->notification_id}}"><i class="fa fa-eye"></i></a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
</script>
@endsection
