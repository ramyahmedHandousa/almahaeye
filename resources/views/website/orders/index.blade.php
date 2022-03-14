@extends('website.layouts.master')

@section('content')


    <section class="">
        <div class="container">
            <div class="sec-title">
                <h2 class="title">الطلبات</h2>
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

            <!-- tabs -->
            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-tab-1" data-bs-toggle="pill" data-bs-target="#pills-1"
                            type="button">طلبات جديدة</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-tab-2" data-bs-toggle="pill" data-bs-target="#pills-2" type="button"
                            role="tab">طلبات تم الموافقة عليها</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-tab-3" data-bs-toggle="pill" data-bs-target="#pills-3" type="button"
                            role="tab">طلبات منتهية</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-tab-4" data-bs-toggle="pill" data-bs-target="#pills-4" type="button"
                            role="tab">طلبات ملغية</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- tab 1 -->
                <div class="tab-pane fade show active" id="pills-1" role="tabpanel">
                    @if(count($pendingOrders) > 0 )
                        @include('website.orders.sections.new-orders')
                    @else
                        <h1>لا يوجد جديدة</h1>
                    @endif
                </div>
                <!-- tab 2 -->
                <div class="tab-pane fade" id="pills-2" role="tabpanel">
                    @if(count($acceptedOrders) > 0)
                        @include('website.orders.sections.accepted-orders')
                    @else
                        <h1>لا يوجد طلبات تم الموافقة عليها</h1>
                    @endif
                </div>
                <!-- tab 3 -->
                <div class="tab-pane fade" id="pills-3" role="tabpanel">
                    @if(count($finishOrders) > 0)
                        @include('website.orders.sections.finish-orders')
                    @else
                        <h1>لا يوجد طلبات   منتهية حتي الان</h1>
                    @endif
                </div>
                <!-- tab 4 -->
                <div class="tab-pane fade" id="pills-4" role="tabpanel">

                    @if(count($refuseOrders) > 0)
                        @include('website.orders.sections.refuse-orders')
                    @else
                        <h1>لا يوجد طلبات تم رفضها </h1>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
