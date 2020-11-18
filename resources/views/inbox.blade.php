@extends('main')

@section('top_nav_page_name')
  <h1 class="page-title">Inbox</h1>
@endsection

@section('body')
<div class="section-body">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <ul class="nav nav-tabs page-header-tab">
                        <li class="nav-item"><a class="nav-link active" id="Primary-tab" data-toggle="tab" href="#Primary">New message</a></li>
                        <li class="nav-item"><a class="nav-link" id="Updates-tab" data-toggle="tab" href="#Updates">All message</a></li>
                        <li class="nav-item"><a class="nav-link" id="Star-tab" data-toggle="tab" href="#Star">Star message</a></li>
                    </ul>
                    <div class="header-action">
                        <a href="/inbox/allread" class="btn btn-primary" title="">Mark all as read</a>
                    </div>
                </div>
            </div>
        </div>

<div class="section-body  pt-3">
            <div class="container-fluid">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="Primary">
                        <div class="accordion" id="accordionExample">
                        @forelse($db_notifications as $db_notification)
                        @if($db_notification->notification_is_read==0)
                            <div class="card mb-1 inbox unread">
                                <div class="card-header" id="headingOne">
                                    <a href="/inbox/star?notification_id={{$db_notification->notification_id}}" class="mail-star xs-hide"><i class="fa fa-star-o"></i></a>
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{$db_notification->notification_create_user}}</button>
                                    </h5>
                                    <span class="text_ellipsis xs-hide">{{$db_notification->notification_type}}   {{$db_notification->notification_content}}  time {{$db_notification->notification_create_time}}</span>
                                    <div class="card-options">
                                        <a href="https://outlook.office.com/mail/inbox"><i class="fa fa-reply"></i></a>
                                        <a href="/inbox/read?notification_id={{$db_notification->notification_id}}"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body detail">
                                        <div class="detail-header">
                                            <div class="media">
                                                <div class="float-left">
                                                    <div class="mr-3"><img src="../assets/images/xs/avatar1.jpg" alt=""></div>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><strong class="text-muted mr-1">From:</strong><a href="javascript:void(0);">info@example.com</a><span class="text-muted text-sm float-right">12:48, 23.06.2018</span></p>
                                                    <p class="mb-0"><strong class="text-muted mr-1">To:</strong>Me <small class="float-right"><i class="fe fe-paperclip mr-1"></i>(2 files, 89.2 KB)</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else

                        @endif
                        @empty

                        @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Updates">
                        <div class="accordion" id="accordionExampleas">
                        @forelse($db_notifications as $db_notification)
                        @if($db_notification->notification_is_read==0)
                            <div class="card mb-1 inbox unread">
                                <div class="card-header" id="headingOne">
                                    <a href="/inbox/star?notification_id={{$db_notification->notification_id}}" class="mail-star xs-hide"><i class="fa fa-star-o"></i></a>
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{$db_notification->notification_create_user}}</button>
                                    </h5>
                                    <span class="text_ellipsis xs-hide">{{$db_notification->notification_type}}   {{$db_notification->notification_content}}  time {{$db_notification->notification_create_time}}</span>
                                    <div class="card-options">
                                        <a href="https://outlook.office.com/mail/inbox"><i class="fa fa-reply"></i></a>
                                        <a href="/inbox/read?notification_id={{$db_notification->notification_id}}"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body detail">
                                        <div class="detail-header">
                                            <div class="media">
                                                <div class="float-left">
                                                    <div class="mr-3"><img src="../assets/images/xs/avatar1.jpg" alt=""></div>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><strong class="text-muted mr-1">From:</strong><a href="javascript:void(0);">info@example.com</a><span class="text-muted text-sm float-right">12:48, 23.06.2018</span></p>
                                                    <p class="mb-0"><strong class="text-muted mr-1">To:</strong>Me <small class="float-right"><i class="fe fe-paperclip mr-1"></i>(2 files, 89.2 KB)</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card mb-1 inbox read">
                                <div class="card-header" id="headingOne">
                                    <a href="/inbox/star?notification_id={{$db_notification->notification_id}}"><i class="fa fa-star-o"></i></a>
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{$db_notification->notification_create_user}}</button>
                                    </h5>
                                    <span class="text_ellipsis xs-hide">{{$db_notification->notification_type}}   {{$db_notification->notification_content}}  time {{$db_notification->notification_create_time}}</span>
                                    <div class="card-options">
                                        <a href="https://outlook.office.com/mail/inbox"><i class="fa fa-reply"></i></a>
                                    </div>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body detail">
                                        <div class="detail-header">
                                            <div class="media">
                                                <div class="float-left">
                                                    <div class="mr-3"><img src="../assets/images/xs/avatar1.jpg" alt=""></div>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><strong class="text-muted mr-1">From:</strong><a href="javascript:void(0);">info@example.com</a><span class="text-muted text-sm float-right">12:48, 23.06.2018</span></p>
                                                    <p class="mb-0"><strong class="text-muted mr-1">To:</strong>Me <small class="float-right"><i class="fe fe-paperclip mr-1"></i>(2 files, 89.2 KB)</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @empty

                        @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade active show" id="Star">
                        <div class="accordion" id="accordionExample">
                        @forelse($db_notifications as $db_notification)
                        @if($db_notification->notification_is_read==2)
                            <div class="card mb-1 inbox read">
                                <div class="card-header" id="headingOne">
                                    <a href="/inbox/unstar?notification_id={{$db_notification->notification_id}} class="mail-star xs-hide"><i class="fa fa-star"></i></a>
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{$db_notification->notification_create_user}}</button>
                                    </h5>
                                    <span class="text_ellipsis xs-hide">{{$db_notification->notification_type}}   {{$db_notification->notification_content}}  time {{$db_notification->notification_create_time}}</span>
                                    <div class="card-options">
                                        <a href="https://outlook.office.com/mail/inbox"><i class="fa fa-reply"></i></a>
                                    </div>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body detail">
                                        <div class="detail-header">
                                            <div class="media">
                                                <div class="float-left">
                                                    <div class="mr-3"><img src="../assets/images/xs/avatar1.jpg" alt=""></div>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><strong class="text-muted mr-1">From:</strong><a href="javascript:void(0);">info@example.com</a><span class="text-muted text-sm float-right">12:48, 23.06.2018</span></p>
                                                    <p class="mb-0"><strong class="text-muted mr-1">To:</strong>Me <small class="float-right"><i class="fe fe-paperclip mr-1"></i>(2 files, 89.2 KB)</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else

                        @endif
                        @empty

                        @endforelse
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
