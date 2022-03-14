@extends('admin.layouts.master')
@section('title' ,'إضافة عرض')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ request()->root() }}/assets/admin/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"
          rel="stylesheet">
    <link href="{{ request()->root() }}/assets/admin/plugins/bootstrap-daterangepicker/daterangepicker.css"
          rel="stylesheet">

<style>
    .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
        text-align: right;
    }
    .bootstrap-select>.dropdown-toggle.bs-placeholder, .bootstrap-select>.dropdown-toggle.bs-placeholder:active, .bootstrap-select>.dropdown-toggle.bs-placeholder:focus, .bootstrap-select>.dropdown-toggle.bs-placeholder:hover {
        height: 38px;
    }
    .datepicker-dropdown {
        margin-top: 25px;
    }
</style>
@endsection
@section('content')
    <form id="storeCampaign" method="POST" action="{{ route('offers.store') }}" enctype="multipart/form-data"
          data-parsley-validate
          novalidate class="submission-form">
    {{ csrf_field() }}
    <!-- Page-Title -->
        <div class="row">
            <div class="col-lg-10 col-sm-offset-1">
                <div class="btn-group pull-right m-t-15">
                    <a type="button" href="{{route('offers.index')}}" class="btn btn-custom  waves-effect waves-light"
                            {{--onclick="window.history.back();return false;"--}}
                    > @lang('maincp.back') <span class="m-l-5"><i
                                    class="fa fa-reply"></i></span>
                    </a>
                </div>
                <h4 class="page-title">إدارة العروض</h4>
            </div>
        </div>

        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-lg-10 col-sm-offset-1">
                <div class="card-box" style="margin-bottom: 130px">
                    <h2 class="header-title m-t-0 m-b-30">إضافة عرض </h2>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="userName">المنتج*</label>
                            <select name="product_id" data-style="text-right"  class="form-control select2 "
                                    data-live-search="true" title="اختر المنتج.."   required
                                    data-parsley-required-message="المنتج إلزامي">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>

                            <p class="help-block" id="error_userName"></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="discount">سعر الخصم*</label>
                            <input type="number"  name="discount" value="{{ old('discount') }}" class="form-control"
                                   required placeholder="سعر الخصم..."
                            />
                            <p class="help-block" id="error_discount"></p>
                        </div>
                    </div>


                    <div class="col-sm-6">

                        <div class="form-group">
                            <label class="control-label">مدة العرض</label>
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control" name="start_at" autocomplete="off" required
                                       data-parsley-required-message="تاريخ بداية العرض إلزامي"
                                       placeholder="تاريخ بداية العرض" value="{{ old('start_at') }}"/>
                                <span class="input-group-addon bg-primary b-0 text-white">إلي</span>
                                <input type="text" class="form-control" name="end_at" autocomplete="off"
                                       data-parsley-required-message="تاريخ نهاية العرض إلزامي"
                                       placeholder="تاريخ نهاية العرض" value="{{ old('end_at') }}" required/>
                            </div>

                        </div>
                    </div>



                    <div class="clearfix" style="margin-bottom: 50px"></div>


                    <div class="form-group text-right m-t-20" style="margin-bottom: 50px">

                        <img id="indicatorImage" src="{{ request()->root() }}/assets/images/spinner.gif"
                             style="width: 50px; height: 50px; display: none; margin-top: 20px;">

                        <button class="btn btn-primary waves-effect waves-light m-t-20" id="btnRegister" type="submit">
                            إضافة عرض
                        </button>
                        <button onclick="window.history.back();return false;" type="reset"
                                class="btn btn-default waves-effect waves-light m-l-5 m-t-20">
                            @lang('maincp.disable')
                        </button>
                    </div>

                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->
    </form>
@endsection


@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript"
            src="{{ request()->root() }}/assets/admin/js/validate-{{ config('app.locale') }}.js"></script>

    <script src="{{ request()->root() }}/assets/admin/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ request()->root() }}/assets/admin/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>


    <script src="{{ request()->root() }}/assets/admin/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"
            type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        jQuery('#date-range').datepicker({
            toggleActive: true,
            autoClose: true
        });



    </script>

@endsection


