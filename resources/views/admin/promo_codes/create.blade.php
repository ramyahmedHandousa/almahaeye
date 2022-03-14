@extends('admin.layouts.master')
@section('title', __('maincp.users_manager'))


@section('styles')



@endsection

@section('content')



    <form   method="POST" action="{{ route('promo_codes.store') }}" enctype="multipart/form-data"
            data-parsley-validate novalidate>
    {{ csrf_field() }}

    <!-- Page-Title -->
        <div class="row">
            <div class="col-lg-12  ">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> رجوع <span class="m-l-5"><i
                                class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">إدارة {{$pageName}}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12  ">
                <div class="card-box">


                    <h4 class="header-title m-t-0 m-b-30"> إضافة {{$pageName}}</h4>

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

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="times"> الكود للمستخدم </label>
                                <input type="number" name="code" value="{{old('code')}}"  min=1 maxlength="10" oninput="validity.valid||(value='');"
                                       class="form-control    number " required />
                                <p class="help-block" id="error_times"></p>
                            </div>
                        </div>

                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="time_used">عدد مرات  إستخدام الكود للمستخدم </label>
                                    <input type="number" name="time_used"  value="{{old('time_used')}}" min=1 maxlength="6" oninput="validity.valid||(value='');"
                                           class="form-control    number " required />
                                    <p class="help-block" id="error_time_used"></p>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="percentage">نسبة خصم إستخدام الكود للمستخدم   </label>

                                    <div class="input-group bootstrap-touchspin">
                                        <input class="form-control  " value="{{old('percentage')}}" type="text" required
                                               name="percentage" min=1 maxlength="3" placeholder="نسبة خصم إستخدام الكود للمستخدم"  >

                                        <span class="input-group-addon bootstrap-touchspin-postfix">%</span>
                                    </div>
                                </div>
                            </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="date">تاريخ بداية إستخدام الكود </label>
                                <div class="input-group">
                                    <input type="text" name="start_at" value="{{old('start_at')}}" class="form-control   datepicker  " required />
                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                    <p class="help-block" id="error_date"></p>
                                </div>
                            </div>
                        </div>


                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="end_at">تاريخ نهاية إستخدام الكود </label>
                                <div class="input-group">
                                    <input type="text" name="end_at"  value="{{old('end_at')}}"   class="form-control  datepicker  " required />
                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                    <p class="help-block" id="error_end_at"></p>
                                </div>
                            </div>
                        </div>




                    </div>


                    <div class="form-group text-right m-t-20">
                        <button   class="btn btn-warning waves-effect waves-light m-t-20" type="submit">
                            @lang('maincp.save_data')
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


    <script type="text/javascript"
            src="{{ request()->root() }}/assets/admin/js/validate-{{ config('app.locale') }}.js"></script>

@endsection

