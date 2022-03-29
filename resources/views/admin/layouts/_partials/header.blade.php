<!-- Navigation Bar-->
<header id="topnav">

    <div class="topbar-main">
        <div class="container">

            <!-- LOGO -->
            <div class="topbar-left">
                {{--<a href="{{ route('admin.home') }}" class="logo" style="width: 150px;">--}}
                    {{--<img style="width: 100%" src="{{ request()->root() }}/public/assets/admin/images/logo.png"></a>--}}
            </div>
            <!-- End Logo container-->


            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">
                    {{--<li>--}}
                    {{--<forsm role="search" class="navbar-left app-search pull-left hidden-xs">--}}
                    {{--<input type="text" placeholder="بحث ..." class="form-control">--}}
                    {{--<a href=""><i class="fa fa-search"></i></a>--}}
                    {{--</form>--}}
                    {{--</li>--}}

                    <li>
                        <!-- Notification -->
{{--                        <div class="notification-box">--}}
{{--                            <ul class="list-inline m-b-0">--}}
{{--                                <li>--}}
{{--                                    <a href="javascript:void(0);" class="right-bar-toggle">--}}
{{--                                        <i class="zmdi zmdi-notifications-none"></i>--}}
{{--                                    </a>--}}
{{--                                    <div class="noti-dot">--}}
{{--                                        <span class="dot"></span>--}}
{{--                                        <span class="pulse"></span>--}}
{{--                                    </div>--}}
{{--                                </li>--}}

{{--                            </ul>--}}
{{--                        </div>--}}
                        <!-- End Notification bar -->
                    </li>


                    {{--<li class="dropdown">--}}
                        {{--<a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown"--}}
                           {{--aria-expanded="true">--}}
                            {{--<img src="{{ request()->root() }}/public/assets/admin/images/saudi-arabia.png"--}}
                                 {{--alt="user-img"--}}
                                 {{--class="img-circle user-img">--}}
                        {{--</a>--}}

                        {{--<ul class="dropdown-menu">--}}

                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--{{ app()->getLocale() }} <i class="fa fa-caret-down"></i>--}}
                            {{--</a>--}}

                            {{--@foreach (config('translatable.locales') as $lang => $language)--}}
                                {{--@if ($lang != app()->getLocale())--}}
                                    {{--<li>--}}
                                        {{--<a href="{{ route('lang.switch', $lang) }}">--}}
                                            {{--{{ $language }}--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}


                        {{--</ul>--}}
                    {{--</li>--}}

                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown"
                           aria-expanded="true">

                            <img src="{{  auth()->user()?->getFirstMediaUrl()?:asset('/default.png') }}"
                                     alt="user-img" class="img-circle user-img">

                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('helpAdmin.edit', auth()->user()?->id)}}"><i
                                            class="ti-user m-r-5"></i>@lang('maincp.personal_page')</a></li>
{{--                            <!--<li><a href="{{ route('users.edit', auth()->id()) }}"><i class="ti-settings m-r-5"></i>-->--}}
{{--                            <!--        @lang('global.settings')-->--}}
{{--                            <!--    </a>-->--}}
{{--                            <!--</li>-->--}}
                            <li>
                                <a href="{{ route('administrator.logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti-power-off m-r-5"></i>@lang('maincp.log_out')
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

        </div>
    </div>

    <form id="logout-form" action="{{ route('administrator.logout') }}" method="POST"
          style="display: none;">
        {{ csrf_field() }}
    </form>

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu" style="    font-size: 14px;">

                    <li>
                        <a href="{{ route('admin.home') }}"><i class="zmdi zmdi-view-dashboard"></i>
                            <span> الرئيسية </span> </a>
                    </li>

{{--                    <li class="has-submenu">--}}
{{--                        <a href="javascript:;"><i--}}
{{--                                class="zmdi zmdi-layers"></i><span> إدارة النظام </span>--}}
{{--                        </a>--}}
{{--                        <ul class="submenu">--}}
{{--                            <li>--}}
{{--                                <a href="{{route('abilities.index')}}">صلاحيات النظام    </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{route('users.index')}}">مديري النظام المفعلين</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{route('users.desactive')}}">مديري النظام المعطلين</a>--}}
{{--                            </li>--}}

{{--                            @if(auth()->user()->roles()->whereName('owner')->first())--}}
{{--                                <li>--}}
{{--                                    <a href="{{ route('roles.index') }}">الصلاحيات والادوار</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                        </ul>--}}

{{--                    </li>--}}

                    <li>
                        <a href="{{ route('users.index') }}"><i class="zmdi zmdi-view-dashboard"></i>
                            <span> المستخدمين </span> </a>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-layers"></i><span>التجار</span>
                        </a>
                        <ul class="submenu ">
                             <li><a href="{{ route('vendors.index').'?type=new' }}"> التجار الجدد</a></li>
                            <li><a href="{{ route('vendors.index') }}">التجار الحالين</a></li>
                            <li><a href="{{ route('change_profile') }}">طلبات التغير  </a></li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-layers"></i><span>  الإضافات الأساسية </span>
                        </a>
                        <ul class="submenu ">
                            <li><a href="{{ route('sliders.index') }}"> اللسليدر</a></li>
                            <li><a href="{{ route('categories.index') }}"> الأقسام الرئيسية</a></li>
                            <li><a href="{{ route('categories.index').'?type=sub' }}"> الأقسام الفرعية</a></li>
                            <li><a href="{{ route('countries.index') }}"> الدول  </a></li>
                            <li><a href="{{ route('countries.index').'?type=sub' }}"> المحافظات</a></li>
                            <li><a href="{{ route('countries.index').'?type=subSub' }}"> المدن</a></li>
                            <li><a href="{{ route('countries.index').'?type=subSubSub' }}"> الأحياء</a></li>
                            <li><a href="{{ route('banks.index') }}"> البنوك</a></li>
                            <li><a href="{{ route('promo_codes.index') }}"> أكواد الخصم</a></li>
                            <li><a href="{{ route('shipping.index') }}">شركات الشحن</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-layers"></i><span>  الإضافات الخاصة بالمنتج </span>
                        </a>
                        <ul class="submenu ">
                            <li><a href="{{ route('brands.index') }}"> الماركات</a></li>
                            <li><a href="{{ route('ages.index') }}">   السن</a></li>
                            <li><a href="{{ route('colors.index') }}?type=frame_colors">   لون الإطار</a></li>
                            <li><a href="{{ route('colors.index') }}?type=lens_colors">      لون العدسة</a></li>
                            <li><a href="{{ route('frame_materials.index') }}">        خامة الإطار</a></li>
                            <li><a href="{{ route('frame_shaps.index') }}">        شكل الإطار</a></li>
                            <li><a href="{{ route('product_types.index') }}">        نوع النظارة  </a></li>
                            <li><a href="{{ route('products.index') }}?type=new">المنتجات الجديدة</a></li>
                            <li><a href="{{ route('products.index') }}">المنتجات</a></li>
                        </ul>
                    </li>
                        <li>
                            <a href="{{ route('offers.index') }}">العروض</a>
                        </li>
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-layers"></i><span>الإعدادت العامة</span>
                        </a>
                        <ul class="submenu ">
                            <li><a href="{{ route('settings.contactus') }}"> بيانات التواصل </a></li>
                            <li><a href="{{ route('settings.global') }}">   بيانات الموقع</a></li>
                            <li><a href="{{ route('settings.static') }}">   أهداف الموقع</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('contact_us_inbox.index') }}">تواصل معنا</a>
                    </li>
                    <li>
                        <a href="{{ route('public_notification') }}">الإشعارات الجماعية</a>
                    </li>


                </ul>
                <!-- End navigation menu  -->
            </div>
        </div>
    </div>

</header>
<!-- End Navigation Bar-->


<div class="wrapper">
    <div class="container">
