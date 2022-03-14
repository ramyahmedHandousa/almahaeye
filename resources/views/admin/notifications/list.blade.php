@extends('admin.layouts.master')

@section('title' ,  __('maincp.notification'))

@section('content')


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="{{ route('create.public.notifications') }}" type="button"
                   class="btn btn-custom waves-effect waves-light"
                   aria-expanded="false">
                <span class="m-l-5">
                <i class="fa fa-plus"></i>
                </span>
                    @lang('maincp.add')
                </a>
            </div>
            <h4 class="page-title">@lang('maincp.notification')</h4>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="dropdown pull-right">
                    {{--@if($notifications->count()> 0)--}}
                        {{--<a style="float: left; margin-right: 15px;" class="btn btn-danger btn-sm getSelected">--}}
                            {{--<i class="fa fa-trash" style="margin-left: 5px"></i> @lang('maincp.delete_selected')--}}
                        {{--</a>--}}
                    {{--@endif--}}
                </div>

                <h4 class="header-title m-t-0 m-b-30">@lang('maincp.view_notification') </h4>

                <table id="datatable-responsive" class="table table-striped table-hover table-condensed"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>
                            #
                            {{--<div class="checkbox checkbox-primary checkbox-single">--}}
                            {{--<input type="checkbox" name="check" onchange="checkSelect(this)"--}}
                            {{--value="option2"--}}
                            {{--aria-label="Single checkbox Two">--}}
                            {{--<label></label>--}}
                            {{--</div>--}}
                        </th>

{{--                        <th>المرسل إليه </th>--}}
                        <th>@lang('maincp.notification')  </th>
                        <th>@lang('maincp.date_notify') </th>
                        <th>@lang('maincp.choose') </th>

                    </tr>
                    </thead>
                    <tbody>


                    @foreach($notifications as $row)
                        <tr>
                            <td>

                                <div class="checkbox checkbox-primary checkbox-single">
                                    <input type="checkbox" class="checkboxes-items"
                                           value="{{ $row->id }}"
                                           aria-label="Single checkbox Two">
                                    <label></label>
                                </div>

                            </td>


{{--                            <td>   {{ optional($row->user)->name }}  </td>--}}
                            <td>   {{ $row->body }}  </td>


                            <td>
                                {{ $row->created_at->diffForHumans() }}
                            </td>

                            {{--                            <td>{{ $row->created_at }}</td>--}}
                            <td>

                                <a href="javascript:;" id="elementRow{{ $row->id }}" data-id="{{ $row->id }}"
{{--                                   data-url="{{ route('notify.delete', $row->id) }}"--}}
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


        $(document).ready(function () {
            $('#datatable-responsive').DataTable({
             fixedHeader: true,
            'order':[[3, 'desc']],
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

        $('body').on('click', '.removeElement', function () {
            var id = $(this).attr('data-id');
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
                        url: '{{ route('notification.delete') }}',
                        data: {id: id},
                        dataType: 'json',
                        success: function (data) {
                            if (data) {
                                var shortCutFunction = 'success';
                                var msg = 'لقد تمت عملية الحذف بنجاح.';
                                var title = data.title;
                                toastr.options = {
                                    positionClass: 'toast-top-left',
                                    onclick: null
                                };
                                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                                $toastlast = $toast;
                            }

                            $tr.find('td').fadeOut(1000, function () {
                                $tr.remove();
                            });
                        }
                    });
                } else {

                    swal({
                        title: "تم الالغاء",
                        text: "انت لغيت عملية الحذف تقدر تحاول فى اى وقت :)",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "موافق",
                        confirmButtonClass: 'btn-info waves-effect waves-light',
                        closeOnConfirm: false,
                        closeOnCancel: false

                    });

                }
            });
        });


    </script>


@endsection



