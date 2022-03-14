@extends('admin.layouts.master')

@section('title' ,  __('maincp.notification'))

@section('content')


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="{{ route('notifications_admin.create') }}" style="margin-right: 2px"
                   type="button" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5" aria-expanded="false">
                      إشعار جماعي
                </a>
                <a href="{{ route('notifications_admin.promo_code') }}" style="margin-right: 2px"
                   type="button" class="btn btn-success btn-trans waves-effect w-md waves-success m-b-5" aria-expanded="false">
                      اكواد خصم
                </a>

                <button type="button" class="btn btn-custom  waves-effect waves-light"  style="margin-right: 2px"
                        onclick="window.history.back();return false;">@lang('maincp.back')   <span class="m-l-5"><i
                            class="fa fa-reply"></i></span>
                </button>
            </div>
            <h4 class="page-title">@lang('maincp.notification')  </h4>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="dropdown pull-right">

                </div>

                <h4 class="header-title m-t-0 m-b-30">@lang('maincp.view_notification') </h4>

                <table id="datatable-fixed-header" class="table table-striped table-hover table-condensed"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th>@lang('maincp.notification')  </th>
                        <th>@lang('maincp.date_notify') </th>
                        <th>@lang('maincp.choose') </th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($notifications as $row)
                        <tr>



                            <td>
                                {{ $row->body }}
                             </td>


                            <td>
                                {{ $row->created_at->diffForHumans() }}
                            </td>
                            <td>

                                @if($row->type == 10)
                                <a href="{{ route('bank.transfer.company') }}"
                                   class=" btn btn-icon btn-trans btn-xs waves-effect waves-light btn-info m-b-5">
                                    <i class="fa fa-eye"></i>
                                </a>

                                @elseif($row->type == 9)

                                <a href="{{ route('reports.dues.transporter') }}"
                                   class=" btn btn-icon btn-trans btn-xs waves-effect waves-light btn-info m-b-5">
                                    <i class="fa fa-eye"></i>
                                </a>



                                @elseif($row->type == 11)
                                 <a href="{{ route('support.index') }}"
                                   class=" btn btn-icon btn-trans btn-xs waves-effect waves-light btn-info m-b-5">
                                    <i class="fa fa-eye"></i>
                                </a>

                                @endif

                                <a href="javascript:;" id="elementRow{{ $row->id }}" data-id="{{ $row->id }}"
                                   data-url="{{ route('notifications_admin.delete', $row->id) }}"
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
                        url: '{{ route('notifications_admin.delete') }}',
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



