<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ve Dashboard">
    <meta name="author" content="Ramy">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة تحكم ( عيون المها  )  </title>

    <link rel="stylesheet" href="{{asset('css/all.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css"/>
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.css" rel="stylesheet" />

{{--    @include('admin.layouts._partials.styles')--}}

    @yield('styles')


    <style>

        /*.card, .card-box, .panal, .pop-animate {*/
        /*    transition: all 1s;*/
        /*    transform: scale(0);*/
        /*    opacity: 0.5;*/
        /*}*/

        /*.card.show, .card-box.show, .panal.show, .pop-animate.show {*/
        /*    transform: scale(1);*/
        /*    opacity: 1;*/
        /*}*/

        .ms-container {
            width: 100%;
            float: right;
        }
        .dropify-wrapper .dropify-preview .dropify-render img {
            width: 100%;
        }

        input,
        input::-webkit-input-placeholder {
            font-size: 11px;
            line-height: 3;
        }



        .dt-buttons {
    position: absolute !important;
    left: 10px !important;
    top: -30px !important;
}



        @media print {

            body{

                direction: rtl;
            }
           .optionHidden{
                display: none !important;
            }
        }





        .ms-container .ms-selectable, .ms-container .ms-selection {
            background: #fff;
            color: #555555;
            float: right;
            width: 45%;
        }
        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.3);
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 1500ms infinite linear;
            -moz-animation: spinner 1500ms infinite linear;
            -ms-animation: spinner 1500ms infinite linear;
            -o-animation: spinner 1500ms infinite linear;
            animation: spinner 1500ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        .side-bar.right-bar{
            left: -422px;
        }


    </style>

{{--     @if(auth()->check())--}}
{{--         <script>--}}
{{--            var userId = '{{ auth()->id() }}';--}}
{{--            var url = '{{ route('user.update.token') }}';--}}
{{--             var lang = '{{ config('app.locale') }}';--}}
{{--        </script>--}}
{{--    @endif--}}



{{--    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>--}}
{{--    <script>--}}
{{--        window.OneSignal = window.OneSignal || [];--}}
{{--        OneSignal.push(function() {--}}
{{--            OneSignal.init({--}}
{{--                appId: "327cd339-1f99-473b-be4d-1e31530ca411",--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}


</head>


<body class="scroll-hidden">


{{--@yield('loader')--}}
@include('admin.layouts._partials.header')


<div class="loading" style="display: none;">Loading&#8230;</div>


@yield('content')


<!-- Right Sidebar -->
{{--<div class="side-bar right-bar" style="width: 25%">--}}
{{--    <a href="javascript:void(0);" class="right-bar-toggle">--}}
{{--        <i class="zmdi zmdi-close-circle-o"></i>--}}
{{--    </a>--}}
{{--    <h4 class="">الإشعارات </h4>--}}
{{--    <div class="notification-list nicescroll">--}}
{{--        <ul class="list-group list-no-border user-list">--}}

{{--            @if(isset($admin_notification_system) && count($admin_notification_system) > 0)--}}
{{--                @foreach($admin_notification_system as $notification)--}}
{{--                    <li class="list-group-item">--}}
{{--                            @if($notification->type == 1)--}}
{{--                                <a href="{{route('contact_us_inbox.index')}}" class="user-list-item">--}}
{{--                                <div class="icon bg-info">--}}
{{--                                <i class="zmdi zmdi-comments"></i>--}}

{{--                            @elseif($notification->type == 19)--}}
{{--                                <a href="{{ route('deliveries.index') }}?is_accepted=0" class="user-list-item">--}}
{{--                                <div class="icon bg-info">--}}
{{--                                <i class="zmdi zmdi-settings"></i>--}}
{{--                            @else--}}
{{--                                <a href="#" class="user-list-item">--}}
{{--                                <div class="icon bg-info">--}}
{{--                                <i class="zmdi zmdi-account"></i>--}}
{{--                            @endif--}}
{{--                            </div>--}}
{{--                            <div class="user-desc">--}}
{{--                                <span class="name">{{$notification->title}}  </span>--}}
{{--                                <span class="desc">{{$notification->body}}</span>--}}
{{--                                <span class="time">    {{$notification->created_at->diffForHumans()}} </span>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                @endforeach--}}

{{--            @else--}}
{{--                لا يوجد إشعارات حالية--}}
{{--            @endif--}}


{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- /Right-bar -->

<footer class="footer text-right" style="z-index: 100000">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12 text-left">&copy;

            @lang('institutioncp.copyrights')
             </div>

        </div>
    </div>
</footer>


{{--<script>--}}

{{--    if ('serviceWorker' in navigator) {--}}
{{--        // declaring scope manually--}}
{{--        navigator.serviceWorker.register('/firebase-messaging-sw.js', {scope: './'}).then(function(registration) {--}}
{{--            console.log('Service worker registration succeeded:', registration);--}}
{{--        }, /*catch*/ function(error) {--}}
{{--            console.log('Service worker registration failed:', error);--}}
{{--        });--}}
{{--    } else {--}}
{{--        console.log('Service workers are not supported.');--}}
{{--    }--}}
{{--</script>--}}
@include('admin.layouts._partials.scripts')
{{--  <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>--}}
{{--  <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-messaging.js"></script>--}}
{{-- <script src="{{ request()->root() }}/assets/fcm/FCM-Setup.js?date={{\Carbon\Carbon::now()}}"></script>--}}
<script>


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function () {
        setTimeout(function () {
            $('body').addClass('loaded');
            $('body').removeClass('scroll-hidden');
        }, 2000);
    });


</script>

{{--Datatables--}}

<script type="text/javascript">
    $('[data-dismiss=modal]').on('click', function (e) {
        window.location.reload(true);
    })
    $(document).ready(function () {

        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true,
            columnDefs: [{orderable: false, targets: [0]}],
            "language": {
                "lengthMenu": "@lang('maincp.show') _MENU_ @lang('maincp.perpage')",
                "info": "@lang('maincp.show') @lang('maincp.perpage') _PAGE_ @lang('maincp.from')_PAGES_",
                "infoEmpty": "@lang('maincp.no_recorded_data_available')",
                "infoFiltered": "(@lang('maincp.filter_from_max_total') _MAX_)",
                "paginate": {
                    "first": "@lang('maincp.first')",
                    "last": "@lang('maincp.last')",
                    "next": "@lang('maincp.next')",
                    "previous": "@lang('maincp.previous')"
                },
                "search": "@lang('maincp.search'):",
                "zeroRecords": "@lang('maincp.no_recorded_data_available')",

            },

        });
    });



</script>


<script type="text/javascript">





    @if(session()->has('success'))
    setTimeout(function () {
        showMessage('{{ session()->get('success') }}');
    }, 1000);

    @endif

    function showMessage(message) {

        var shortCutFunction = 'success';
        var msg = message;
        var title = "@lang('institutioncp.success')";
        toastr.options = {
            positionClass: 'toast-top-center',
            onclick: null,
            showMethod: 'slideDown',
            hideMethod: "slideUp",
        };
        var $toast = toastr[shortCutFunction](msg, title);
        // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;
    }



    @if(session()->has('myErrors'))
    setTimeout(function () {
        showErrors('{{ session()->get('myErrors') }}');
    }, 1000);

    @endif

    function showErrors(message) {

        var shortCutFunction = 'error';
        var msg = message;
        var title = "خطأ";
        toastr.options = {
            positionClass: 'toast-top-center',
            onclick: null,
            showMethod: 'slideDown',
            hideMethod: "slideUp",
        };
        var $toast = toastr[shortCutFunction](msg, title);
        // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;

    }



    $(function () {
        $('body').on('change', '.filteriTems', function (e) {

                e.preventDefault();

                var keyName = $('#filterItems').val();
                var pageSize = $('#recordNumber').val();

                var url = $(this).attr('data-url');

                if (keyName != '' && pageSize != '') {
                    var path = '{{  request()->root().'/'.request()->path() }}' + '?name=' + keyName + '&pageSize=' + pageSize;
                } else if (keyName != '' && pageSize == '' && pageSize == 'all') {
                    var path = '{{  request()->root().'/'.request()->path() }}' + '?name=' + keyName;
                } else if (keyName == '' && pageSize != '') {
                    var path = '{{  request()->root().'/'.request()->path() }}' + '?pageSize=' + pageSize;
                } else {
                    var path = '{{  request()->root().'/'.request()->path() }}' + '?pageSize=' + pageSize;
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {keyName: keyName, path: path, pageSize: pageSize}
                }).done(function (data) {
                    window.history.pushState("", "", path);
                    $('.articles').html(data);
                }).fail(function () {
                    alert('Articles could not be loaded.');
                });


            }
        );
    });

    $('body').on('click', '.suspendElement', function () {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var url = $(this).attr('data-url');
        swal({
            title: "{{ __('maincp.make_sure') }}",
            text: $(this).attr('data-message'),
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{ __('maincp.accepted') }}",
            cancelButtonText: "{{ __('maincp.disable') }}",
            confirmButtonClass: 'btn-warning waves-effect waves-light',
            closeOnConfirm: true,
            closeOnCancel: true,
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {id: id, type: type},
                    dataType: 'json',
                    success: function (data) {

                        if (data.status == true) {

                            if (data.type == 1) {
                                var shortCutFunction = 'success';
                                var msg = data.message;

                                $('.suspend' + data.id).delay(500).slideDown();
                                $('.unsuspend' + data.id).slideUp();

                                $('.StatusActive' + data.id).delay(500).slideDown();
                                $('.StatusNotActive' + data.id).slideUp();


                            } else {
                                var shortCutFunction = 'success';

                                var msg = data.message;

                                $('.unsuspend' + data.id).delay(500).slideDown();
                                $('.suspend' + data.id).slideUp();


                                $('.StatusNotActive' + data.id).delay(500).slideDown();
                                $('.StatusActive' + data.id).slideUp();

                            }

                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 1200);

                            // var shortCutFunction = 'success';
                            // var msg = 'لقد تمت عملية الحذف بنجاح.';
                            var title = data.title;
                            toastr.options = {
                                positionClass: 'toast-top-center',
                                onclick: null,
                                showMethod: 'slideDown',
                                hideMethod: "slideUp",
                            };
                            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                            $toastlast = $toast;
                        }else{



                            var shortCutFunction = 'error';
                            var msg = data.message;
                            var title = "@lang('institutioncp.error')";
                            toastr.options = {
                                positionClass: 'toast-top-center',
                                onclick: null,
                                showMethod: 'slideDown',
                                hideMethod: "slideUp",
                            };
                            var $toast = toastr[shortCutFunction](msg, title);
                            // Wire up an event handler to a button in the toast, if it exists
                            $toastlast = $toast;
                        }


                    }
                });
            }
        });
    });



    function redirectPage(route) {

        window.history.pushState("", "", route);
    }

    $('.dropify').dropify({
        messages: {
            'default': ' {{ __('institutioncp.insert_image') }} ',
            'replace': '{{ __('institutioncp.drag_and_drop_to_replace') }}',
            'remove': '{{ __('institutioncp.delete') }}',
            'error': '{{ __('institutioncp.something_went_wrong_try_again') }}'
        },
        error: {
            'fileSize': 'The file size is too big (1M max).',
            'fileExtension': ' {{ __('institutioncp.Incorrect_allowed_in_the_system') }} (pdf png gif jpg jpeg)',
        }
    });


    function checkSelect(item) {
        var checked = $(item).prop('checked');

        $('.checkboxes-items').each(function (i) {
            $(this).prop('checked', checked);
        })
    }

</script>


{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjBZsq9Q11itd0Vjz_05CtBmnxoQIEGK8&language={{ config('app.locale') }}&libraries=places&callback=initAutocomplete"--}}
{{--async defer></script>--}}


<script>



    $(document).ready(function () {
        $('form').parsley();
    });


</script>


<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.js"></script>

<script>

    var options = {
        autoClose: true,
        progressBar: true,
        enableSounds: true,
        // transition: "scale",
        sounds: {
            info: "https://res.cloudinary.com/dxfq3iotg/video/upload/v1557233294/info.mp3",
            success: "https://res.cloudinary.com/dxfq3iotg/video/upload/v1557233524/success.mp3",
            warning: "https://res.cloudinary.com/dxfq3iotg/video/upload/v1557233563/warning.mp3",
            error: "https://res.cloudinary.com/dxfq3iotg/video/upload/v1557233574/error.mp3",
        },
    };

    var toast = new Toasty(options);
    toast.configure(options);

    var pusher = new Pusher('559be9161cc5af611277', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('admin-channel');
    channel.bind('my-admin-notification', function(data) {

        var myData = JSON.stringify(data.message);

        toast.success( myData);
    });
</script>

</body>
</html>
