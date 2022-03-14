@extends('admin.layouts.master')
@section('title', __('maincp.user_data'))
@section('content')


    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data"
          data-parsley-validate novalidate>
    {{ csrf_field() }}
    {{ method_field('PUT') }}



    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    {{--<button type="button" class="btn btn-custom  waves-effect waves-light"--}}
                        {{--onclick="window.history.back();return false;"> @lang('maincp.back') <span class="m-l-5"><i--}}
                                {{--class="fa fa-reply"></i></span>--}}
                    {{--</button>--}}

                    <a href="{{ route('users.index') }}"
                       class="btn btn-custom  waves-effect waves-light">
												<span><span>رجوع  </span>
													<i class="fa fa-reply"></i>
												</span>
                    </a>

                </div>
                <h4 class="page-title">@lang('maincp.user_data') </h4>
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
{{--                                            @if($user->products)--}}
{{--                                                <li ><a href="#tab2" data-toggle="tab" aria-expanded="false"> المنتجات  </a></li>--}}
{{--                                            @endif--}}
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
                                                            <label>@lang('maincp.full_name') :</label>
                                                            <input class="form-control" value="{{ $user->name }}"><br>
                                                        </div>

                                                        @if(  $user->phone )
                                                            <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                                <label>@lang('maincp.mobile_number') :</label>
                                                                <input class="form-control" value="{{ $user->phone }}"><br>
                                                            </div>
                                                        @endif

                                                        @if( $user->email )
                                                            <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                                <label>@lang('maincp.e_mail')  :</label>
                                                                <input class="form-control" value="{{ $user->email }}"><br>
                                                            </div>
                                                        @endif

                                                        <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                            <label>العنوان  :</label>
                                                            <input class="form-control" value="{{  $user->address }}"><br>
                                                        </div>

                                                        @if( $user->cities->count() > 0 )
                                                            <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12">
                                                                <label>المدن    :</label>
                                                                @foreach($user->cities as $city)
                                                                <input class="form-control" value="{{ $city->name_ar }}"><br>
                                                                @endforeach
                                                            </div>
                                                        @endif



                                                    </div>



                                                    <div class="col-sm-4">
                                                        <div class="card-box">
                                                            <div class="row">

                                                                <div class="card-box" style="overflow: hidden;">
                                                                    <h4 class="header-title m-t-0 m-b-30">@lang('institutioncp.personal_image')</h4>
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <a data-fancybox="gallery"
                                                                               href="{{ $helper->getDefaultImage( $image_profile, request()->root().'/default.png') }}">
                                                                                <img class="img" style="width: 200px;height: 200px;object-fit: cover;border-radius: 10px;"
                                                                                     src="{{ $helper->getDefaultImage( $image_profile, request()->root().'/default.png') }}"/>
                                                                            </a>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            @if(count($user->products ) > 0)

                                                <div class="tab-pane m-t-10 fade  in" id="tab2">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="col-xs-12 col-lg-12">
                                                                <h4>المنتجات  </h4>
                                                                <hr>
                                                            </div>
                                                            @foreach($user->products as $product)
                                                                <div class="card"  >
                                                                    <img style="width: 25%; height: 25%" src="{{$product->getFirstMediaUrl()}}" class="card-img-top" alt="...">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">{{$product->name_ar}}</h5>
                                                                        <p class="card-text">{{$product->desc_ar}}</p>
                                                                    </div>
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item">   القسم :  {{ optional($product->category)->name_ar}}</li>
                                                                        <li class="list-group-item">   الماركة :  {{ optional($product->brand)->name_ar}}</li>
                                                                        <li class="list-group-item">   الكمية :  {{$product->pivot->quantity}}</li>
                                                                        <li class="list-group-item"> السعر :  {{$product->pivot->price}}</li>
                                                                    </ul>
                                                                </div>
                                                            @endforeach


                                                        </div>

                                                    </div>

                                                </div>

                                            @else
                                                <div class="tab-pane m-t-10 fade  in" id="tab2">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-lg-12">
                                                            <h4>لا يوجد منتجات حاليا </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>


    </form>

@endsection

