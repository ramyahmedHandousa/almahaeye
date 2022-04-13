@extends('admin.layouts.master')
@section('title', __('maincp.user_data'))
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">


                <a href="{{ route('vendors.index')}}"
                   class="btn btn-custom  waves-effect waves-light">
												<span><span>رجوع  </span>
													<i class="fa fa-reply"></i>
												</span>
                </a>

            </div>
            <h4 class="page-title">بيانات إتفاقية التسويق </h4>
        </div>
    </div>

    <div class="row">


        <div class="col-sm-12">

            <div class="card-box">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card-box p-b-0">

                            <h4 style="margin-bottom: 3%">
                                إتفاقیة تسویق إلكتروني أبرمت ھذه الاتفاقیة الیوم الاربعاء الموافق
                                {{$user->marketing_agree_info['date_now'] ?? '---'}}
                                في مدینة الدمام المملكة العربیة السعودیة فیما بین كل من:

                            </h4>
                            <h4 >
                                1.السادة شركة/ عین المھا للنظارات ب- سجل تجاري رقم 2050141744 وعنوانھا الدمام ھاتف رقم 966504966997+ ویمثلھا في التوقیع على ھذه الإتفاقیة
                            </h4>
                            <h4 style="margin-bottom: 3%">
                                السید/
                                {{$user->marketing_agree_info['master_one']['name'] ?? '---'}}
                                سعودي الجنسیة
                                بموجب بطاقة أحوال رقم
                                {{$user->marketing_agree_info['master_one']['status_card'] ?? '---'}}
                                صادرة من
                                {{$user->marketing_agree_info['master_one']['comingـfrom'] ?? '---'}}
                                تاریخ
                                {{$user->marketing_agree_info['master_one']['date'] ?? '---'}}
                                ویشار إلیھ فیما بعد.
                                بـ (الطرف الأول).
                            </h4>
                            <h4 style="margin-bottom: 2%">
                                2.السادة شركة/
                                {{$user->marketing_agree_info['master_two']['company_name'] ?? '---'}}
                                - بسجل تجاري رقم
                                {{$user->marketing_agree_info['master_two']['commercialـrecord'] ?? '---'}}
                                وعنوانھا
                                {{$user->marketing_agree_info['master_two']['address'] ?? '---'}}
                                ھاتف رقم
                                {{$user->marketing_agree_info['master_two']['number'] ?? '---'}}
                                ویمثلھا في التوقیع على ھذه الإتفاقیة
                            </h4>
                            <h4 style="margin-bottom: 2%">
                                السید/
                                {{$user->marketing_agree_info['master_two']['name'] ?? '---'}}
                                سعودي الجنسیة
                                بموجب بطاقة أحوال رقم
                                {{$user->marketing_agree_info['master_two']['status_card'] ?? '---'}}
                                صادرة من
                                {{$user->marketing_agree_info['master_two']['comingـfrom'] ?? '---'}}
                                , تاریخ
                                {{$user->marketing_agree_info['master_two']['date'] ?? '---'}}
                                 , ویشار إلیھ فیما بـ (الطرف الثاني) .
                            </h4>


                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">


                <table class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th> صورة الماركة</th>
                        <th> إسم الماركة</th>
                        <th> نوع المنتج</th>
                        <th> سعر المنتج</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($vendorBrands as $row)
                        <tr>
                            <td>
                                <a data-fancybox="gallery"
                                   href="{{ $row->getFirstMediaUrl()?:asset('/default.png')  }}">
                                    <img class="img" style="width: 50px;height: 50px;object-fit: cover;border-radius: 10px;"
                                         src="{{ $row->getFirstMediaUrl()?:asset('/default.png') }}"/>
                                </a>
                            </td>
                            <td>
                                <select name="brand_name" data-id="{{$row->id}}" data-type="brand_id" class="form-control admin_update_brand_data" id="brand_name">
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}"
                                                @if($brand->id ==$row->brand?->id) selected @endif>
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="product_type" data-id="{{$row->id}}" data-type="product_type_id" class="form-control admin_update_brand_data" id="product_type">
                                    @foreach($productTypes as $productType)
                                        <option value="{{$productType->id}}"
                                                @if($productType->id ==$row->product_type?->id) selected @endif>
                                            {{$productType->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" data-id="{{$row->id}}" data-type="price" class="form-control admin_update_brand_data"
                                       min=0 oninput="validity.valid||(value='');"
                                       value="{{ $row->price ? : "0" }}">
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection

@section('scripts')

    <script>

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }

        $(".admin_update_brand_data").bind('change keyup', delay( function (e) {

            var myId = e.target.dataset.id,
                type = e.target.dataset.type,
                myValue = e.target.value;

            console.log(e.target.dataset)
            if($.isNumeric(myValue) && myValue >= 0){

                $.ajax({
                    type: 'POST',
                    url: '{{route('admin_update_brand_data')}}',
                    data: {id: myId,type: type,value: myValue},
                    dataType: 'json',
                    success: function (data) {

                    }
                });
            }

        },500));
    </script>
@endsection
