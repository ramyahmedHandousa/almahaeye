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
                <a href="{{ route('projects.create') }}"
                   type="button" class="btn btn-custom waves-effect waves-light"
                   aria-expanded="false">
                <span class="m-l-5">
                <i class="fa fa-plus"></i>
                </span>
                    إضافة مشروع جديد
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
                        <th>المالك</th>
                        <th>العنوان</th>
                        <th>@lang('trans.created_at')</th>
                        <th>@lang('trans.options')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($projects as $row)
                        <tr>
                            <td>{{ $row->owner }}</td>
                            <td>{{ $row->title }}</td>

                            <td>{{ $row->created_at != ''? @$row->created_at->format('Y/m/d'): "--" }}</td>
                            <td>

                                <a href="{{ route('projects.edit', $row->id) }}"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="@lang('institutioncp.show_details')"
                                   class="btn btn-icon btn-xs waves-effect  btn-info">
                                    <i class="fa fa-edit"></i>
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


            $(document).ready(function () {
                $('#datatable-responsive').DataTable( {
                    "order": [[ 3, "desc" ]]
                } );

            });

    </script>


@endsection



