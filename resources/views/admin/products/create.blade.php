@extends('admin.layouts.master')
@section('title' , 'إضافة مستخدم')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>

        .hidden-category{
            visibility: hidden !important;
        }


    </style>
@endsection
@section('content')
    <form id="myForm" method="POST" action="{{ route('products.store') }}@if(request('user_id'))?user_id={{request('user_id')}}@endif" enctype="multipart/form-data" data-parsley-validate
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
                <h4 class="page-title">إدارة المنتجات</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">إضافة منتج</h4>

                    <div class="col-xs-6">
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


                    <div class="col-xs-6">
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


                    @if(!request('user_id'))
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label for="parent_id">التاجر</label>
                            <select name="user_id" id="" class="form-control   requiredFieldWithMaxLenght" required>
                                <option value="" selected disabled=""> إختر  </option>
                                @foreach($vendors as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="col-xs-3">
                    @else
                        <div class="col-xs-6">
                    @endif

                        <div class="form-group">
                            <label for="parent_id">  القسم الرئيسي*</label>
                            <select name="category_id" id="" class="form-control   requiredFieldWithMaxLenght" required>
                                <option value="" selected disabled=""> إختر  </option>
                                @foreach($categories as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
{{--                    <div class="col-xs-3">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="userName">  القسم الفرعي*</label>--}}
{{--                            <select name="category_id" id="" class="form-control sub_category requiredFieldWithMaxLenght" required>--}}
{{--                                <option value="" selected disabled=""> إختر  </option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-xs-2">
                        <div class="form-group">
                            <label for="brand_id">الماركة</label>
                            <select name="brand_id" id="" class="form-control requiredFieldWithMaxLenght" required>
                                <option value="" selected disabled=""> إختر  </option>
                                @foreach($brands as $value)
                                    <option value="{{ $value->id }}" @if (old('brand_id') == $value->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-2">
                        <div class="form-group">
                            <label for="frame_material_id">خامات الإطار</label>
                            <select name="frame_material_id" id="" class="form-control requiredFieldWithMaxLenght" required>
                                <option value="" selected disabled=""> إختر  </option>
                                @foreach($frame_materials as $value)
                                    <option value="{{ $value->id }}" @if (old('frame_material_id') == $value->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-2">
                        <div class="form-group">
                            <label for="age_id">السن  </label>
                            <select name="age_id" id="" class="form-control " >
                                <option value="" selected disabled=""> إختر  </option>
                                @foreach($ages as $value)
                                    <option value="{{ $value->id }}" @if (old('age_id') == $value->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="frame_shap_id">شكل العدسة</label>
                            <select name="frame_shap_id" id="" class="form-control requiredFieldWithMaxLenght" required>
                                <option value="" selected disabled=""> إختر  </option>
                                @foreach($frame_shaps as $value)
                                    <option value="{{ $value->id }}" @if (old('frame_shap_id') == $value->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="product_type_id">أنواع النظارة</label>
                            <select name="product_type_id" id="" class="form-control requiredFieldWithMaxLenght" required>
                                <option value="" selected disabled=""> إختر  </option>
                                @foreach($product_types as $value)
                                    <option value="{{ $value->id }}" @if (old('product_type_id') == $value->id) selected @endif>{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="frame_color_id">لون الإطار</label>
                            <select name="frame_color_id[]" id="" class="form-control select2 requiredFieldWithMaxLenght" multiple required>
                                @foreach($framesColors as $value)
                                    <option value="{{ $value->id }}" >{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="lens_color_id">لون العدسة</label>
                            <select name="lens_color_id[]" id="" class="form-control select2 requiredFieldWithMaxLenght" multiple required>
                                @foreach($lensColors as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="frame_height"> طول الاطار*</label>
                            <input type="number" name="additional_data[frame_height]" value="{{ old('additional_data.frame_height') }}"
                                   class="form-control" placeholder=" طول الاطار.."
                                   {{--data-parsley-max="99"--}}
                                   data-parsley-min="0" data-parsley-min-message=" اقل رقم مسموح به 0"
                                   data-parsley-type="digits"data-parsley-type-message="طول الاطار لا تقبل الحروف ارقام فقط"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="طول الاطار  المنتج إلزامي"
                            />
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('frame_height'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('frame_height') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="userName"> طول الزراع*</label>
                            <input type="number" name="additional_data[temple_length]" value="{{ old('additional_data.temple_length') }}" class="form-control"

                                   {{--min="1"--}}
                                   placeholder=" طول الزراع.."
                                   {{--data-parsley-max="99"--}}
                                   data-parsley-min="0"
                                   data-parsley-min-message=" اقل رقم مسموح به 0"
                                   data-parsley-type="digits"
                                   data-parsley-type-message="طول الزراع لا تقبل الحروف ارقام فقط"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="طول الزراع  المنتج إلزامي"
                            />
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('temple_length'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('temple_length') }}
                                </p>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="userName"> قطر العدسه*</label>
                            <input type="number" name="additional_data[lens_width]" value="{{ old('additional_data.lens_width') }}" class="form-control"

                                   {{--min="1"--}}
                                   placeholder=" قطر العدسه.."
                                   {{--data-parsley-max="99"--}}
                                   data-parsley-min="0"
                                   data-parsley-min-message=" اقل رقم مسموح به 0"
                                   data-parsley-type="digits"
                                   data-parsley-type-message="قطر العدسه لا تقبل الحروف ارقام فقط"
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message="قطر العدسه  المنتج إلزامي"
                            />
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('lens_width'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('lens_width') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="delivery_price">سعر التوصيل</label>
                            <input type="number" name="additional_data[delivery_price]" value="{{ old('additional_data.delivery_price') }}" class="form-control"
                                   {{--min="1"--}} placeholder="سعر التوصيل"
                                   {{--data-parsley-max="99"--}}
                                   data-parsley-min="0" data-parsley-min-message=" اقل رقم مسموح به 0"
                                   data-parsley-type="digits" data-parsley-type-message="سعر التوصيل لا تقبل الحروف ارقام فقط"
                                   data-parsley-trigger="keyup" data-parsley-required-message="سعر التوصيل  المنتج إلزامي"
                            />
                            <p class="help-block" id="error_delivery_price"></p>
                            @if($errors->has('delivery_price'))
                                <p class="help-block validationStyle">{{ $errors->first('delivery_price') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="delivery_days">ايام التوصيل</label>
                            <input type="number" name="additional_data[delivery_days]" value="{{ old('additional_data.delivery_days') }}"
                                   class="form-control"
                                   {{--min="1"--}} placeholder="ايام التوصيل"
                                   {{--data-parsley-max="99"--}}
                                   data-parsley-min="0" data-parsley-min-message=" اقل رقم مسموح به 0"
                                   data-parsley-type="digits" data-parsley-type-message="ايام التوصيل لا تقبل الحروف ارقام فقط"
                                   data-parsley-trigger="keyup" data-parsley-required-message="ايام التوصيل    المنتج إلزامي"
                            />
                            <p class="help-block" id="error_delivery_days"></p>
                            @if($errors->has('delivery_days'))
                                <p class="help-block validationStyle">{{ $errors->first('delivery_days') }}</p>
                            @endif
                        </div>
                    </div>

{{--                    <div class="col-sm-3">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="userName">  مقصوره العدسات*</label>--}}
{{--                            <input type="number" name="additional_data[nose_bridge]" value="{{ old('additional_data.nose_bridge') }}" class="form-control"--}}

{{--                                   --}}{{--min="1"--}}
{{--                                   placeholder=" مقصوره العدسات .."--}}
{{--                                   --}}{{--data-parsley-max="99"--}}
{{--                                   data-parsley-min="0"--}}
{{--                                   data-parsley-min-message=" اقل رقم مسموح به 0"--}}
{{--                                   data-parsley-type="digits"--}}
{{--                                   data-parsley-type-message=" مقصوره العدسات لا تقبل الحروف ارقام فقط"--}}
{{--                                   data-parsley-trigger="keyup"--}}
{{--                                   data-parsley-required-message="مقصوره العدسات للمنتج إلزامي"--}}
{{--                            />--}}
{{--                            <p class="help-block" id="error_userName"></p>--}}
{{--                            @if($errors->has('nose_bridge'))--}}
{{--                                <p class="help-block validationStyle">--}}
{{--                                    {{ $errors->first('nose_bridge') }}--}}
{{--                                </p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-xs-3">
                        <div class="form-group">
                            <label for="price">(price)  سعر المنتج  *</label>
                            <input type="number" name="price"  min=0 oninput="validity.valid||(value='');"
                                   value="{{ old('price') }}"
                                   class="form-control requiredFieldWithMaxLenght" required>
                            <p class="help-block" id="error_price"></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="quantity">(quantity) الكمية المتوفرة من المنتج  *</label>
                            <input type="number" name="quantity" min=0 oninput="validity.valid||(value='');"
                                   value="{{ old('quantity') }}"
                                   class="form-control requiredFieldWithMaxLenght" required>
                            <p class="help-block" id="error_quantity"></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName"> وصف باللغة العربية</label>
                            <textarea type="text" name="description_ar" class="form-control m-input requiredFieldWithMaxLenght" required
                                      placeholder="إدخل  وصف عن  المنتج العربية   "   >{{ old('description_ar') }}</textarea>
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('description_ar'))
                                <p class="help-block">
                                    {{ $errors->first('description_ar') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">   وصف باللغة الإنجليزية</label>
                            <textarea type="text" name="description_en" class="form-control m-input requiredFieldWithMaxLenght" required
                                      placeholder="إدخل  وصف عن  المنتج بالإنجليزي   "   >{{ old('description_en') }}</textarea>
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('description_en'))
                                <p class="help-block">
                                    {{ $errors->first('description_en') }}
                                </p>
                            @endif
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

            <div class="row">

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

                <div class="col-md-8">
                    <div class="card-box" style="overflow: hidden;">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="usernames">  صور  المنتج  </label>
                                    <input type="file" name="images[]" class="dropify" data-max-file-size="6M"/>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        $(document).on('change', '.category', function () {

            var City_id = $(this).val(),
                div = $(this).parent().parent().parent(),
                op = " ",
                showElement = div.find('.showElement');

            $.ajax({
                type: "Get",
                beforeSend: function () {
                    $('.sub_category').text(" ");
                },
                url: '{{route('sub_categories')}}',
                data: {'id': City_id},
                success: function (data) {
                    var myData = data.data;

                    op += '<option  disabled selected>  إختر   الفرعي</option>';
                    for (var i = 0; i < myData.length; i++) {
                        op += '<option value="' + myData[i].id + '">' + myData[i].name + '</option>';
                    }
                    div.find('.sub_category').html(" ");
                    div.find('.sub_category').append(op);
                    showElement.delay(500).slideDown();

                }
            })
        });
    </script>
@endsection
