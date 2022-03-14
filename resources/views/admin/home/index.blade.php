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
            <a href="javascript:;">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">عدد المستخدمين</h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$usersCount}}</h2>
                            <p class="text-muted m-b-0">عدد  المستخدمين في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="javascript:;">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">عدد التجار </h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$vendorCount}}</h2>
                            <p class="text-muted m-b-0">عدد  التجار في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-md-6">
            <a href="javascript:;">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">عدد الدول </h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$countriesCount}}</h2>
                            <p class="text-muted m-b-0">عدد الدول  في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="javascript:;">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">عدد الأقسام </h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$categoriesCount}}</h2>
                            <p class="text-muted m-b-0">عدد الأقسام  في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="javascript:;">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">عدد المنتجات </h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$productsCount}}</h2>
                            <p class="text-muted m-b-0">عدد المنتجات  في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6">
            <a href="javascript:;">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">عدد  شركات الشحن</h4>
                    <div class="widget-box-2">
                        <div class="widget-detail-2"><span class="pull-left"> <i class="zmdi zmdi-accounts zmdi-hc-3x"></i> </span>
                            <h2 class="m-b-0">{{$shippingCount}}</h2>
                            <p class="text-muted m-b-0">عدد  شركات الشحن   في التطبيق  </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- end col -->
    </div>




@endsection
