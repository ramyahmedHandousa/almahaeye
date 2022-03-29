@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15 ">
                <a href="{{ route('abilities.create') }}"
                   type="button" class="btn btn-custom waves-effect waves-light"
                   aria-expanded="false">
                <span class="m-l-5">
                <i class="fa fa-plus"></i>
                </span>
                    إضافة   جديدة
                </a>
            </div>
            <h4 class="page-title">الصلاحيات  </h4>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
           بيانات
        </div>

        <div class="panel-body table-responsive">
            <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>الإسم</th>
                        <th>&nbsp;خيارات</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach ($abilities as $key => $ability)
                        <tr data-entry-id="{{ $ability->id }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $ability->name }}</td>
                            <td>
                                <a href="{{ route('abilities.edit',[$ability->id]) }}" class="btn btn-xs btn-info"> تعديل الصلاحية</a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        window.route_mass_crud_entries_destroy = "{{ route('abilities.mass_destroy') }}";
    </script>
@endsection
