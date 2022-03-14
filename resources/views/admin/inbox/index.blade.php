@extends('admin.layouts.master')

{{--@section('title', __('maincp.cities'))--}}
@section('title', 'رسائل تواصل معنا')

@section('styles')
    <link href="/assets/admin/plugins/summernote/dist/summernote.css" rel="stylesheet" /><!-- Custom box css -->
    <link href="/assets/admin/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
    <style>
        #main .message-list-custom {
            display: block;
            padding-left: 0px;
        }
        #main .message-list-custom li {
            position: relative;
            display: block;
            height: 50px;
            line-height: 50px;
            cursor: default;
            transition-duration: .3s;
        }
        #main .message-list-custom li:hover {
            background: rgba(152, 166, 173, 0.15);
            transition-duration: .05s;
        }
        #main .message-list-custom li .col {
            float: left;
            position: relative;
        }
        #main .message-list-custom li .col-1 {
            width: 400px;
        }
        #main .message-list-custom li .col-1 .star-toggle,
        #main .message-list-custom li .col-1 .checkbox-wrapper-mail,
        #main .message-list-custom li .col-1 .dot {
            display: block;
            float: left;
        }
        #main .message-list-custom li .col-1 .dot {
            border: 4px solid transparent;
            border-radius: 100px;
            margin: 22px 26px 0;
            height: 0;
            width: 0;
            line-height: 0;
            font-size: 0;
        }
        #main .message-list-custom li .col-1 .checkbox-wrapper-mail {
            margin-top: 15px;
            margin-right: 10px;
        }
        #main .message-list-custom li .col-1 .star-toggle {
            margin-top: 18px;
            font-size: 16px;
            margin-left: 5px;
        }
        #main .message-list-custom li .col-1 .title {
            position: absolute;
            top: 15px;
            left: 140px;
            right: 0;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }
        #main .message-list-custom li .col-2 {
            position: absolute;
            top: 0;
            left: 400px;
            right: 0;
            bottom: 0;
        }
        #main .message-list-custom li .col-2 .subject,
        #main .message-list-custom li .col-2 .date {
            position: absolute;
            top: 0;
        }
        #main .message-list-custom li .col-2 .subject {
            left: 0;
            right: 200px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }
        #main .message-list-custom li .col-2 .date {
            right: 0;
            width: 200px;
            padding-right: 80px;
        }
        #main .message-list-custom li.unread {
            font-weight: 600;
            color: #060000;
        }
        #main .message-list-custom .my_date_message {
            font-size: 19px;
        }
    </style>
@endsection
@section('content')
<!-- Begin page -->
<div id="wrapper">


    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">

                    <div class="col-sm-12">
                        <div class="inbox-app-main">
                            <div class="row">
                                <div class="col-md-3">
                                    <aside id="sidebar" class="nano">
                                        <div class="nano-content">

                                            <div class="text-center">
{{--                                                <a href="#custom-modal" class="btn btn-danger btn-rounded w-lg waves-effect waves-light m-b-20 m-t-30" data-animation="fadein" data-plugin="custommodal"--}}
{{--                                                   data-overlaySpeed="200" data-overlayColor="#36404a">إرسال </a>--}}
                                            </div>
                                            <menu class="menu-segment">
                                                <ul class="list-unstyled">
                                                    <li class="active"><a href="{{ route('contact_us_inbox.index') }}">الرسائل الجديدة<span> ({{$messageNotReadCount}})</span></a>
                                                    </li>
                                                    {{--<li><a href="javascript:void(0);">الرسائل المهمة</a></li>--}}
{{--                                                    <li><a href="{{ route('contact_us_inbox.index') }}?type=sender">المرسلة</a></li>--}}
                                                    <li><a href="{{ route('contact_us_inbox.index') }}?type=deleted">صندوق المحذوفات</a></li>
                                                </ul>
                                            </menu>
                                            <div class="separator"></div>
                                            <div class="bottom-padding"></div>
                                        </div>
                                    </aside>
                                </div> <!-- end col -->

                                <div class="col-md-9">
                                    <main id="main">
                                        <div class="overlay"></div>
                                        <header class="header">

                                            <h1 class="page-title">
                                                <a class="sidebar-toggle-btn trigger-toggle-sidebar">
                                                    <span class="line"></span><span class="line"></span>
                                                    <span  class="line"></span><span class="line line-angle1"></span>
                                                    <span class="line line-angle2"></span>
                                                </a>
                                            </h1>
                                            <div class="action-bar pull-left">
                                                <ul class="list-inline m-b-0">
                                                    <li>
                                                        <a onClick="window.location.reload();return false;" class="icon circle-icon glyphicon glyphicon-refresh"></a>
                                                    </li>
                                                    @if(count($my_message) > 0)
                                                        @if(request('type') == 'deleted')

                                                            <li>
                                                                <a onclick="removedeleteAllForEver()" class="icon circle-icon red glyphicon glyphicon-remove"></a>
                                                            </li>

                                                        @else
                                                                <li>
                                                                    <a onclick="deleteAll()" class="icon circle-icon red glyphicon glyphicon-remove"></a>
                                                                </li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="search-box pull-left">
                                                {{--<input placeholder="Search..."><span--}}
                                                        {{--class="icon glyphicon glyphicon-search"></span>--}}
                                            </div>

                                            <div class="clearfix"></div>

                                        </header>

                                        <div id="main-nano-wrapper" class="nano">
                                            <div class="nano-content">
                                                <ul class="message-list-custom">

                                                    @if(count($my_message) > 0)

                                                        @foreach($my_message as $support)
                                                            <li @if($support->is_read == 0)  class="unread" @endif>
                                                                <div class="col col-1"><span class="dot"></span>

                                                                    <div class="checkbox-wrapper-mail">
                                                                        <input type="checkbox" name="deleteMessage[]" value="{{$support->id}}" id="chk19{{$support->id}}">
                                                                        <label for="chk19{{$support->id}}" class="toggle"></label>
                                                                    </div>
                                                                    <a href="#message_admin{{$support->id}}" onclick="updateIsRead({{$support->id}})" class="btn  waves-effect waves-light m-r-5 m-b-10"
                                                                       data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200"
                                                                       data-overlaycolor="#36404a"> <i class="fa fa-eye"></i></a>

                                                                    @if(!request('type') && !$support->children->count() &&  $support->sender)
                                                                        <a href="#reply_admin{{$support->id}}" style="margin: 10px" class="circle-icon small glyphicon glyphicon-share-alt"
                                                                           data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200"
                                                                           data-overlaycolor="#36404a"></a>
                                                                    @endif

                                                                    @if(!$support->sender &&!$support->replied_at )
{{--                                                                        <a href="#reply_admin_in_mail{{$support->id}}" style="margin: 10px" class="circle-icon small glyphicon glyphicon-share-alt"--}}
{{--                                                                           data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200"--}}
{{--                                                                           data-overlaycolor="#36404a"></a>--}}
                                                                    @endif

                                                                    @if(!request('type') && $support->children->count())
                                                                        تم الرد علي الرسالة
                                                                    @endif
                                                                    {{--<span  class="star-toggle fa fa-star-o"></span>--}}
                                                                </div>

                                                                <div class="col col-2">
                                                                    <div class="subject">رسالة   (
                                                                        {{ optional($support->sender)->name? : $support->email}})&nbsp;&nbsp; <span class="teaser"></span>
                                                                         &nbsp;&nbsp; <span class="teaser"></span>

                                                                    </div>
                                                                    <div class="date @if($support->is_read == 0)  my_date_message @endif">{{$support->created_at->diffForHumans()}}</div>

                                                                </div>

                                                            </li>

                                                            <!-- Modal -->
                                                            <div id="message_admin{{$support->id}}" class="modal-demo text-left">
                                                                <button type="button" class="close" onclick="Custombox.close();">
                                                                    <span>&times;</span><span class="sr-only">Close</span>
                                                                </button>
                                                                <h4 class="custom-modal-title">     الرسالة الأساسية      </h4>
                                                                <div class="card-box">
                                                                        <div class="form-group">
                                                                            <label> الرسالة </label>
                                                                            <textarea type="text"  name="message" class="form-control msg_body" placeholder="8899898">{{$support->message}} </textarea>

                                                                        </div>
                                                                        @foreach($support->children as $child)
                                                                            <div class="form-group">
                                                                                <label> الرسالة المرسلة </label>
                                                                                <textarea type="text"  name="message" class="form-control msg_body" placeholder="8899898">{{$child->message}} </textarea>
                                                                            </div>
                                                                        @endforeach
                                                                </div>
                                                            </div>
                                                            <div id="reply_admin{{$support->id}}" class="modal-demo text-left">
                                                                <button type="button" class="close" onclick="Custombox.close();">
                                                                    <span>&times;</span><span class="sr-only">Close</span>
                                                                </button>
                                                                <h4 class="custom-modal-title">  الرد علي رسالة {{optional($support->sender)->name}}  </h4>
                                                                <div class="card-box">
                                                                    <form method="post" action="{{route('contact_us_inbox.store')}}" role="form">
                                                                        {{ csrf_field() }}
                                                                        <div class="form-group">
                                                                            <label>الرسالة</label>
                                                                            <input type="hidden" name="userId" value="{{optional($support->sender)->id}}">
                                                                            <input type="hidden" name="parentId" value="{{$support->id}}">
                                                                            <textarea type="text"  name="message" class="form-control msg_body" placeholder="8899898"> </textarea>

                                                                        </div>
                                                                        <div class="btn-toolbar form-group m-b-0">
                                                                            <div class="pull-right">
                                                                                <button class="btn btn-purple waves-effect waves-light hideButton"><span>إرسال الرسالة</span> <i
                                                                                        class="fa fa-send m-l-10"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>

{{--                                                            <div id="reply_admin_in_mail{{$support->id}}" class="modal-demo text-left">--}}
{{--                                                                <button type="button" class="close" onclick="Custombox.close();">--}}
{{--                                                                    <span>&times;</span><span class="sr-only">Close</span>--}}
{{--                                                                </button>--}}
{{--                                                                <h4 class="custom-modal-title">  الرد علي الرسالة عن طريق الإيميل  </h4>--}}
{{--                                                                <div class="card-box">--}}
{{--                                                                    <form method="post" action="{{route('contact_us_inbox.sendMessageByMail')}}" role="form">--}}
{{--                                                                        {{ csrf_field() }}--}}
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label>رقم الهاتف  </label>--}}
{{--                                                                            <input type="text"   class="form-control" readonly value="{{$support->phone}}">--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label>الإيميل الخاص به  </label>--}}
{{--                                                                            <input type="text"   class="form-control" readonly value="{{$support->email}}">--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label>الرسالة الأساسية</label>--}}
{{--                                                                            <textarea type="text"   class="form-control" readonly>{{$support->message}} </textarea>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label>الرسالة</label>--}}
{{--                                                                            <input type="hidden" name="support_id" value="{{$support->id}}">--}}
{{--                                                                            <input type="hidden" name="email" value="{{$support->email}}">--}}
{{--                                                                            <textarea type="text"  name="message" class="form-control msg_body" placeholder="8899898"> </textarea>--}}

{{--                                                                        </div>--}}
{{--                                                                        <div class="btn-toolbar form-group m-b-0">--}}
{{--                                                                            <div class="pull-right">--}}
{{--                                                                                <button class="btn btn-purple waves-effect waves-light hideButton"><span>إرسال الرسالة</span> <i--}}
{{--                                                                                        class="fa fa-send m-l-10"></i></button>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </form>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}


                                                        @endforeach

                                                    @else
                                                        <img src="{{asset('emptyMessage.png')}}" class="img-responsive  "  >

                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </main>
                                </div> <!-- end col -->
                            </div><!-- end row -->
                        </div>

                    </div>

                </div>
                <!-- End row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>

</div>
<!-- END wrapper -->

<!-- Modal -->
<div id="custom-modal" class="modal-demo text-left">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">  إرسال رسالة  معين  </h4>
    <div class="card-box">
        <form method="post" action="{{route('contact_us_inbox.store')}}" role="form">
            {{ csrf_field() }}

            <div class="form-group">
                    <label>الرسالة</label>
                <textarea type="text"  name="message" class="form-control msg_body" placeholder="8899898"> </textarea>

            </div>

            <div class="btn-toolbar form-group m-b-0">
                <div class="pull-right">
                    {{--<button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i--}}
                                {{--class="fa fa-trash-o"></i></button>--}}
                    <button class="btn btn-purple waves-effect waves-light"><span>إرسال الرسالة</span> <i
                                class="fa fa-send m-l-10"></i></button>
                </div>
            </div>

        </form>

    </div>
</div>


@endsection


@section('scripts')

<script>
    var resizefunc = [];
</script>
{{--<script src="{{ request()->root() }}/public/assets/admin/pages/jquery.inbox.js"></script>--}}
<script src="{{ asset('assets/admin/pages/jquery.inbox.js') }}"></script>


    <script type="text/javascript">

        function updateIsRead(id) {

            $.ajax({
                type: 'GET',
                url: '{{route('admin.support.updateIsRead')}}',
                data: {id: id},
                dataType: 'json',
                success: function (data) {

                }
            });
        }
        function deleteAll() {
            var checked = []
            $("input[name='deleteMessage[]']:checked").each(function () {
                checked.push(parseInt($(this).val()));
            });

            if (checked.length === 0) {

                var shortCutFunction = 'error';
                var msg = 'من فضلك إختيار الرسائل التي تريد مسحها ';
                var title = 'فشل';
                toastr.options = {
                    positionClass: 'toast-top-left',
                    onclick: null,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                };
                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;
                return false
            }
            swal({
                title: "هل انت متأكد؟",
                text: "",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "موافق",
                cancelButtonText: "إلغاء",
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                closeOnConfirm: true,
                closeOnCancel: true,
            }, function (isConfirm) {
                if (isConfirm) {
                $.ajax({
                    type: 'GET',
                    url: '{{route('admin.support.updateIsDeleted')}}',
                    data: {ids: checked},
                    dataType: 'json',
                    success: function (data) {
                        var shortCutFunction = 'success';
                        var msg = data.message;
                        var title = 'نجاح';
                        toastr.options = {
                            positionClass: 'toast-top-left',
                            onclick: null
                        };
                        var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                        $toastlast = $toast;
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                });
                }
            }
            )
        }
        function removedeleteAllForEver() {
            var checked = []
            $("input[name='deleteMessage[]']:checked").each(function () {
                checked.push(parseInt($(this).val()));
            });

            if (checked.length === 0) {

                var shortCutFunction = 'error';
                var msg = 'من فضلك إختيار الرسائل التي تريد مسحها مع مراعاة انك لن تتمكن من إسترجعها ';
                var title = 'فشل';
                toastr.options = {
                    positionClass: 'toast-top-left',
                    onclick: null,
                    "preventDuplicates": true,
                    "preventOpenDuplicates": true
                };
                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;
                return false
            }
            swal({
                title: "هل انت متأكد؟",
                text: "سوف يتم مسح الرسائل نهائيا",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "موافق",
                cancelButtonText: "إلغاء",
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                closeOnConfirm: true,
                closeOnCancel: true,
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'GET',
                        url: '{{route('admin.support.removeAllMessages')}}',
                        data: {ids: checked},
                        dataType: 'json',
                        success: function (data) {
                            var shortCutFunction = 'success';
                            var msg = data.message;
                            var title = 'نجاح';
                            toastr.options = {
                                positionClass: 'toast-top-left',
                                onclick: null
                            };
                            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                            $toastlast = $toast;
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        }
                    });
                }
            }
            )
        }

        $('form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('.hideButton').hide();
            var form = $(this);
            form.parsley().validate();

            if (form.parsley().isValid() ) {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {

                        if (data.status == true) {
                            var shortCutFunction = 'success';
                            var msg = data.message;
                            var title = 'نجاح';
                            toastr.options = {
                                positionClass: 'toast-top-left',
                                onclick: null
                            };
                            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                            $toastlast = $toast;
                            setTimeout(function () {
                                location.reload();
                            }, 1500);

                        }

                        if (data.status == false) {

                            var shortCutFunction = 'error';
                            var msg = data.message;
                            var title = 'فشل';
                            toastr.options = {
                                positionClass: 'toast-top-left',
                                onclick: null
                            };
                            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                            $toastlast = $toast;
                        }

                    },
                    error: function (data) {
                    }
                });
            }else {
                $(".hideButton").show();
            }
        });

</script>



@endsection
