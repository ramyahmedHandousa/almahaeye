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


    <form method="POST" action="{{ route('shipping.update', $shipping->id) }}"
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

            <div class="col-sm-12 " >
                <div class="card-box">


                    <h4 class="header-title m-t-0 m-b-30">تعديل بيانات  </h4>


                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('name_ar') ? ' has-error' : '' }}">
                            <label for="name_ar">إسم بالعربي*</label>
                            <input type="text" name="name_ar" value="{{ $shipping->name }}"
                                   class="form-control"
                                   required placeholder="name_ar  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message="    يجب أن يكون 225 حروف فقط" data-parsley-minLength="1"
                                   data-parsley-minLength-message="    يجب أن يكون اكثر من 1 حروف "
                                   data-parsley-required-message="يجب ادخال  name_ar  "
                            />
                            <p class="help-block" id="error_name_ar"></p>
                        </div>

                    </div>



                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                            <label for="name_en">إسم بالإنجليزي*</label>
                            <input type="text" name="name_en" value="{{ $shipping?->translate('en')?->name }}"
                                   class="form-control"
                                   required placeholder="name_en  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message="    يجب أن يكون 225 حروف فقط" data-parsley-minLength="1"
                                   data-parsley-minLength-message="    يجب أن يكون اكثر من 1 حروف "
                                   data-parsley-required-message="يجب ادخال  name_en  "
                            />
                            <p class="help-block" id="error_name_en"></p>
                        </div>

                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="price">  سعر  الشحن  *</label>
                            <input type="number" name="price" value="{{$shipping->price}}"  min=0 oninput="validity.valid||(value='');"
                                   class="form-control requiredFieldWithMaxLenght" required>
                            <p class="help-block" id="error_price"></p>
                        </div>
                    </div>


                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="time_delivery"> الوقت المتوقع للتوصيل (ساعة) *</label>
                            <input type="number" name="time_delivery" value="{{ $shipping->time_delivery}}"
                                   class="form-control requiredFieldWithMaxLenght"
                                   required
                                   placeholder="الوقت المتوقع للتوصيل"
                                   min="1"/>
                            <p class="help-block" id="error_time_delivery"></p>
                            @if($errors->has('time_delivery'))
                                <p class="help-block">
                                    {{ $errors->first('time_delivery') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group" style="margin-top: 20px">
                            <label for="pay"> الدفع عند الاستلام  *</label>
                            <input type="checkbox" name="pay" value="1" id="pay"
                                   class="" required placeholder="الدفع عند الاستلام"
                                {{ $shipping->pay ? 'checked' : '' }} />
                            <p class="help-block" ></p>
                            @if($errors->has('pay'))
                                <p class="help-block">
                                    {{ $errors->first('pay') }}
                                </p>
                            @endif
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

@endsection

