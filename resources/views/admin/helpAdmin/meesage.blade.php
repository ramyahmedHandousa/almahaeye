@extends('admin.layouts.master')

@section('title','حذف المستخدم')

@section('content')

    @if(request('type')=='refuse')
        <form method="POST" action="{{route('admin.users.refuse',$user->id)}}" id="form" data-parsley-validate
              novalidate>
            @csrf

            <h4 class="header-title m-t-0 m-b-30"> سبب رفض المستخدم</h4>
            <div class="col-xs-12">

                <div class="form-group {{ $errors->has('suspend') ? ' has-error' : '' }}">
                    <label for="deleted">الرسالة *</label>

                    <textarea class="form-control"
                              id="rejectedMessage"
                              type="text"
                              name="refuse"
                              required
                              placeholder="الرسالة  ..."
                              data-parsley-required-message="الرسالة مطلوبة"
                              data-parsley-maxlength="191"
                              data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (191) حرف"></textarea>

                    <p class="help-block" id="error_userName"></p>
                    @if($errors->has('suspend'))
                        <p class="help-block">
                            {{ $errors->first('suspend') }}
                        </p>
                    @endif

                </div>

                <div class="form-group text-right m-t-20">
                    <a href="javascript:;" data-url="{{route('admin.users.refuse',$user->id)}}" id="reject"
                       class="btn btn-primary waves-effect waves-light m-t-20">رفض</a>

                    <button onclick="window.history.back();return false;" type="reset"
                            class="btn btn-default waves-effect waves-light m-l-5 m-t-20">إلغاء</button>
                </div>
            </div>
        </form>

    @elseif(request('type')=='accept')
        <form method="POST" action="{{route('admin.users.activate',$user->id)}}" id="form" data-parsley-validate
              novalidate>
            @csrf

            <h4 class="header-title m-t-0 m-b-30"> سبب تفعيل المستخدم</h4>
            <div class="col-xs-12">

                <div class="form-group {{ $errors->has('suspend') ? ' has-error' : '' }}">
                    <label for="deleted">الرسالة *</label>

                    <textarea class="form-control"
                              id="acceptMessage"
                              type="text"
                              name="accept"
                              required
                              placeholder="الرسالة  ..."
                              data-parsley-required-message="الرسالة مطلوبة"
                              data-parsley-maxlength="191"
                              data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (191) حرف"></textarea>

                    <p class="help-block" id="error_userName"></p>
                    @if($errors->has('suspend'))
                        <p class="help-block">
                            {{ $errors->first('suspend') }}
                        </p>
                    @endif

                </div>


                <div class="form-group text-right m-t-20">
                    <a href="javascript:;" data-url="{{route('admin.users.activate',$user->id)}}" id="accept"
                       class="btn btn-success waves-effect waves-light m-t-20">تفعيل</a>

                    <button onclick="window.history.back();return false;" type="reset"
                            class="btn btn-default waves-effect waves-light m-l-5 m-t-20">إلغاء</button>
                </div>
            </div>
        </form>

    @elseif(request('type')=='suspend')
        <form method="POST" action="{{route('admin.users.suspend',$user->id)}}" id="form" data-parsley-validate
              novalidate>
            @csrf

            <h4 class="header-title m-t-0 m-b-30"> سبب تعطيل المستخدم</h4>
            <div class="col-xs-12">

                <div class="form-group {{ $errors->has('suspend') ? ' has-error' : '' }}">
                    <label for="deleted">الرسالة *</label>

                    <textarea class="form-control"
                              id="suspendMessage"
                              type="text"
                              name="suspend"
                              required
                              placeholder="الرسالة  ..."
                              data-parsley-required-message="الرسالة مطلوبة"
                              data-parsley-maxlength="191"
                              data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (191) حرف"></textarea>

                    <p class="help-block" id="error_userName"></p>
                    @if($errors->has('suspend'))
                        <p class="help-block">
                            {{ $errors->first('suspend') }}
                        </p>
                    @endif

                </div>


                <div class="form-group text-right m-t-20">
                    <a href="javascript:;" data-url="{{route('admin.users.suspend',$user->id)}}" id="suspend"
                       class="btn btn-danger waves-effect waves-light m-t-20">تعطيل</a>

                    <button onclick="window.history.back();return false;" type="reset"
                            class="btn btn-default waves-effect waves-light m-l-5 m-t-20">إلغاء</button>
                </div>
            </div>
        </form>

    @elseif(request('type')=='delete')
        <form method="POST" action="{{route('admin.users.delete',$user->id)}}" id="form" data-parsley-validate
              novalidate>
            @csrf

            <h4 class="header-title m-t-0 m-b-30"> سبب حذف المستخدم</h4>
            <div class="col-xs-12">

                <div class="form-group {{ $errors->has('suspend') ? ' has-error' : '' }}">
                    <label for="deleted">الرسالة *</label>

                    <textarea class="form-control"
                              id="deleteMessage"
                              type="text"
                              name="delete"
                              required
                              placeholder="الرسالة  ..."
                              data-parsley-required-message="الرسالة مطلوبة"
                              data-parsley-maxlength="191"
                              data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (191) حرف"></textarea>

                    <p class="help-block" id="error_userName"></p>
                    @if($errors->has('suspend'))
                        <p class="help-block">
                            {{ $errors->first('suspend') }}
                        </p>
                    @endif

                </div>


                <div class="form-group text-right m-t-20">
                    <a href="javascript:;" data-url="{{route('admin.users.delete',$user->id)}}" id="delete"
                       class="btn btn-danger waves-effect waves-light m-t-20">حذف</a>

                    <button onclick="window.history.back();return false;" type="reset"
                            class="btn btn-default waves-effect waves-light m-l-5 m-t-20">إلغاء</button>
                </div>
            </div>
        </form>

    @endif
@endsection



@section('scripts')



    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#reject').on('click', function () {
            var id = $(this).attr('data-id'); // it will get the id of user .....
            var $tr = $(this).closest($('#elementRow' + id).parent().parent());  // to get the whole row element
            var url = $(this).attr('data-url');

            var message = $("#rejectedMessage").val();
            swal({
                    title: "هل أنت متأكد ؟",
                    text: "هل ترغب في رفض هذا المعلم ؟",
                    type: "warning",
                    showCancelButton: true,

                    confirmButtonText: "موافق",
                    cancelButtonText: "إلغاء",
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    closeOnConfirm: true,
                    closeOnCancel: true,
                },
                function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id: id, message: message},
                            dataType: 'json',
                            success: function (data) {
                                if (data.status == true) {
                                    var shortCutFunction = 'success';
                                    var msg = 'تم رفض المستخدم بنجاح';
                                    var title = data.title;
                                    toastr.options = {
                                        positionClass: 'toast-top-center',
                                        onclick: null,
                                        showMethod: 'slideDown',
                                        hideMethod: "slideUp"
                                    };
                                    var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                                    $toastlast = $toast;

//                                    $tr.find('td').fadeOut(1000, function () {
//                                        $tr.remove();
//                                    });

                                    setTimeout(function () {
                                        window.location.href = data.url;
                                    }, 1000);

                                }
                            }
                        });
                    }
                })
        });



        $('#accept').on('click', function () {
            var id = $(this).attr('data-id'); // it will get the id of user .....
//            var $tr = $(this).closest($('#elementRow' + id).parent().parent());  // to get the whole row element
            var url = $(this).attr('data-url');

            var message = $("#acceptMessage").val();
            swal({
                    title: "هل أنت متأكد ؟",
                    text: "هل ترغب في تفعيل هذا المعلم ؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "موافق",
                    cancelButtonText: "إلغاء",
                    confirmButtonClass: 'btn-success waves-effect waves-light',
                    closeOnConfirm: true,
                    closeOnCancel: true,
                },
                function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id: id, message: message},
                            dataType: 'json',
                            success: function (data) {
                                if (data.status == true) {
                                    var shortCutFunction = 'success';
                                    var msg = 'تم تفعيل المستخدم بنجاح';
                                    var title = data.title;
                                    toastr.options = {
                                        positionClass: 'toast-top-center',
                                        onclick: null,
                                        showMethod: 'slideDown',
                                        hideMethod: "slideUp"
                                    };
                                    var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                                    $toastlast = $toast;

//                                    $tr.find('td').fadeOut(1000, function () {
//                                        $tr.remove();
//                                    });

                                    setTimeout(function () {
                                        window.location.href = data.url;
                                    }, 1000);

                                }
                            }
                        });
                    }
                })
        });


        $('#suspend').on('click', function () {
            var id = $(this).attr('data-id'); // it will get the id of user .....
//            var $tr = $(this).closest($('#elementRow' + id).parent().parent());  // to get the whole row element
            var url = $(this).attr('data-url');

            var message = $("#suspendMessage").val();
            swal({
                    title: "هل أنت متأكد ؟",
                    text: "هل ترغب في تعطيل هذا المعلم ؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "موافق",
                    cancelButtonText: "إلغاء",
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    closeOnConfirm: true,
                    closeOnCancel: true,
                },
                function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id: id, message: message},
                            dataType: 'json',
                            success: function (data) {
                                if (data.status == true) {
                                    var shortCutFunction = 'success';
                                    var msg = 'تم تعطيل المستخدم';
                                    var title = data.title;
                                    toastr.options = {
                                        positionClass: 'toast-top-center',
                                        onclick: null,
                                        showMethod: 'slideDown',
                                        hideMethod: "slideUp"
                                    };
                                    var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                                    $toastlast = $toast;

//                                    $tr.find('td').fadeOut(1000, function () {
//                                        $tr.remove();
//                                    });

                                    setTimeout(function () {
                                        window.location.href = data.url;
                                    }, 1000);

                                }
                            }
                        });
                    }
                })
        });


        $('#delete').on('click', function () {
            var id = $(this).attr('data-id'); // it will get the id of user .....
//            var $tr = $(this).closest($('#elementRow' + id).parent().parent());  // to get the whole row element
            var url = $(this).attr('data-url');

            var message = $("#deleteMessage").val();
            swal({
                    title: "هل أنت متأكد ؟",
                    text: "هل ترغب في حذف هذا المعلم ؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "موافق",
                    cancelButtonText: "إلغاء",
                    confirmButtonClass: 'btn-danger waves-effect waves-light',
                    closeOnConfirm: true,
                    closeOnCancel: true,
                },
                function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {id: id, message: message},
                            dataType: 'json',
                            success: function (data) {
                                if (data.status == true) {
                                    var shortCutFunction = 'success';
                                    var msg = 'تم حذف المستخدم';
                                    var title = data.title;
                                    toastr.options = {
                                        positionClass: 'toast-top-center',
                                        onclick: null,
                                        showMethod: 'slideDown',
                                        hideMethod: "slideUp"
                                    };
                                    var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                                    $toastlast = $toast;

//                                    $tr.find('td').fadeOut(1000, function () {
//                                        $tr.remove();
//                                    });

                                    setTimeout(function () {
                                        window.location.href = data.url;
                                    }, 1000);

                                }
                            }
                        });
                    }
                })
        });

    </script>


@endsection