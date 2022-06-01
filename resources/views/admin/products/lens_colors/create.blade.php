@extends('admin.layouts.master')
@section('title' , 'إضافة مستخدم')

@section('styles')
    <style>

        .hidden-category{
            visibility: hidden !important;
        }


    </style>

    <link href="{{asset('assets/admin/css/colorpicker.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <form id="myForm" method="POST" action="{{ route('colors.store') }}@if(request('type') )?type={{request('type')}} @endif" enctype="multipart/form-data" data-parsley-validate
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
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">إضافة  </h4>

                    <input type="hidden" name="type_color" value="lens">
                    <div class="col-xs-6 " >
                        <div id="colorSelector">
                            <div style="background-color: rgb(62, 62, 189); ">
                            </div>
                        </div>
                        <input type="hidden" name="hash_code_color" maxlength="6" size="6" id="mycolor" value="00ff00">
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('name_ar') ? ' has-error' : '' }}">
                            <label for="name_ar">إسم*</label>
                            <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control"
                                   required placeholder="name_ar  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" name_ar  يجب أن يكون 225 حروف فقط" data-parsley-minLength="1"
                                   data-parsley-minLength-message=" name_ar  يجب أن يكون اكثر من 1 حروف "
                                   data-parsley-required-message="يجب ادخال  name_ar  "
                            />
                            <p class="help-block" id="error_name_ar"></p>
                        </div>
                    </div>


                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                            <label for="name_en">إسم بالإنجليزي*</label>
                            <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control"
                                   required placeholder="name_en  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" name_en  يجب أن يكون 225 حروف فقط" data-parsley-minLength="1"
                                   data-parsley-minLength-message=" name_en  يجب أن يكون اكثر من 1 حروف "
                                   data-parsley-required-message="يجب ادخال  name_en  "
                            />
                            <p class="help-block" id="error_name_en"></p>
                        </div>
                    </div>


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


        </div>
        <!-- end row -->
    </form>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/admin/js/colorpicker.js')}}"></script>

    <script>
        var currentHex = '#0000ff';

        $('#colorSelector').ColorPicker({
            flat: true,
            onChange: function (hsb, hex, rgb) {
                // every time a new colour is selected, this function is called
                currentHex = hex;
                $('#mycolor').val(currentHex);
            }
        });

        // $('#colorSelector').ColorPicker({
        //     color: currentHex,
        //     onShow: function (colpkr) {
        //         $(colpkr).fadeIn(500);
        //         return false;
        //     },
        //     onHide: function (colpkr) {
        //         $(colpkr).fadeOut(500);
        //         return false;
        //     },
        //     onChange: function (hsb, hex, rgb) {
        //         // every time a new colour is selected, this function is called
        //         currentHex = hex;
        //         $('#mycolor').val(currentHex);
        //     }
        // });
    </script>

@endsection
