@extends('website.layouts.master')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('website/templates/css/image-uploader.min.css') }}">

    <style>

        .hidden-category{
            visibility: hidden !important;
        }


    </style>
@endsection


@section('content')

    <div class="container">
        <div class="sec-title" style="margin-top: 20px;">
            <h2 class="title">أضف منتج جديد</h2>
        </div>
        <!-- form -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <form class="col-12" method="POST" action="{{ route('vendor-products.store') }}"
                  enctype="multipart/form-data">
                @csrf
                <!-- add-product -->
                <div class="row add-product-content">
                    <?php $i = 1; ?>
                    @foreach (config('translatable.locales') as $locale => $value)
                        <div class="col-lg-6 form-group">
                            <input required type="text" name="name:{{ $value }}" class="form-control"
                                   placeholder="اسم المنتج باللغة - {{ $value }} "
                                   value="{{ old('name:'.$locale) }}"
                            >
                            @error('name:'.$value) <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <?php $i++; ?>
                    @endforeach
                    <div class="col-lg-3 form-group">
                        <select class="form-select" id="mainCategory" name="category_id">
                            <option value="">القسم الرئيسى</option>
                            @foreach($categories  as $category)
                                <option {{ old('category_id') == $category->id ? 'selected="selected"' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('main_category_id') <span class="error">{{ $message }}</span> @enderror
                    </div>
{{--                    <div class="col-lg-3 form-group">--}}
{{--                        <select name="category_id" id="subCategory" class="form-select">--}}
{{--                            <option value="">اختر القسم الفرعى</option>--}}
{{--                        </select>--}}
{{--                        @error('category_id') <span class="error">{{ $message }}</span> @enderror--}}
{{--                    </div>--}}

                    <div class="col-lg-3 form-group">
                        <select name="product_type_id" id="product_type_id" class="form-control">
                            <option value="">نوع النظارة</option>
                            @foreach ($product_types as $type)
                                <option value="{{ $type->id}}" {{ old('product_type_id') == $type->id ? 'selected' : ''}}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 form-group">
                        <select class="form-select" name="brand_id">
                            <option value=""> ماركة النظارة</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id}}" {{  old('brand_id') == $brand->id ? 'selected' : null}}>{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="col-lg-3 form-group">
                        <select class="form-select" name="frame_material_id">
                            <option value="">خامة الإطار</option>
                            @foreach($frame_materials as $frame)
                                <option value="{{ $frame->id }}" {{ old('frame_id') == $frame->id ? 'selected' : '' }}>{{ $frame->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 form-group">
                        <select class="form-select" name="frame_shap_id">
                            <option value="">شكل الإطار</option>
                            @foreach($frame_shaps as $shape)
                                <option value="{{ $shape->id }}" {{ old('shape_id') == $shape->id ? 'selected' : '' }}>{{ $shape->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 form-group">
                        <select class="form-select" name="age_id">
                            <option value="">السن</option>
                            @foreach($ages as $age)
                                <option value="{{ $age->id }}" {{ old('age_id') == $age->id ? 'selected' : '' }}>{{ $age->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-lg-3 form-group">
                        <input required type="number" class="form-control" name="price" placeholder="السعر"
                               value="{{old('price')}}" step="0.01" min="0" max="1000">
                    </div>

                    <div class="col-lg-3 form-group">
                        <input required type="number" name="quantity" class="form-control" placeholder="الكميه"
                               value="{{old('quantity')}}" min="0" max="1000">
                    </div>

                        <div class="col-lg-6 form-group">
                            <label for="frame_color_id">لون الإطار</label>
                            <select class="frame-color form-select form-control select2" style="width:100% !important; direction: rtl !important;" multiple="multiple" name="frame_color_id[]">

                                @foreach ($framesColors as $frame)
                                    <option value="{{ $frame->id}}" {{ is_array(old('frame_color_id')) && in_array($frame->id, old('frame_color_id')) ? 'selected' : ''}}>
                                        {{$frame->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="frame_color_id">لون العدسة</label>
                            <select class="frame-color form-select form-control select2" style="width:100% !important; direction: rtl !important;" multiple="multiple" name="lens_color_id[]">
                                @foreach ($lensColors as $value)
                                    <option value="{{ $value->id}}" {{ is_array(old('lens_color_id')) && in_array($value->id, old('lens_color_id')) ? 'selected' : ''}}>
                                        {{$value->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    <div class="col-lg-2 form-group">
                        <input required type="number" class="form-control" name="additional_data[frame_height]" placeholder="طول الاطار"
                               value="{{old('additional_data.frame_height') }}" min="0" max="100">
                    </div>

                    <div class="col-lg-2 form-group">
                        <input required type="number" class="form-control" name="additional_data[temple_length]" placeholder="طول الزراع"
                              value="{{old('additional_data.temple_length') }}" min="0" max="100">
                    </div>
                    <div class="col-lg-2 form-group">
                        <input required type="number" class="form-control" name="additional_data[lens_width]" placeholder="قطر العدسه"
                               value="{{old('additional_data.lens_width') }}" min="0" max="1000">
                    </div>
{{--                    <div class="col-lg-3 form-group">--}}
{{--                        <input required type="number" class="form-control" name="additional_data[nose_bridge]" placeholder="مقصوره العدسه"--}}
{{--                               value="{{old('additional_data.nose_bridge') }}" min="0" max="100">--}}
{{--                    </div>--}}
                    <div class="col-lg-3 form-group">
                        <input required type="number" class="form-control" name="additional_data[delivery_price]" placeholder="سعر التوصيل"
                               value="{{old('additional_data.delivery_price') }}" min="0" max="100">
                    </div>
                    <div class="col-lg-3 form-group">
                        <input required type="number" class="form-control" name="additional_data[delivery_days]" placeholder="عدد أيام التوصيل"
                               value="{{old('additional_data.delivery_days') }}" min="0" max="100">
                    </div>


                    <?php $i = 1; ?>
                    @foreach (config('translatable.locales') as $locale => $value)
                        <div class="col-lg-6 form-group">


                            <textarea name="description:{{ $value }}"   class="form-control" placeholder="وصف المنتج باللغة - {{ $value }} "
                                      id="" cols="30" rows="10">{{ old('description:'.$value) }}</textarea>
                        </div>
                        <?php $i++; ?>
                    @endforeach


                    <div class="col-12 form-group">
                        <div class="row">
                            <label class="col-lg-2"> صورة المنتج</label>
                            <div class="col">
                                <div class="upload-file form-group">
                                    <label>
                                        <div class="upload-icon">
                                            <img class="prev" loading="lazy"  src="{{ asset('website/templates/images/upload-to-cloud.png') }}">
                                        </div>
                                        <input  type="file" name="image" accept="image/*" id="file-input" class="inputfile" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <div class="row">
                            <label class="col-lg-2">صور اخرى للمنتج</label>
                            <div class="col">
                                <div class="input-images"></div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row submit-row">
                    <div class="col-lg-3 order2">
                        <a class="btn btn-gray" href="{{ route('vendor-products.index') }}">الغاء</a>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" id="submitForm" class="btn">حفظ</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('website/templates/js/code-rtl.js') }}"></script>

    <script type="text/javascript" src="{{ asset('website/templates/js/image-uploader.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('website/templates/js/categories.js') }}"></script>

    <script>

        $(document).ready(function() {
            $('.select2').select2();
        });

        $('.input-images').imageUploader();

        $(document).on('change', '.inputfile',  function () {

            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload =  (e) => {
                    $(this).parent().find('.prev').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>

@endsection
