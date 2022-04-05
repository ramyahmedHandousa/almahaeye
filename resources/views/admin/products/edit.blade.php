@extends('admin.layouts.master')
@section('title' ,'تعديل منتج')

@section('styles')

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.0.1">
    </script>
    <!-- Load the MobileNet model. -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet@1.0.0"></script>

@endsection
@section('content')
    <form id="storeCampaign" method="POST" action="{{ route('products.update', $product->id) }}@if(request('type'))?type={{request('type')}}@endif"
          enctype="multipart/form-data"
          data-parsley-validate
          novalidate class="submission-form">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

        <input type="hidden" name="type" value="{{request('type')}}">
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

                    <div class="col-xs-12">
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



                    <div class="col-lg-4">
                        <div class="card-box" style="overflow: hidden;">
                            <h4 class="header-title m-t-0 m-b-30">  الصورة   الأساسية</h4>
                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <div class="col-sm-12">
                                    <input data-parsley-fileextension='jpg,png' id="image" type="file"
                                           data-default-file="{{$product->getFirstMediaUrl('master_image')}}"
                                           accept='.jpeg,.png,.jpg' name="image" class="dropify" data-max-file-size="6M"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card-box" style="overflow: hidden;">
                            <h4 class="header-title m-t-0 m-b-30">  صورة GTLF     </h4>
                            <div class="form-group {{ $errors->has('gtlf') ? ' has-error' : '' }}">
                                <div class="col-sm-12">
                                    @if($product->getMedia('gtlf')->first())
                                        <i class="fa fa-remove removeImage btn-danger"
                                           data-id="{{$product->getMedia('gtlf')->first()?->id}}" data-for="{{$product->id}}"
                                           data-url="{{route('products.delete_image')}}">
                                        </i>
                                    @endif
                                    <input   id="gtlf" type="file"
                                             data-default-file="{{$product->getFirstMediaUrl('gtlf')}}"
                                             name="gtlf" class="dropify" data-max-file-size="6M"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card-box" style="overflow: hidden;">
                            <h4 class="header-title m-t-0 m-b-30">  صورة btn    </h4>
                            <div class="form-group {{ $errors->has('btn') ? ' has-error' : '' }}">
                                <div class="col-sm-12">
                                    @if($product->getMedia('btn')->first())
                                        <i class="fa fa-remove removeImage btn-danger"
                                           data-id="{{$product->getMedia('btn')->first()?->id}}" data-for="{{$product->id}}"
                                           data-url="{{route('products.delete_image')}}">
                                        </i>
                                    @endif
                                    <input   id="btn" type="file"
                                             data-default-file="{{$product->getFirstMediaUrl('btn')}}"
                                             name="btn" class="dropify" data-max-file-size="6M"/>
                                </div>
                            </div>
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


                <div class="col-md-12">
                    <div class="card-box" style="overflow: hidden;">

                        @if($product->media->count() > 0)

                            @foreach($product->media->where('collection_name','default') as $image)
                                <div class="col-sm-3">
                                    <i class="fa fa-remove removeImage btn-danger"
                                       data-id="{{$image->id}}" data-for="{{$product->id}}" data-url="{{route('products.delete_image')}}">
                                    </i>
                                    <input data-parsley-fileextension='jpg,png' id="image" type="file"
                                           data-default-file="{{$image->getUrl()}}"
                                           accept='.jpeg,.png,.jpg' name="images[{{$image->id}}]" class="dropify " data-max-file-size="6M"/>
                                </div>
                            @endforeach
                        @endif

                        @for ($i = 0; $i < (4 - $product->media->where('collection_name','default')->count()); $i++)
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="usernames">  صور  المنتج  </label>
                                    <input type="file" name="images[]" class="dropify" accept='.jpeg,.png,.jpg' data-max-file-size="6M"/>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div><!-- end col -->

        </div>


        <!-- end row -->
    </form>
@endsection


@section('scripts')

    <script type="text/javascript" src="{{ asset('assets/admin/js/validate-'.config('app.locale').'.js') }}"></script>

    <script>

        $('body').on('click', '.removeImage', function () {
            var id = $(this).attr('data-id');
            var productId = $(this).attr('data-for');
            var url = $(this).attr('data-url');
            swal({
                title: "هل انت متأكد من مسح الصورة ؟",
                text: "سوف يتم مسحها بعد الموافقة!",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "موافق",
                cancelButtonText: "إلغاء",
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                closeOnConfirm: true,
                closeOnCancel: true,
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {id: id,product_id: productId},
                        dataType: 'json',
                        success: function (data) {

                            if (data.status == true) {
                                toastr.options = {
                                    positionClass: 'toast-top-left',
                                    onclick: null
                                };
                                $toastlast = toastr['success']('لقد تمت عملية الحذف بنجاح.', data.title);

                                window.location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>




@endsection


