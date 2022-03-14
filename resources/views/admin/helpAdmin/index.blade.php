@extends('admin.layouts.master')
@section('title', 'إدارة التطبيق ')
@section('content')

    <!-- Page-Title -->
    <div class="row zoomIn">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">

                    <a href="{{ route('helpAdmin.create') }}" type="button"
                       class="btn btn-custom waves-effect waves-light"
                       aria-expanded="false"> إضافة
                        <span class="m-l-5">
                            <i class="fa fa-plus"></i>
                        </span>
                    </a>


            </div>
            <h4 class="page-title">قائمة مديري التطبيق </h4>
        </div>
    </div>


    <div class="row zoomIn">

        <div class="col-sm-12">
            <div class="card-box rotateOutUpRight ">

                <div class="row">

                </div>
                <br>

                <table id="datatable-fixed-header" class="table  table-striped">
                    <thead>
                    <tr>
                        <th>الصورة</th>

                        <th>اسم المستخدم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الجوال</th>

                            <th>الصلاحيات</th>


                        <th>الحالة</th>
                        <th>الخيارات</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)

                        <tr>

                            <td style="width: 10%;">


                                <a data-fancybox="gallery"
                                   href="{{ $helper->getDefaultImage($user->image, request()->root().'/public/assets/admin/custom/images/default.png') }}">
                                    <img style="width: 50%; border-radius: 50%; height: 49px;"
                                         src="{{ $helper->getDefaultImage($user->image, request()->root().'/public/assets/admin/custom/images/default.png') }}"/>
                                </a>

                            </td>

                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>

                                <td>
                                    @foreach($user->roles as $role)
                                        <ul class="none-style-ul">
                                            <li style="font-size: 11px;">{{ $role->title }}</li>
                                        </ul>
                                    @endforeach
                                </td>

                            <td>

                                <div class="StatusActive{{ $user->id }}"  style="display: {{ $user->is_suspend == 0 ? "none" : "block" }}; text-align: center;">
                                    <img  width="23px" src="{{ request()->root() }}/public/assets/admin/images/false.png" alt="">
                                </div>
                                <div class="StatusNotActive{{ $user->id }}" style="display: {{ $user->is_suspend == 0 ? "block" : "none" }};  text-align: center;">
                                    <img width="23px" src="{{ request()->root() }}/public/assets/admin/images/ok.png" alt="">
                                </div>

                            </td>

                            <td>

                                <a href="{{ route('helpAdmin.show',$user->id) }}"
                                   class="btn btn-icon btn-xs waves-effect btn-default m-b-5">
                                    التفاصيل
                                </a>

                                <a href="{{ route('helpAdmin.edit',$user->id) }}"
                                   class="btn btn-icon btn-xs waves-effect btn-default m-b-5">
                                    <i class="fa fa-edit"></i>
                                </a>


                                {{--<a href="javascript:;" id="elementRow{{ $user->id }}" data-id="{{ $user->id }}"--}}
                                   {{--class="removeElement btn-xs btn-icon btn-trans btn-sm waves-effect waves-light btn-danger m-b-5">--}}
                                    {{--<i class="fa fa-remove"></i>--}}

                                {{--</a>--}}

                                <a href="javascript:;" data-id="{{ $user->id }}" data-type="0"
                                   data-url="{{ route('user.suspend') }}"  style="@if($user->is_suspend == 0) display: none;  @endif"
                                   class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill  suspendElement suspend{{ $user->id }}"
                                   id="suspendElement" data-message="تاكيد التفعيل"
                                   data-toggle="tooltip" data-placement="top"
                                   title="" data-original-title="فك الحظر ">
                                    <i class="fa fa-unlock"></i>
                                </a>

                                <a href="javascript:;" data-id="{{ $user->id }}" data-type="1"
                                   data-url="{{ route('user.suspend') }}" style="@if($user->is_suspend == 1) display: none;  @endif"
                                   class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill suspendElement unsuspend{{ $user->id }}"
                                   id="suspendElement"
                                   data-message="حظر"
                                   data-toggle="tooltip" data-placement="top"
                                   title="" data-original-title="{{ __('trans.suspend') }}">
                                    <i class="fa fa-lock"></i>
                                </a>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- End row -->
@endsection

@section('scripts')

    <script>
        function accept(fff) {
            var url = $(fff).attr('data-href');
            swal({
                title: "هل انت متأكد من التفعيل ؟",
                text: "سوف تكتب رسالة لسبب التفعيل.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#0edd35",
                confirmButtonText: "موافق",
                cancelButtonText: "إلغاء",
                confirmButtonClass: 'btn-success waves-effect waves-light',
                closeOnConfirm: false,
                closeOnCancel: true,
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = url
                }
            });
        }

        function suspend(fff) {
            var url = $(fff).attr('data-href');
            swal({
                title: "هل تريد تعطيل المستخدم ؟",
                text: "سوف تكتب رسالة لبيان سبب التعطيل.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "موافق",
                cancelButtonText: "إلغاء",
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                closeOnConfirm: false,
                closeOnCancel: true,
            }, function (isConfirm) {
                if (isConfirm) {
                    window.location.href = url
                }
            });
        }

    function Delete(fff) {
    var url = $(fff).attr('data-href');
    swal({
    title: "هل انت متأكد من حذفه؟",
    text: "سوف تكتب رسالة لبيان سبب الحذف.",
    type: "error",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "موافق",
    cancelButtonText: "إلغاء",
    confirmButtonClass: 'btn-danger waves-effect waves-light',
    closeOnConfirm: false,
    closeOnCancel: true,
    }, function (isConfirm) {
    if (isConfirm) {
    window.location.href = url
    }
    });
    }


    @if(session()->has('errors'))
    setTimeout(function () {
        showErrors('{{ session()->get('errors') }}');
    }, 1000);

    @endif

    function showErrors(message) {

        var shortCutFunction = 'error';
        var msg = message;
        var title = 'فشل!';
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


    </script>




@endsection

