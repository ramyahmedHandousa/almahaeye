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
                        <th> الإسم التجاري</th>
                        <th> الإسم</th>
                        <th> رقم الهاتف</th>
                        <th>إيميل التواصل</th>
                        <th>البنك التابع له</th>
                        <th>الحي التابع له</th>
                        <th>نسبة التاجر</th>
                        <th>@lang('trans.created_at')</th>
                        <th>@lang('trans.options')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $row)
                        <tr>
                            <td>{{ $row->trade_name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->phone ? : 'لايوجد' }}</td>
                            <td>{{ $row->email ? : 'لايوجد' }}</td>
                            <td>{{ $row->bank?->name ? : 'لايوجد' }}</td>
                            <td>{{ $row->country?->name ? : 'لايوجد' }}</td>
                            <td>
                                <input type="number" data-id="{{$row->id}}" class="form-control update_percentage"
                                       data-url="{{route('admin_update_percentage')}}"
                                       min=0 oninput="validity.valid||(value='');"
                                       value="{{ $row->percentage ? : "0" }}"><br>
                            </td>
                            <td>{{ $row->created_at != ''? @$row->created_at->format('Y/m/d'): "--" }}</td>
                            <td>

                                <a href="{{ route('vendors.show', $row->id) }}"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="تعديل"
                                   class="btn btn-icon btn-xs waves-effect  btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('products.create') }}?user_id={{$row->id}}"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="إضافة منتجات"
                                   class="btn btn-icon btn-xs waves-effect  btn-info">
                                    <i class="fa fa-plus"></i>
                                </a>
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

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

        $(".update_percentage").bind('change keyup',delay( function (e) {

            var myId = e.target.dataset.id,
                url = e.target.dataset.url,
                myValue = e.target.value;

            if($.isNumeric(myValue) && myValue >= 0){

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {id: myId,value: myValue},
                    dataType: 'json',
                    success: function (data) {

                    }
                });
            }

        },500));

        $(document).ready(function () {
            $('#datatable-responsive').DataTable( {
                "order": [[ 3, "desc" ]]
            } );

        });

    </script>


@endsection



