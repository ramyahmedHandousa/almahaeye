@extends('admin.layouts.master')
@section('title' , 'إضافة مستخدم')

@section('styles')
    <style>

        .hidden-category{
            visibility: hidden !important;
        }


    </style>
@endsection
@section('content')
    <form id="myForm" method="POST" action="{{ route('banks.store') }}" enctype="multipart/form-data" data-parsley-validate
          novalidate>
    {{ csrf_field() }}

    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> رجوع <span class="m-l-5"><i
                                    class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">إدارة البنوك</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">إضافة بنك</h4>

                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('name_ar') ? ' has-error' : '' }}">
                            <label for="name_ar">إسم*</label>
                            <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control"
                                   required placeholder="name_ar  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" name_ar  يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"
                                   data-parsley-minLength-message=" name_ar  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  name_ar  "
                            />
                            <p class="help-block" id="error_name_ar"></p>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                            <label for="name_en">إسم بالإنجليزي*</label>
                            <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control"
                                   required placeholder="name_en  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" name_en  يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"
                                   data-parsley-minLength-message=" name_en  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  name_en  "
                            />
                            <p class="help-block" id="error_name_en"></p>
                        </div>
                    </div>

{{--                    <div class="col-xs-12">--}}
{{--                        <div class="form-group{{ $errors->has('account_name_ar') ? ' has-error' : '' }}">--}}
{{--                            <label for="account_name_ar">إسم الحساب بالعربي*</label>--}}
{{--                            <input type="text" name="account_name_ar" value="{{ old('account_name_ar') }}" class="form-control"--}}
{{--                                   required placeholder="account_name_ar  ..." data-parsley-maxLength="225"--}}
{{--                                   data-parsley-maxLength-message=" account_name_ar  يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"--}}
{{--                                   data-parsley-minLength-message=" account_name_ar  يجب أن يكون اكثر من 3 حروف "--}}
{{--                                   data-parsley-required-message="يجب ادخال  account_name_ar  "--}}
{{--                            />--}}
{{--                            <p class="help-block" id="error_account_name_ar"></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-xs-12">--}}
{{--                        <div class="form-group{{ $errors->has('account_name_en') ? ' has-error' : '' }}">--}}
{{--                            <label for="account_name_en">إسم الحساب بالإنجليزي*</label>--}}
{{--                            <input type="text" name="account_name_en" value="{{ old('account_name_en') }}" class="form-control"--}}
{{--                                   required placeholder="account_name_en  ..." data-parsley-maxLength="225"--}}
{{--                                   data-parsley-maxLength-message=" account_name_en  يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"--}}
{{--                                   data-parsley-minLength-message=" account_name_en  يجب أن يكون اكثر من 3 حروف "--}}
{{--                                   data-parsley-required-message="يجب ادخال  account_name_en  "--}}
{{--                            />--}}
{{--                            <p class="help-block" id="error_account_name_en"></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-xs-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="quantity">رقم الأيبان</label>--}}
{{--                            <input type="number" min="0"  name="iban" oninput="validity.valid||(value='');"  class="form-control requiredFieldWithMaxLenght" required>--}}
{{--                            <p class="help-block" id="error_iban"></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="form-group text-right m-t-20">
                        <button id="hiddenButton" class="btn btn-primary waves-effect waves-light m-t-20" type="submit">
                            حفظ البيانات
                        </button>
                        <button onclick="window.history.back();return false;" type="reset"
                                class="btn btn-default waves-effect waves-light m-l-5 m-t-20">
                            إلغاء
                        </button>
                    </div>

                </div>
            </div><!-- end col -->

            <div class="col-lg-4">
                <div class="card-box" style="overflow: hidden;">
                    <h4 class="header-title m-t-0 m-b-30">  الصورة   الأساسية</h4>
                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <div class="col-sm-12">
                            <input data-parsley-fileextension='jpg,png' id="image" type="file" required
                                   accept='.jpeg,.png,.jpg' name="image" class="dropify" data-max-file-size="6M"/>
                            @if($errors->has('image'))
                                <p class="help-block">
                                    {{ $errors->first('image') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </form>
@endsection

@section('scripts')


@endsection
