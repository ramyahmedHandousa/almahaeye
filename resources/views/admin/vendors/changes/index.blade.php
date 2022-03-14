@extends('admin.layouts.master')

@section('title', 'المستخدمين')
@section('styles')

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
            <h4 class="page-title">طلبات التغير  </h4>
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
                        <th>إسم التاجر</th>
                        <th> رقم هاتف التاجر</th>
                        <th>رقم الإيبان</th>
                        <th>رقم السجل التجاري</th>
                        <th>العنوان</th>
                        <th>@lang('trans.created_at')</th>
                        <th>@lang('trans.options')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($changes as $row)
                        <tr>
                            <td>{{ $row->user?->name }}</td>
                            <td>{{ $row->user?->phone ? : 'لايوجد' }}</td>
                            <td>{{ $row->iban ? : 'لايوجد' }}</td>
                            <td>{{ $row->commercial_registration	 ? : 'لايوجد' }}</td>
                            <td>{{ $row->address ? : 'لايوجد' }}</td>
                            <td>{{ $row->created_at != ''? @$row->created_at->format('Y/m/d'): "--" }}</td>
                            <td>


                                <a href="#"
                                   onclick="acceptedOrRefuse({{$row->id}},'accepted')"
                                   data-href="{{route('change_profile_status',$row->id)}}"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="موافقة"
                                   class="btn btn-icon btn-xs waves-effect  btn-success my-row-{{$row->id}}">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="#"
                                   onclick="acceptedOrRefuse({{$row->id}},'refuse')"
                                   data-href="{{route('change_profile_status',$row->id)}}"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="رفض"
                                   class="btn btn-icon btn-xs waves-effect  btn-danger my-row-{{$row->id}}">
                                    <i class="fa fa-ban" aria-hidden="true"></i>

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


        function acceptedOrRefuse(id,status) {

            var href = $('.my-row-'+id).attr('data-href') + '?type='+status;

            console.log(href)
            swal({
                title: "هل انت متأكد؟",
                type: "success",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "موافق",
                cancelButtonText: "إلغاء",
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                closeOnConfirm: true,
                closeOnCancel: true,
            }, function (isConfirm) {
                if(isConfirm){
                    window.location = href
                }
            });

        }

        $(document).ready(function () {
            $('#datatable-responsive').DataTable( {
                "order": [[ 5, "desc" ]]
            } );

        });

    </script>


@endsection



