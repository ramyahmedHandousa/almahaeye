@extends('admin.layouts.master')
@section('title', __('maincp.users_manager'))


@section('styles')



@endsection
@section('content')



    <form method="POST" action="{{ route('countries.store') }}@if(request('type'))?type={{request('type')}} @endif" enctype="multipart/form-data"
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

                        @if(request('type'))
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="country">إسم الدولة*</label>
                                    <select name="parent_id" id="country" class="form-control country requiredFieldWithMaxLenght" required>
                                        <option value="" selected disabled="">@lang('trans.select_city')</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if(in_array(request('type') ,[ 'subSub','subSubSub']))
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="sub_country">إسم المحافظة*</label>
                                        <select name="parent_id" id="sub_country" class="form-control sub_country requiredFieldWithMaxLenght" required>
                                        </select>
                                    </div>
                                </div>

                                @if(request('type') == 'subSubSub')
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for="sub_sub_country">إسم المدينة*</label>
                                            <select name="parent_id" id="sub_sub_country" class="form-control sub_sub_country requiredFieldWithMaxLenght" required>
                                            </select>
                                        </div>
                                    </div>
                                @endif

                            @endif
                        @endif


                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="userName">إسم   {{$pageName}} باللغة العربية*</label>
                                <input type="text" name="name_ar"
                                       class="form-control requiredFieldWithMaxLenght"
                                       required placeholder="    إسم {{$pageName}} باللغة العربية"/>
                                <p class="help-block" id="error_userName"></p>
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="userName">إسم {{$pageName}}* باللغة الإنجليزية</label>
                                <input type="text" name="name_en"
                                       class="form-control requiredFieldWithMaxLenght"
                                       required placeholder=" إسم {{$pageName}}   باللغة الإنجليزية"/>
                                <p class="help-block" id="error_userName"></p>
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                        </div>



                    </div>


                    <div class="form-group text-right m-t-20">
                        <button class="btn btn-warning waves-effect waves-light m-t-20" type="submit">
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
    <script type="text/javascript">

        $(document).ready(function() {

            $(document).on('change', '.country', function () {

                var City_id = $(this).val(),
                    div = $(this).parent().parent().parent(),
                    op = " ",
                    showElement = div.find('.showElement');

                $.ajax({
                    type: "Get",
                    beforeSend: function () {
                        $('.sub_country').text(" ");
                    },
                    url: '{{route('sub_countries')}}',
                    data: {'id': City_id},
                    success: function (data) {
                        var myData = data.data;

                        op += '<option  disabled selected>  إختر   الفرعي</option>';
                        for (var i = 0; i < myData.length; i++) {
                            op += '<option value="' + myData[i].id + '">' + myData[i].name + '</option>';
                        }
                        div.find('.sub_country').html(" ");
                        div.find('.sub_country').append(op);
                        showElement.delay(500).slideDown();

                    }
                })
            });
            $(document).on('change', '.sub_country', function () {

                var City_id = $(this).val(),
                    div = $(this).parent().parent().parent(),
                    op = " ",
                    showElement = div.find('.showElement');

                $.ajax({
                    type: "Get",
                    beforeSend: function () {
                        $('.sub_sub_country').text(" ");
                    },
                    url: '{{route('sub_countries')}}',
                    data: {'id': City_id},
                    success: function (data) {
                        var myData = data.data;

                        op += '<option  disabled selected>  إختر   الفرعي</option>';
                        for (var i = 0; i < myData.length; i++) {
                            op += '<option value="' + myData[i].id + '">' + myData[i].name + '</option>';
                        }
                        div.find('.sub_sub_country').html(" ");
                        div.find('.sub_sub_country').append(op);
                        showElement.delay(500).slideDown();

                    }
                })
            });
        });
    </script>
@endsection

