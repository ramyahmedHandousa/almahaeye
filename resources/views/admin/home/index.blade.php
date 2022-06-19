@extends('admin.layouts.master')
@section('title', 'الصفحة الرئيسية')


@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title"> الإحصائيات الرئيسية </h4>
        </div>
    </div>
        <div class="row statistics">

        <div class="col-lg-3 col-md-6">
            <a href="{{ route('users.index') }}">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">  المستخدمين</h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$usersCount}}</h2>
                            <p class="text-muted m-b-0">  المستخدمين في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{ route('vendors.index') }}">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> التجار </h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$vendorCount}}</h2>
                            <p class="text-muted m-b-0">  التجار في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-md-6">
            <a href="{{ route('countries.index') }}">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> الدول </h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$countriesCount}}</h2>
                            <p class="text-muted m-b-0"> الدول  في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{ route('categories.index') }}">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> الأقسام </h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$categoriesCount}}</h2>
                            <p class="text-muted m-b-0"> الأقسام  في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{ route('products.index') }}">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> المنتجات الحالية </h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$productsCount}}</h2>
                            <p class="text-muted m-b-0"> المنتجات الحالية في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{ route('shipping.index') }}">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">  شركات الشحن</h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$shippingCount}}</h2>
                            <p class="text-muted m-b-0">  شركات الشحن   في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="{{ route('products.index') }}?type=new">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> المنتجات الجديدة</h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$newProductsCount}}</h2>
                            <p class="text-muted m-b-0"> المنتجات الجديدة في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- end col -->
    </div>




@endsection
