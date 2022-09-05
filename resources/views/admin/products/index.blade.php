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
            <div class="btn-group pull-right m-t-15 ">
                <a href="{{ route('products.create') }}@if(request('type'))?type={{request('type')}}@endif"
                   type="button" class="btn btn-custom waves-effect waves-light"
                   aria-expanded="false">
                <span class="m-l-5">
                <i class="fa fa-plus"></i>
                </span>
                    إضافة منتج جديد
                </a>
            </div>
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

                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th>إسم المنتج</th>
                        <th>قسم المنتج</th>
                        <th>سعر المنتج</th>
                        <th>السعر بعد النسبة</th>
                        <th>كمية المنتج</th>
                        <th>ماركة المنتج</th>
{{--                        <th>لديه GLB</th>--}}
                        <th>@lang('trans.created_at')</th>
                        <th>@lang('trans.options')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->category?->name }}</td>
                            <td>{{ $row->price }}</td>
                            <td>{{ number_format( $row->price_percentage  ?? $row->price ,2) }}</td>
                            <td>{{ $row->quantity }}</td>
                            <td>{{ $row->brand?->name }}</td>

{{--                            <td>{{ $row->getMedia('glb')->first() ? 'نعم' : 'لا' }}</td>--}}
                            <td>{{ $row->created_at != ''? @$row->created_at->format('Y/m/d'): "--" }}</td>
                            <td>
                                @if(!$row->is_new)

                                    <a href="javascript:;" data-id="{{ $row->id }}" data-type="{{$row->is_new == 0 ? 1 : 0}}"
                                       onclick="specialProduct({{$row->id}})"
                                       data-url="{{ route('products.new') }}"
                                       class="m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill special_product{{ $row->id }}"
                                       id="elementRow{{ $row->id }}"
                                       data-toggle="tooltip" data-placement="top"
                                       title="" data-original-title="منتج حالي">
                                        <i class="fa fa-check  text-success" aria-hidden="true"></i>
                                    </a>

                                @endif

                                <a href="{{ route('products.edit', $row->id) }}@if(request('type'))?type={{request('type')}}@endif"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="@lang('institutioncp.edit')"
                                   class="btn btn-icon btn-xs waves-effect  btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" data-url="{{ route('products.delete') }}"
                                   id="elementRow{{ $row->id }}" data-id="{{ $row->id }}"
                                   class="removeElement btn btn-icon btn-trans btn-xs waves-effect waves-light btn-danger m-b-5">
                                    <i class="fa fa-remove"></i>
                                </a>

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

        function specialProduct(productId) {

            var dataProductSet = $('.special_product'+ productId)[0].dataset;
            var $tr = $('.special_product' + dataProductSet.id).parent().parent();

            let id = dataProductSet.id,
                type = dataProductSet.type,
                url = dataProductSet.url;

            swal({
                title: "{{ __('maincp.make_sure') }}",
                text: 'سوف يتم نقله للمنتجات الحالية',
                type: "success",
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
                            if (data.status === true) {

                                toastr.options = {
                                    positionClass: 'toast-top-center',
                                    onclick: null,
                                    showMethod: 'slideDown',
                                    hideMethod: "slideUp",
                                };
                                $toastlast = toastr['success']('تم نقله للمنتجات الحالية', 'نجاح');

                                $tr.find('td').fadeOut(1000, function () {
                                    $tr.remove();
                                });
                            }
                        }
                    });
                }
            });

        }


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
                "order": [[ 4, "desc" ]]
            } );

        });

    </script>


@endsection



