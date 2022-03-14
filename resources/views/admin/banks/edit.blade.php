@extends('admin.layouts.master')
@section('title', __('maincp.users_manager'))



@section('styles')


    <style>
        #parsley-id-multiple-roles li{
            position: absolute;
            top: -22px;
            right: 80px;
        }
    </style>

@endsection

@section('content')


    <form method="POST" action="{{ route('banks.update', $bank->id) }}"
          enctype="multipart/form-data"
          data-parsley-validate novalidate>
    {{ csrf_field() }}
    {{ method_field('PUT') }}



    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12 col-sm-offset-2" >
                <div class="btn-group pull-right m-t-15">
                   {{--  <a href="{{ route('users.create') }}" type="button" class="btn btn-custom waves-effect waves-light"
                       aria-expanded="false"> @lang('maincp.add')
                        <span class="m-l-5">
                        <i class="fa fa-plus"></i>
                    </span>
                    </a> --}}
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-8 " >
                <div class="card-box">


                    <h4 class="header-title m-t-0 m-b-30">تعديل بيانات  الماركة</h4>


                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('name_ar') ? ' has-error' : '' }}">
                            <label for="name_ar">إسم بالعربي*</label>
                            <input type="text" name="name_ar" value="{{ $bank->name }}"
                                   class="form-control"
                                   required placeholder="name_ar  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message="    يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"
                                   data-parsley-minLength-message="    يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  name_ar  "
                            />
                            <p class="help-block" id="error_name_ar"></p>
                        </div>

                    </div>

                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                            <label for="name_en">إسم بالإنجليزي*</label>
                            <input type="text" name="name_en" value="{{ $bank?->translate('en')?->name }}"
                                   class="form-control"
                                   required placeholder="name_en  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message="    يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"
                                   data-parsley-minLength-message="    يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  name_en  "
                            />
                            <p class="help-block" id="error_name_en"></p>
                        </div>

                    </div>

                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('account_name_ar') ? ' has-error' : '' }}">
                            <label for="account_name_ar">إسم الحساب بالعربي*</label>
                            <input type="text" name="account_name_ar"  class="form-control"
                                   value="{{ $bank?->account_name }}"
                                   required placeholder="account_name_ar  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" account_name_ar  يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"
                                   data-parsley-minLength-message=" account_name_ar  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  account_name_ar  "
                            />
                            <p class="help-block" id="error_account_name_ar"></p>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('account_name_en') ? ' has-error' : '' }}">
                            <label for="account_name_en">إسم الحساب بالإنجليزي*</label>
                            <input type="text" name="account_name_en" value="{{ $bank?->translate('en')?->account_name }}" class="form-control"
                                   required placeholder="account_name_en  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" account_name_en  يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"
                                   data-parsley-minLength-message=" account_name_en  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  account_name_en  "
                            />
                            <p class="help-block" id="error_account_name_en"></p>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="quantity">رقم الأيبان</label>
                            <input type="number" min="0"  name="iban" oninput="validity.valid||(value='');"
                                   value="{{ $bank?->iban }}"
                                   class="form-control requiredFieldWithMaxLenght" required>
                            <p class="help-block" id="error_iban"></p>
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
            <div class="col-md-4">

                <div class="card-box" style="overflow: hidden;">
                    <h4 class="header-title m-t-0 m-b-30">الصورة الرئيسية</h4>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="file" name="image" class="dropify" data-max-file-size="6M"
                                   accept='.jpeg,.png,.jpg'
                                   data-default-file="{{$bank->getFirstMediaUrl('master_image','thumb')}}"
                            />
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
    </form>

@endsection

@section('scripts')

<script type="text/javascript"
        src="{{ request()->root() }}/assets/admin/js/validate-{{ config('app.locale') }}.js"></script>

@endsection

