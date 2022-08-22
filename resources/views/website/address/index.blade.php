@extends('website.layouts.master')
@section('styles')

    <link href="/assets/admin/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')


    <!-- start breadcrumbs -->
    <div class="container">
        <div class="sec-title" style="margin-top: 10px;">
            <h2 class="title">      {{trans('website.profile.information')}}</h2>
        </div>
        <!-- profile card -->
        <div class="profile-bg">
            <div>
                <div class="profile-img" style="border: 1px solid #DCDC;border-radius:100px;">
                    <img style="width: 100%; height: 100%;" loading="lazy"
                         src="{{ auth()->user()?->getFirstMediaUrl('master_image') ?: asset('website/templates/images/avatar.png') }}">
                </div>

                <div class="profile-name">
                    <h4>{{ auth()->user()?->name}}</h4>
                    <p>{{ auth()->user()?->email }}</p>
                </div>
            </div>

            <a href="@if(auth()->user()){{route('my-profile')}} @else# @endif" class="btn">{{trans('website.profile.edit_information')}}</a>
        </div>
        <!-- tabs -->

        <div class="row">

            <div class="col-md-12 col-xs-12">
                <ul class="nav nav-tabs nav-tabs-profile">
                    <li class="{{ request()->route()->getName() == 'my-favorite-products'? "active" :"" }}">
                        <a href="{{ route('my-favorite-products.index') }}">
                            <img src="{{ asset('website/azkataam/img/t1-a.png') }}"
                                 class="img-a mr-5">
                            <img src="{{ asset('website/azkataam/img/t1-b.png') }}" class="img-b mr-5">
                            {{trans('website.profile.menu_favourite')}}
                        </a>
                    </li>
                    {{--
                    <li class="{{ request()->route()->getName() == 'orders.history'? "active" :"" }}">
                        <a href="{{ route('orders.history') }}">
                            <img src="{{ asset('assets/azkataam/img/t2-a.png') }}"
                                 class="img-a mr-5">
                            <img src="{{ asset('assets/azkataam/img/t2-b.png') }}" class="img-b mr-5">طلباتى</a>
                    </li>
                    --}}
                    <li class="{{ request()->route()->getName() == 'addresses.index'? "active" :"" }}">
                        <a href="{{ request()->route()->getName() != 'addresses.index'? route('addresses.index') : '#' }}">
                            <img loading="lazy" src="{{ asset('website/azkataam/img/t3-a.png') }}"
                                 class="img-a mr-5">
                            <img loading="lazy" src="{{ asset('website/azkataam/img/t3-b.png') }}" class="img-b mr-5">
                            {{trans('website.address.my')}}</a>

                    </li>
{{--                    <li class="{{ request()->route()->getName() == 'profile.order.tracking'? "active" :"" }}">--}}
{{--                        <a href="{{ route('profile.order.tracking') }}">--}}
{{--                            <img src="{{ asset('assets/azkataam/img/t4-a.png') }}"--}}
{{--                                 class="img-a mr-5">--}}
{{--                            <img src="{{ asset('assets/azkataam/img/t4-b.png') }}" class="img-b mr-5">--}}
{{--                            طلباتى</a>--}}
{{--                    </li>--}}
                </ul>

                <div class="tab-content">
                    <div class="sec-title">
                        <h4 class="title">{{trans('website.address.menu_my')}}  </h4>
                        <a class="btn" href="{{ route('addresses.create') }}">{{trans('website.address.new')}}  </a>
                    </div>
                    <!-- addresses -->
                    @if(auth()->user() && count(auth()->user()?->address) > 0)

                        <div class="row">
                            @foreach(auth()->user()->address as $index => $address)
                            <!-- address -->
                                <div class="col-lg-3" id="address-{{$address->id}}">
                                    <div class="address">
                                        <h5 class="title">
                                            {{trans('website.auth.address_no')}}
                                            {{$index +1}}</h5>
                                        <h5 class="text">{{$address['address']}}</h5>
                                            <div class="btn-rows">
                                                <a href="{{route('addresses.edit', $address['id']) }}"> {{trans('website.profile.edit')}}</a>
                                                <a href="javascript:;" data-url="{{ route('addresses.delete') }}"
                                                   id="elementRow{{ $address->id }}" data-id="{{ $address->id }}"
                                                   class="removeElement ">
                                                      {{trans('website.profile.delete')}}
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else

                        <div class="no-result">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-center" style="height: 60vh; padding: 100px 0;">
                                        <h3>{{trans('website.auth.not_address')}}  </h3>
                                        <span> {{trans('website.profile.search_web')}}<a href="{{ route('home-page') }}"> {{trans('website.profile.click_here')}}</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- end internal-page -->
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

                                $("#address-"+data.id).hide()
                            }
                        }
                    });
                }
            });
        });
    </script>

@endsection
