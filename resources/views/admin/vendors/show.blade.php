@extends('admin.layouts.master')
@section('title', __('maincp.user_data'))
@section('content')





    <!-- Page-Title -->
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
                <h4 class="page-title">بيانات التجار </h4>
            </div>
        </div>


        <div class="row">


            <div class="col-sm-12">

                <div class="card-box">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card-box p-b-0">


                                <h4 class="header-title m-t-0 m-b-30">التفاصيل</h4>

                                <form>
                                    <div id="basicwizard" class=" pull-in">
                                        <ul class="nav nav-tabs navtab-wizard nav-justified bg-muted">
                                            <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false">البيانات الاساسية</a></li>
                                            <li ><a href="#tab2" data-toggle="tab" aria-expanded="false"> الفرعية  </a></li>
                                            <li ><a href="#tab3" data-toggle="tab" aria-expanded="false"> الحسابات البنكية  </a></li>
                                        </ul>
                                        <div class="tab-content b-0 m-b-0">
                                            <div class="tab-pane m-t-10 fade active in" id="tab1">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="col-xs-12 col-lg-12">
                                                            <h4>@lang('maincp.personal_data')</h4>
                                                            <hr>
                                                        </div>

                                                        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                            <label>الإسم التجاري :</label>
                                                            <input class="form-control" readonly value="{{ $user->trade_name ? : "-------" }}"><br>
                                                        </div>
                                                        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                            <label>الإسم الأول :</label>
                                                            <input class="form-control" readonly value="{{ $user->first_name ? : "-------" }}"><br>
                                                        </div>
                                                        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                            <label>الإسم الأخير:</label>
                                                            <input class="form-control" readonly value="{{ $user->last_name ? : "-------" }}"><br>
                                                        </div>

                                                        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                            <label>رقم الهاتف  :</label>
                                                            <input class="form-control" readonly value="{{ $user->phone ? : "-----" }}"><br>
                                                        </div>

                                                        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                            <label>الإيميل الشخصي  :</label>
                                                            <input class="form-control" readonly value="{{ $user->email ? : "--------" }}"><br>
                                                        </div>

                                                        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                            <label>عنوان الحي    :</label>
                                                            <input class="form-control" readonly value="{{ $user->city_address ? : "--------" }}"><br>
                                                        </div>


                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="card-box">
                                                            <div class="row">

                                                                <div class="card-box" style="overflow: hidden;">
                                                                    <h4 class="header-title m-t-0 m-b-30">@lang('institutioncp.personal_image')</h4>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <a data-fancybox="gallery"
                                                                               href="{{ $user->getFirstMediaUrl('master_image')?:asset('/default.png')  }}">
                                                                                <img class="img" style="width: 200px;height: 200px;object-fit: cover;border-radius: 10px;"
                                                                                     src="{{ $user->getFirstMediaUrl('master_image')?:asset('/default.png') }}"/>
                                                                            </a>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                                <div class="tab-pane m-t-10 fade  in" id="tab2">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="col-xs-12 col-lg-12">
                                                                <h4>البيانات الفرعية</h4>
                                                                <hr>
                                                            </div>
                                                            <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                                <label> عدد المنتجات لديه   :</label>
                                                                <input class="form-control" readonly value="{{$user->products_count }}"><br>
                                                            </div>
                                                            <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                                <label> عدد  العناوين لديه :</label>
                                                                <input class="form-control" readonly value="{{ $user->address_count }}"><br>
                                                            </div>
                                                            <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                                <label>رقم السجل التجاري :</label>
                                                                <input class="form-control" readonly value="{{ $user->commercial_registration ? : "لا يوجد" }}"><br>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="col-xs-12 col-lg-12">
                                                                <h4>صور السجل والإتفاقيات</h4>
                                                                <hr>
                                                            </div>
                                                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-12">
                                                                <label> صورة السجل التجاري      :</label>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <a target="_blank" href="{{ $user->getFirstMediaUrl('image_commercial')?:asset('/pdfFile.png')  }}">
                                                                            <img class="img" style="width: 50px;height: 50px;object-fit: cover;border-radius: 10px;"
                                                                                 src="{{  asset('/pdfFile.png') }}"/>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-12">
                                                                <label>اتفاقية التسويق : </label>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
{{--                                                                        <a target="_blank" href="{{ $user->getFirstMediaUrl('image_marketing_agreement')?:asset('/pdfFile.png')  }}">--}}
                                                                        <a target="_blank" href="{{ route('marketing_information',$user->id)  }}">
                                                                            <img class="img" style="width: 50px;height: 50px;object-fit: cover;border-radius: 10px;"
                                                                                 src="{{  asset('/pdfFile.png') }}"/>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-xs-4 col-md-4 col-sm-12">
                                                                <label> صورة مقدم الخدمة      :</label>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <a target="_blank" href="{{ $user->getFirstMediaUrl('image_service_provider')?:asset('/pdfFile.png')  }}">
                                                                            <img class="img" style="width: 50px;height: 50px;object-fit: cover;border-radius: 10px;"
                                                                                 src="{{  asset('/pdfFile.png') }}"/>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            <div class="tab-pane m-t-10 fade  in" id="tab3">
                                                <div class="row">
                                                    <h3>البيانات البنكية</h3>

                                                    <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                        <label>إسم البنك   :</label>
                                                        <input class="form-control" readonly value="{{ $user->bank?->name }}"><br>
                                                    </div>

                                                    <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                        <label>رقم الإيبان  :</label>
                                                        <input class="form-control" readonly value="{{ $user->iban ? : "لا يوجد" }}"><br>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>



@endsection

