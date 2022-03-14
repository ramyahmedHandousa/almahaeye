@extends('admin.layouts.master')

@section('title', "إدارة العروض")
@section('styles')

    <!-- Custom box css -->
    <link href="{{ request()->root() }}/assets/admin/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

    <style>
        .errorValidationReason {
            border: 1px solid red;
        }
    </style>
@endsection
@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15 ">
                <a href="{{ route('offers.create') }}" type="button" class="btn btn-custom waves-effect waves-light"
                   aria-expanded="false">
                <span class="m-l-5">
                <i class="fa fa-plus"></i>
                </span>إضافة عرض</a>
            </div>
            <h4 class="page-title">إدارة العروض</h4>
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
                <h4 class="header-title m-t-0 m-b-30">قائمة العروض</h4>
                <table id="datatable-fixed-header_users" class="table table-striped table-bordered dt-responsive "
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>إسم المنتج</th>
                        <th>سعر المنتج</th>
                        <th>سعر الخصم</th>
                        <th>تاريخ بداية العرض</th>
                        <th>تاريخ نهاية العرض</th>
                        <th>الخيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->discount}}</td>

                            <td>{{ $row->start_at->format('Y/m/d') }}</td>
                            <td>{{ $row->end_at->format('Y/m/d') }}</td>
                            <td>

                                <a href="{{ route('offers.edit', $row->id) }}"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="تعديل العرض"
                                   class="btn btn-icon btn-xs waves-effect btn-trans btn-success">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                <a href="javascript:;" id="elementRow{{ $row->id }}" data-id="{{ $row->id }}"
                                   data-url="{{ route('offers.destroy', $row->id) }}"
                                   class="destroyElement btn btn-icon btn-trans btn-xs waves-effect waves-light btn-danger">
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
    <script src="{{ request()->root() }}/assets/admin/plugins/custombox/dist/custombox.min.js"></script>
    <script src="{{ request()->root() }}/assets/admin/plugins/custombox/dist/legacy.min.js"></script>



    <!--"order": [[ 0, "desc" ]],-->

    <script>

        $('body').on('click', '.destroyElement', function () {
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
                        type: 'DELETE',
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
                        }
                    });
                }
            });
        });


        var table = $('#datatable-fixed-header_users').DataTable({
            order: [[4, "desc"]],
           // fixedHeader: true,

            // columnDefs: [{orderable: false, targets: [0]}],
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

        $(document).ready(function () {
            //$('#datatable').dataTable();
            //$('#datatable-keytable').DataTable( { keys: true } );
            $('#datatable-responsive').DataTable();

        });


    </script>


@endsection



