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
                                وعنوانھا الدمام ھاتف رقم
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
                            <td>{{ $row->brand?->name }}</td>
                            <td>{{ $row->product_type?->name }}</td>
                            <td>{{ $row->price }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection
