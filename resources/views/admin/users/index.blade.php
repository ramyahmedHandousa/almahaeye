@extends('admin.layouts.master')

@section('title', 'المستخدمين')
@section('styles')

    <!-- Custom box css -->
    <link href="/assets/admin/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

    <style>
        .errorValidationReason{

            border: 1px solid red;

        }
    </style>
@endsection
@section('content')

    <!-- Page-Title -->



    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{{$pageName}}  </h4>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <div class="dropdown pull-right">


                </div>

                <h4 class="header-title m-t-0 m-b-30">
                    {{--@lang('trans.managers_system')--}}
                </h4>

                <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th> الإسم</th>
                        <th> رقم الهاتف</th>
                        <th>إيميل التواصل</th>
                        <th>الدولة</th>
                        <th>المحافظة</th>
                        <th>المدينة</th>
                        <th>الحي</th>
                        <th>@lang('trans.created_at')</th>
                        <th>الحالة</th>
                        <th>@lang('trans.options')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->phone ? : 'لايوجد' }}</td>
                            <td>{{ $row->email ? : 'لايوجد' }}</td>
                            <td>{{ $row->country?->parent?->parent?->parent?->name }}</td>
                            <td>{{ $row->country?->parent?->parent?->name }}</td>
                            <td>{{ $row->country?->parent?->name }}</td>
                            <td>{{ $row->country?->name }}</td>
                            <td>{{ $row->created_at != ''? @$row->created_at->format('Y/m/d'): "--" }}</td>
                            <td>

                                <div class="StatusActive{{ $row->id }}"  style="display: {{ $row->is_suspend == 0 ? "none" : "block" }}; text-align: center;">
                                <!-- <img  width="23px" src="{{ asset('assets/admin/images/false.png') }}" alt=""> -->
                                    <i class="fa fa-times text-danger" aria-hidden="true"></i>
                                </div>
                                <div class="StatusNotActive{{ $row->id }}" style="display: {{ $row->is_suspend == 0 ? "block" : "none" }};  text-align: center;">
                                <!-- <img width="23px" src="{{ asset('assets/admin/images/ok.png') }}" alt=""> -->
                                    <i class="fa fa-check  text-success" aria-hidden="true"></i>
                                </div>

                            </td>
                            <td>

                                <a href="javascript:;" data-id="{{ $row->id }}" data-type="0"
                                   data-url="{{ route('users.suspend') }}"  style="@if($row->is_suspend == 0) display: none;  @endif"
                                   class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill  suspendElement suspend{{ $row->id }}"
                                   id="suspendElement" data-message="تاكيد التفعيل"
                                   data-toggle="tooltip" data-placement="top"
                                   title="" data-original-title="فك الحظر ">
                                    <i class="fa fa-unlock"></i>
                                </a>

                                <a href="javascript:;" data-id="{{ $row->id }}" data-type="1"
                                   data-url="{{ route('users.suspend') }}" style="@if($row->is_suspend == 1) display: none;  @endif"
                                   class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill suspendElement unsuspend{{ $row->id }}"
                                   id="suspendElement"
                                   data-message="حظر"
                                   data-toggle="tooltip" data-placement="top"
                                   title="" data-original-title="{{ __('trans.suspend') }}">
                                    <i class="fa fa-lock"></i>
                                </a>
{{--                                <a href="{{ route('shipping.edit', $row->id) }}"--}}
{{--                                   data-toggle="tooltip" data-placement="top"--}}
{{--                                   data-original-title="تعديل"--}}
{{--                                   class="btn btn-icon btn-xs waves-effect  btn-info">--}}
{{--                                    <i class="fa fa-edit"></i>--}}
{{--                                </a>--}}
{{--                                <a href="javascript:;" data-url="{{ route('shipping.delete') }}"--}}
{{--                                   id="elementRow{{ $row->id }}" data-id="{{ $row->id }}"--}}
{{--                                   class="removeElement btn btn-icon btn-trans btn-xs waves-effect waves-light btn-danger m-b-5">--}}
{{--                                    <i class="fa fa-remove"></i>--}}
{{--                                </a>--}}

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->


@endsection


@section('scripts')

    <!-- Modal-Effect -->
    <script src="/assets/admin/plugins/custombox/dist/custombox.min.js"></script>
    <script src="/assets/admin/plugins/custombox/dist/legacy.min.js"></script>


    <script>


        $('body').on('click', '.removeElement', function () {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            var $tr = $(this).closest($('#elementRow' + id).parent().parent());
            swal({
                title: "هل انت متأكد؟",
                text: "يمكنك استرجاع المحذوفات مرة اخرى لا تقلق.",
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
                        type: 'POST',
                        url: url,
                        data: {id: id},
                        dataType: 'json',
                        success: function (data) {

                            if (data.status == true) {
                                var shortCutFunction = 'success';
                                var msg = 'لقد تمت عملية الحذف بنجاح.';
                                var title = data.title;
                                toastr.options = {
                                    positionClass: 'toast-top-left',
                                    onclick: null
                                };
                                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                                $toastlast = $toast;

                                $tr.find('td').fadeOut(1000, function () {
                                    $tr.remove();
                                });
                            }

                            if (data.status == false) {
                                var shortCutFunction = 'warning';
                                var msg =data.message;
                                var title = data.title;
                                toastr.options = {
                                    positionClass: 'toast-top-left',
                                    onclick: null
                                };
                                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                                $toastlast = $toast;

                            }
                        }
                    });
                }
            });
        });



        $(document).ready(function () {
            $('#datatable-responsive').DataTable( {
                "order": [[ 3, "desc" ]]
            } );

        });

    </script>


@endsection



