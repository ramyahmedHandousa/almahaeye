@extends('admin.layouts.master')

@section('title', __('maincp.cities'))

@section('content')


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15 ">
                <a href="{{ route('promo_codes.create') }} "
                   type="button" class="btn btn-custom waves-effect waves-light"
                   aria-expanded="false">
                <span class="m-l-5">
                <i class="fa fa-plus"></i>
                </span>
                    إضافة كود خصم
                </a>
            </div>
            <h4 class="page-title">{{$pageName}} </h4>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <div class="dropdown pull-right">
                    {{--<a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">--}}
                    {{--<i class="zmdi zmdi-more-vert"></i> --}}
                    {{--</a>--}}

                </div>

                <h4 class="header-title m-t-0 m-b-30"> إدارة {{$pageName}}</h4>

                <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>   الكود </th>
                        <th>  تاريخ بداية الكود </th>
                        <th>  نهاية إستخدام الكود </th>
                        <th>   عدد مرات إستخدام الكود  لكل مستخدم</th>
                        <th>  نسبة خصم الكود </th>
                        <th>@lang('trans.options')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($promo_codes as $row)
                        <tr>

                            <td>{{ $row->code }}</td>
                            <td>{{ $row->start_at->format("Y/m/d") }}</td>
                            <td>{{ $row->end_at->format("Y/m/d") }}</td>
                            <td>{{ $row->time_used }}</td>
                            <td>  {{ $row->percentage }} %</td>

                            <td>

                                <a href="{{ route('promo_codes.edit', $row->id) }}"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title=" تعديل"
                                   class="btn btn-icon btn-xs waves-effect  btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>


                                <a href="javascript:;" data-url="{{ route('promo_codes.delete') }}" id="elementRow{{ $row->id }}" data-id="{{ $row->id }}"
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
            //$('#datatable').dataTable();
            //$('#datatable-keytable').DataTable( { keys: true } );
            $('#datatable-responsive').DataTable();

        });


    </script>


@endsection



