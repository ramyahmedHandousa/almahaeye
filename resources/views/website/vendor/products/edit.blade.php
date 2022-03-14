@extends('website.layouts.master')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('website/templates/css/image-uploader.min.css') }}">

    <style>
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="sec-title" style="margin-top: 20px;">
            <h2 class="title"> تعديل المنتج</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- form -->
        <div class="row">
            <form class="col-12" method="POST" action="{{ route('vendor-products.update', $product->id) }}"
                  data-parsley-validate novalidate
                  enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <!-- add-product -->
                <div class="row add-product-content">
                    @foreach (config('translatable.locales') as $locale => $value)
                        <div class="col-lg-6 form-group">
                            <input type="text" name="name:{{ $value }}"  class="form-control"
                                   placeholder="اسم المنتج باللغة - {{ $value }} "
                                   value="{{$value == 'ar' ? $product->name : $product->translate('en')?->name}}"
                            >
                            @error('name:'.$value) <span class="error">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                    <div class="col-lg-3 form-group">
                        <select class="form-select" id="mainCategory" name="main_category_id">
                            <option value="">القسم الرئيسى</option>
                            @foreach($categories  as $category)
                                <option {{ $product?->category?->parent?->id == $category->id ? 'selected="selected"' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 form-group">
                        <select name="category_id" id="subCategory" class="form-select">
                            <option value="">{{$product?->category?->name}}</option>
                        </select>
                        @error('category_id') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-lg-3 form-group">
                        <select name="product_type_id" id="product_type_id" class="form-control">
                            <option value="">نوع النظارة</option>
                            @foreach ($product_types as $type)
                                <option value="{{ $type->id}}" {{ $product->product_type_id == $type->id ? 'selected' : ''}}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 form-group">
                        <select class="form-select" name="brand_id">
                            <option value=""> ماركة النظارة</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id}}" {{  $product->brand_id == $brand->id ? 'selected' : null}}>{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="frame_color_id">لون الإطار</label>
                        <select class="frame-color form-select form-control select2" style="width:100% !important; direction: rtl !important;" multiple="multiple" name="frame_color_id[]">

                            @foreach ($framesColors as $frame)
                                <option value="{{ $frame->id}}" {{ in_array($frame->id, $product?->frame_colors?->pluck('id')?->toArray()) ? 'selected' : ''}}>
                                    {{$frame->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="frame_color_id">لون العدسة</label>
                        <select class="frame-color form-select form-control select2" style="width:100% !important; direction: rtl !important;" multiple="multiple" name="lens_color_id[]">
                            @foreach ($lensColors as $value)
                                <option value="{{ $value->id}}" {{ in_array($value->id, $product?->lens_colors?->pluck('id')?->toArray()) ? 'selected' : ''}}>
                                    {{$value->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 form-group">
                        <select class="form-select" name="frame_material_id">
                            <option value="">خامة الإطار</option>
                            @foreach($frame_materials as $frame)
                                <option value="{{ $frame->id }}" {{ $product->frame_material_id == $frame->id ? 'selected' : '' }}>{{ $frame->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 form-group">
                        <select class="form-select" name="frame_shap_id">
                            <option value="">شكل الإطار</option>
                            @foreach($frame_shaps as $shape)
                                <option value="{{ $shape->id }}" {{ $product->frame_shap_id == $shape->id ? 'selected' : '' }}>{{ $shape->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 form-group">
                        <select class="form-select" name="age_id">
                            <option value="">السن</option>
                            @foreach($ages as $age)
                                <option value="{{ $age->id }}" {{ $product->age_id == $age->id ? 'selected' : '' }}>{{ $age->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-lg-3 form-group">
                        <input type="number" class="form-control" name="price" placeholder="السعر"
                               value="{{$product->price}}" step="0.01" min="0" max="1000">
                    </div>

                    <div class="col-lg-3 form-group">
                        <input type="number" name="quantity" class="form-control" placeholder="الكميه"
                               value="{{$product->quantity}}" min="0" max="1000">
                    </div>


                    <div class="col-lg-3 form-group">
                        <input type="number" class="form-control" name="additional_data[frame_height]" placeholder="طول الاطار"
                               value="{{$product->additional_data['frame_height']  ?? ' '}}" min="0" max="100">
                    </div>

                    <div class="col-lg-3 form-group">
                        <input type="number" class="form-control" name="additional_data[temple_length]" placeholder="طول الزراع"
                               value="{{$product->additional_data['temple_length']  ?? ' '}}" min="0" max="100">
                    </div>
                    <div class="col-lg-3 form-group">
                        <input type="number" class="form-control" name="additional_data[lens_width]" placeholder="قطر العدسه"
                               value="{{$product->additional_data['lens_width']   ?? ' '}}" min="0" max="1000">
                    </div>
                    <div class="col-lg-3 form-group">
                        <input type="number" class="form-control" name="additional_data[nose_bridge]" placeholder="مقصوره العدسه"
                               value="{{$product->additional_data['nose_bridge'] ?? ' ' }}" min="0" max="100">
                    </div>

                    @foreach (config('translatable.locales') as $locale => $value)
                        <div class="col-lg-6 form-group">
                            <textarea name="description:{{ $value }}"   class="form-control" placeholder="وصف المنتج باللغة - {{ $value }} "
                                      id="" cols="30" rows="10">{{ $value == 'ar' ? $product->description : $product->translate('en')?->description }}</textarea>
                        </div>
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
                                        <input type="file" name="image" accept="image/*" id="file-input" class="inputfile" />
                                    </label>
                                </div>

                                <div style="position: relative; margin: 1.5px;  float: left; ">
                                    <img style="border-radius: 20px; margin-bottom: 10px;max-height: 100px;max-width: 150px"
                                         class="prev image-fit" src="{{ $product->getFirstMediaUrl('master_image') }}">
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



                <div class="col-lg-3" style="margin-top: 20px; margin-bottom: 20px;margin-right:auto ">
                    <button type="submit" class="btn">تعديل</button>
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
