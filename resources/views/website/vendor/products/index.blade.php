@extends('website.layouts.master')
@section('styles')

    <link href="/assets/admin/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')

    <div class="container" >
        <div class="sec-title" style="margin-top: 20px;">
            <h2 class="title">منتجاتى </h2>
            <a class="btn" href="{{ route('vendor-products.create')}}">أضف جديد</a>
        </div>
        <!-- products -->
        <div class="row products" style="margin-bottom: 10%;margin-top: 5%">
            @if ($products->count() > 0)
                @foreach($products as $key => $product)
                    <div class="col-lg-2" id="product-{{$product->id}}">
                        <div class="product">

                            <div class="product-img">
                                <img class="image-fit" loading="lazy" src="{{ $product->getFirstMediaUrl('master_image')  }}">
                            </div>
                            <div class="product-content">
                                <h4 class="product-title">
                                    <a title="{{ $product['name'] }}"
                                       href="{{ route('vendor-products.show', $product['id']) }}">
                                        {{ $product['name'] }}
                                    </a>
                                </h4>
                                <div class="product-price" style="margin: 10px"><span>{{ $product['price'] }}</span> $  </div>
                                <div class="btn-rows">
                                    <a href="{{ route('vendor-products.edit', $product->id)}}">تعديل</a>

                                    <a href="javascript:;" data-url="{{ route('vendor-products.delete') }}"
                                       id="elementRow{{ $product->id }}" data-id="{{ $product->id }}"
                                       class="removeElement ">
                                        حذف
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
{{--                {{$products->links("pagination::bootstrap-4")}}--}}
            @else
                <div class="col-lg-12">
                    <p style="color: blue; text-align:center; font-weight:bold;">لا توجد منتجات</p>
                </div>
            @endif

        </div>
    </div>
@endsection


@section('scripts')
    <script src="/assets/admin/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
    <script src="/assets/admin/pages/jquery.sweet-alert.init.js"></script>

    <script>

        $('body').on('click', '.removeElement', function () {
            var id = $(this).attr('data-id');
            var url = $(this).attr('data-url');
            swal({
                title: "هل انت متأكد؟",
                text: "يمكنك استرجاع المحذوفات مرة اخرى لا تقلق.",
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
                        data: {id: id},
                        dataType: 'json',
                        success: function (data) {

                            if (data.status === true) {
                                var shortCutFunction = 'success';
                                var msg = 'لقد تمت عملية الحذف بنجاح.';
                                var title = data.title;
                                toastr.options = {
                                    positionClass: 'toast-top-left',
                                    onclick: null
                                };
                                $toastlast = toastr[shortCutFunction](msg, title);

                                $("#product-"+data.id).hide()
                            }
                        }
                    });
                }
            });
        });
    </script>

@endsection
