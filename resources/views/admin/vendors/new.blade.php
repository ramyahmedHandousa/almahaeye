@extends('admin.layouts.master')

@section('title', 'المستخدمين')
@section('styles')

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
                        <th>كود التفعيل</th>
                        <th>البنك التابع له</th>
                        <th>الحي التابع له</th>
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
                            <td>{{ $row->verify?->action_code }}</td>
                            <td>{{ $row->bank?->name ? : 'لايوجد' }}</td>
                            <td>{{ $row->country?->name ? : 'لايوجد' }}</td>
                            <td>{{ $row->created_at != ''? @$row->created_at->format('Y/m/d'): "--" }}</td>
                            <td>

                                <a href="{{ route('vendors.show', $row->id) }}"
                                   data-toggle="tooltip" data-placement="top"
                                   data-original-title="تفاصيل"
                                   class="btn btn-icon btn-xs waves-effect  btn-info">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                <a href="{{ route('vendors.refuse', $row->id)}}" title=" رفض"
                                   class="btn btn-icon btn-xs waves-effect btn-danger">
                                    <i class="fa fa-times-circle"></i>
                                </a>

                                <a href="{{route('vendors.accepted', $row->id) }}" title="قبول"
                                   class="btn btn-icon btn-xs waves-effect btn-success">
                                    <i class="fa fa-check-circle"></i>
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


    </script>


@endsection



