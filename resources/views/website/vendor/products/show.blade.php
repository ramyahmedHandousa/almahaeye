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
            <h2 class="title"> بيانات المنتج</h2>
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

            <!-- add-product -->
                <div class="row add-product-content">
                    @foreach (config('translatable.locales') as $locale => $value)
                        <div class="col-lg-6 form-group">
                            <input readonly type="text" name="name:{{ $value }}"  class="form-control"
                                   placeholder="اسم المنتج باللغة - {{ $value }} "
                                   value="{{$value == 'ar' ? $product->name : $product->translate('en')?->name}}"
                            >
                            @error('name:'.$value) <span class="error">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                    <div class="col-lg-3 form-group">
                        <select disabled class="form-select" id="mainCategory" name="main_category_id">
                            <option value="">{{$product?->category?->parent?->name}}</option>
                        </select>
                    </div>
                    <div class="col-lg-3 form-group">
                        <select disabled name="category_id" id="subCategory" class="form-select">
                            <option value="">{{$product?->category?->name}}</option>
                        </select>
                    </div>

                    <div class="col-lg-3 form-group">
                        <select disabled name="product_type_id" id="product_type_id" class="form-control">
                            <option value="">{{$product->product_type?->name}}</option>
                        </select>
                    </div>

                    <div class="col-lg-3 form-group">
                        <select disabled class="form-select" name="brand_id">
                            <option value="">{{$product?->brand?->name}}</option>
                        </select>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="frame_color_id">لون الإطار</label>
                        <select disabled class="frame-color form-select form-control select2" style="width:100% !important; direction: rtl !important;" multiple="multiple" name="frame_color_id[]">

                            @foreach ($framesColors as $frame)
                                <option value="{{ $frame->id}}" {{ in_array($frame->id, $product?->frame_colors?->pluck('id')?->toArray()) ? 'selected' : ''}}>
                                    {{$frame->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="frame_color_id">لون العدسة</label>
                        <select disabled class="frame-color form-select form-control select2" style="width:100% !important; direction: rtl !important;" multiple="multiple" name="lens_color_id[]">
                            @foreach ($lensColors as $value)
                                <option value="{{ $value->id}}" {{ in_array($value->id, $product?->lens_colors?->pluck('id')?->toArray()) ? 'selected' : ''}}>
                                    {{$value->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 form-group">
                        <select disabled class="form-select" name="frame_material_id">
                            <option value="">{{$product->frame_material->name}}</option>
                        </select>
                    </div>
                    <div class="col-lg-2 form-group">
                        <select disabled class="form-select" name="frame_shap_id">
                            <option value="">{{ $product->frame_shap->name}}</option>
                        </select>
                    </div>

                    <div class="col-lg-2 form-group">
                        <select disabled class="form-select" name="age_id">
                            <option value="">{{$product?->age?->name}}</option>
                        </select>

                    </div>

                    <div class="col-lg-3 form-group">
                        <input readonly type="number" class="form-control" name="price" placeholder="السعر"
                               value="{{$product->price}}" step="0.01" min="0" max="1000">
                    </div>

                    <div class="col-lg-3 form-group">
                        <input readonly type="number" name="quantity" class="form-control" placeholder="الكميه"
                               value="{{$product->quantity}}" min="0" max="1000">
                    </div>


                    <div class="col-lg-3 form-group">
                        <input readonly type="number" class="form-control" name="additional_data[frame_height]" placeholder="طول الاطار"
                               value="{{$product->additional_data['frame_height']  ?? ' '}}" min="0" max="100">
                    </div>

                    <div class="col-lg-3 form-group">
                        <input readonly type="number" class="form-control" name="additional_data[temple_length]" placeholder="طول الزراع"
                               value="{{$product->additional_data['temple_length']  ?? ' '}}" min="0" max="100">
                    </div>
                    <div class="col-lg-3 form-group">
                        <input readonly type="number" class="form-control" name="additional_data[lens_width]" placeholder="قطر العدسه"
                               value="{{$product->additional_data['lens_width']   ?? ' '}}" min="0" max="1000">
                    </div>
                    <div class="col-lg-3 form-group">
                        <input readonly type="number" class="form-control" name="additional_data[nose_bridge]" placeholder="مقصوره العدسه"
                               value="{{$product->additional_data['nose_bridge'] ?? ' ' }}" min="0" max="100">
                    </div>

                    @foreach (config('translatable.locales') as $locale => $value)
                        <div class="col-lg-6 form-group">
                            <textarea readonly name="description:{{ $value }}"   class="form-control" placeholder="وصف المنتج باللغة - {{ $value }} "
                                      id="" cols="30" rows="10">{{ $value == 'ar' ? $product->description : $product->translate('en')?->description }}</textarea>
                        </div>
                    @endforeach


                    <div class="col-12 form-group">
                        <div class="row">
                            <label class="col-lg-2"> صورة المنتج</label>
                            <div class="col">
                                <div style="position: relative; margin: 1.5px;  float: left; ">
                                    <img style="border-radius: 20px; margin-bottom: 10px;max-height: 100px;max-width: 150px"
                                         class="prev image-fit" loading="lazy" src="{{ $product->getFirstMediaUrl('master_image') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($product?->media?->where('collection_name','!=','master_image')?->count() > 0)
                        <div class="col-12 form-group">
                            <div class="row">
                                <label class="col-lg-2">صور اخرى للمنتج</label>
                                <div class="col">
                                    @foreach($product->media->where('collection_name','!=','master_image') as $media)
                                        <div style="position: relative; margin: 1.5px;  float: left; ">
                                            <img style="border-radius: 20px; margin-bottom: 10px;max-width: 30%;max-height: 30%"
                                                 class="prev image-fit" loading="lazy" src="{{ $media->getUrl() }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="col-lg-3" style="margin-top: 20px; margin-bottom: 20px;margin-right:auto ">
                    <a class="btn" href="{{route('vendor-products.index')}}">رجوع</a>
                </div>

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
