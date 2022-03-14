@extends('admin.layouts.master')
@section('title' ,'تعديل منتج')

@section('styles')

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.1">
    </script>
    <!-- Load the MobileNet model. -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet@1.0.0"></script>

@endsection
@section('content')
    <form id="storeCampaign" method="POST" action="{{ route('products.update', $product->id) }}"
          enctype="multipart/form-data"
          data-parsley-validate
          novalidate class="submission-form">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <!-- Page-Title -->
        <div class="row">
            <div class="col-lg-10 col-sm-offset-1">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> @lang('maincp.back')<span class="m-l-5"><i
                                class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">إدارة المنتجات</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-sm-offset-1">
                <div class="card-box">

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">سعر المنتج*</label>
                            <input type="number"  name="price" value="{{ $product->price }}"
                                   class="form-control"
                                   required
                                   placeholder="سعر المنتج..."
                                   data-parsley-min=".01"
                                   {{--data-parsley-max="99"--}}
                                   data-parsley-min-message=" اقل رقم مسموح به .01"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="سعر المنتج إلزامي"
                                   data-parsley-type-message="السعر لا تقبل الحروف ارقام فقط"
                                   data-parsley-maxlength="55"
                                   data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (55) حرف"
                            />
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('price'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('price') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="clearfix"></div>


                    <div class="form-group text-right m-t-20">


                        <button class="btn btn-primary waves-effect waves-light m-t-20" id="btnRegister" type="submit">
                            حفظ البيانات
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
            src="{{ asset('assets/admin/js/validate-'.config('app.locale').'.js') }}"></script>
    <script>


@endsection


