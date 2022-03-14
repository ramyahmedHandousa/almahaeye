<!-- Navigation Bar-->
<header id="topnav">

    <div class="topbar-main">
        <div class="container">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="{{ route('admin.home') }}" class="logo" style="width: 150px;"><img style="width: 100%"
                                                                                            src="{{ request()->root() }}/public/assets/admin/images/logo.png"></a>
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
                        <div class="notification-box">
                            <ul class="list-inline m-b-0">
                                <li>
                                    <a href="{{ route('notifications.index') }}" class="right-bar-toggle">
                                        <i class="zmdi zmdi-notifications-none"></i>
                                    </a>
                                    <div class="noti-dot">
                                        <span class="dot"></span>
                                        <span class="pulse"></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown"
                           aria-expanded="true">
                            <img src="{{ request()->root() }}/public/assets/admin/images/saudi-arabia.png"
                                 alt="user-img"
                                 class="img-circle user-img">
                        </a>

                        <ul class="dropdown-menu">

                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--{{ app()->getLocale() }} <i class="fa fa-caret-down"></i>--}}
                            {{--</a>--}}

                            @foreach (config('translatable.locales') as $lang => $language)
                                @if ($lang != app()->getLocale())
                                    <li>
                                        <a href="{{ route('lang.switch', $lang) }}">
                                            {{ $language }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach


                        </ul>
                    </li>

                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown"
                           aria-expanded="true">
                            <img src="{{ $helper->getDefaultImage(auth()->user()->image, request()->root().'/public/assets/admin/images/default.png') }}"
                                 alt="user-img" class="img-circle user-img">
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('user.profile') }}?profileId={{ auth()->id() }}&area=managers"><i
                                            class="ti-user m-r-5"></i>@lang('maincp.personal_page')</a></li>
                            <li><a href="{{ route('users.edit', auth()->id()) }}"><i class="ti-settings m-r-5"></i>
                                    @lang('global.settings')
                                </a>
                            </li>
                            <li><a href="{{ route('logout') }}"
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
                            <span> @lang('menu.home') </span> </a>
                    </li>
                    {{--@can('users_manage')--}}
                    {{--<li class="has-submenu">--}}
                    {{--<a href="#"><i class="zmdi zmdi-invert-colors"></i> <span> @lang('menu.app_users') </span>--}}
                    {{--</a>--}}
                    {{--<ul class="submenu megamenu">--}}
                    {{--<li>--}}
                    {{--<ul>--}}
                    {{--<strong><h5 style="font-weight: 600;">إدارة التطبيق</h5></strong>--}}
                    {{--<li><a href="{{ route('users.index') }}">مشاهدة إدارة التطبيق</a></li>--}}
                    {{--<li><a href="{{ route('users.create') }}">إضافة مدير</a></li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<ul>--}}
                    {{--<strong><h5 style="font-weight: 600;">المسجلين بالتطبيق</h5></strong>--}}
                    {{--<li><a href="{{ route('users.index') }}?type=app-users&usersList=active-users">مشاهدة--}}
                    {{--المستخدمين</a></li>--}}

                    {{--<li>--}}
                    {{--<a href="{{ route('users.index') }}?type=app-users&usersList=inactive-users">--}}
                    {{--مستخدمين غير مفعلين</a></li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--@can('roles_manage')--}}
                    {{--<li>--}}
                    {{--<ul>--}}
                    {{--<strong><h5 style="font-weight: 600;">الادوار والصلاحيات</h5></strong>--}}
                    {{--<li><a href="{{ route('roles.index') }}">مشاهدة الادوار</a></li>--}}
                    {{--<li><a href="{{ route('roles.create') }}">إضافة دور</a></li>--}}
                    {{--                                            <li><a href="{{ route('permissions.index') }}">مشاهدة الصلاحيات</a></li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--@endcan--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--@endcan--}}


                    {{--<li>--}}
                    {{--<a href="{{ route('user.profile') }}"><i class=" zmdi zmdi-account"></i>--}}
                    {{--<span>@lang('maincp.my_profile') </span> </a>--}}
                    {{--</li>--}}


                    {{--<li>--}}
                    {{--<a href="{{ route('companies.index') }}"><i class="zmdi zmdi-view-dashboard"></i>--}}
                    {{--<span> المنشأت </span> </a>--}}
                    {{--</li>--}}


                    {{--<li class="has-submenu">--}}
                    {{--<a href="#"><i class="zmdi zmdi-settings"></i><span>@lang('maincp.setting')<i--}}
                    {{--class="fa fa-arrow-down visible-xs" aria-hidden="true"></i></span> </a>--}}
                    {{--<ul class="submenu">--}}
                    {{--<li><a href="{{ route('settings.time') }}">@lang('maincp.general_setting')</a></li>--}}
                    {{--<!--<li><a href="{{ route('ordersTypes.index') }}">@lang('maincp.view_order_types')</a></li>-->--}}
                    {{--<li><a href="{{ route('carmodels.index') }}">@lang('maincp.view_cars_type')</a></li>--}}
                    {{--<li><a href="{{ route('brands.index') }}">@lang('maincp.view_car_brands')</a></li>--}}
                    {{--<li><a href="{{ route('batteries.index') }}">@lang('maincp.view_types_of_batteries')</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ route('sizes.index').'?size-type=batteries' }}">@lang('maincp.view_battery_sizes')</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="{{ route('covers.index') }}">@lang('maincp.view_types_of_infidel')</a></li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ route('sizes.index').'?size-type=covers' }}">@lang('maincp.view_sizes_of_infidels')</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="{{ route('maintenance.index') }}">@lang('maincp.view_types_of_maintenance')</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ route('sizes.index').'?size-type=jants' }}">@lang('maincp.view_rim_sizes')</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="{{ route('countries.index') }}">@lang('maincp.country_established')</a></li>--}}
                    {{--<li><a href="{{ route('cities.index') }}">@lang('maincp.cities') </a></li>--}}
                    {{--<li><a href="{{ route('years.index') }}">سنوات التصنيع</a></li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ route('spareparts.commerceType') }}">@lang('maincp.commercial_spare_parts') </a>--}}
                    {{--</ul>--}}
                    {{--</li>--}}


                    <li class="has-submenu">
                        <a href="#"><i
                                    class="zmdi zmdi-accounts"></i><span>@lang('maincp.customer_management')   </span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="{{ route('stations.index') }}">
                                    @lang('trans.stations')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('companies.index') }}">@lang('trans.transporters')</a>
                            </li>
                        </ul>
                    </li>


                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-layers"></i><span>  @lang('trans.managers_ctrl_panel') </span>
                        </a>
                        <ul class="submenu ">
                            <li><a href="{{ route('users.index') }}"> @lang('trans.managers_system')</a></li>
                            <li>
                                <a href="{{ route('roles.index') }}">
                                    @lang('trans.roles_and_permission')
                                </a>
                            </li>


                        </ul>
                    </li>


                    <li class="has-submenu">
                        <a href="javascript:;">
                            <i class="zmdi zmdi-square-o"></i>
                            <span>  @lang('maincp.content_management')  </span>
                        </a>
                        <ul class="submenu ">

                            <li><a href="{{ route('settings.aboutus') }}">@lang('maincp.about_the_app_and_location')</a>
                            </li>
                            <li><a href="{{ route('settings.support') }}">@lang('maincp.technical_support')</a></li>
                            <li><a href="{{ route('faqs.index') }}">@lang('maincp.common_questions')</a></li>
                            <li><a href="{{ route('settings.contactus') }}">@lang('maincp.call_us')</a></li>
                            <li><a href="{{ route('support.index') }}">@lang('maincp.contact_us')</a></li>
                            <li>
                                <a href="{{ route('create.public.notifications') }}">  @lang('maincp.public_notication')</a>
                            </li>
                            <li><a href="{{ route('sliders.index') }}">  @lang('maincp.sliders')</a></li>

                            {{--<li>--}}
                            {{--<a href="{{ route('administrator.settings.comments') }}">إدارة ضبط--}}
                            {{--المنشأت</a>--}}
                            {{--</li>--}}

                            {{--<li><a href="{{ route('settings.terms') }}">معاهدة الإستخدام</a></li>--}}
                            {{--<li><a href="{{ route('settings.socials') }}">روابط التواصل</a></li>--}}

                            {{--@can('membership_manage')--}}
                            {{--<li><a href="{{ route('membership.index') }}">العضويات</a></li>--}}
                            {{--@endcan--}}


                        </ul>
                    </li>


                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-settings"></i><span>@lang('maincp.setting')<i
                                        class="fa fa-arrow-down visible-xs" aria-hidden="true"></i></span> </a>
                        <ul class="submenu">


                            <li><a href="{{ route('settings.app.general') }}">@lang('trans.general_setting_app')</a>
                            </li>
                            <li><a href="{{ route('products.index') }}">@lang('trans.products_management')</a></li>
                            <li><a href="{{ route('cities.index') }}">@lang('trans.cities')</a></li>
                            <li><a href="{{ route('sizes.index') }}">@lang('trans.transports_size')</a></li>
                            <li><a href="{{ route('branches.index') }}">@lang('trans.aramco_branches')</a></li>
                            <li><a href="{{ route('banks.index') }}">@lang('trans.banks_accounts')</a></li>


                            {{--<!--<li><a href="{{ route('ordersTypes.index') }}">@lang('maincp.view_order_types')</a></li>-->--}}
                            {{--<li><a href="{{ route('carmodels.index') }}">@lang('maincp.view_cars_type')</a></li>--}}
                            {{--<li><a href="{{ route('brands.index') }}">@lang('maincp.view_car_brands')</a></li>--}}
                            {{--<li><a href="{{ route('batteries.index') }}">@lang('maincp.view_types_of_batteries')</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="{{ route('sizes.index').'?size-type=batteries' }}">@lang('maincp.view_battery_sizes')</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="{{ route('covers.index') }}">@lang('maincp.view_types_of_infidel')</a></li>--}}
                            {{--<li>--}}
                            {{--<a href="{{ route('sizes.index').'?size-type=covers' }}">@lang('maincp.view_sizes_of_infidels')</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="{{ route('maintenance.index') }}">@lang('maincp.view_types_of_maintenance')</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="{{ route('sizes.index').'?size-type=jants' }}">@lang('maincp.view_rim_sizes')</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="{{ route('countries.index') }}">@lang('maincp.country_established')</a></li>--}}
                            {{--<li><a href="{{ route('cities.index') }}">@lang('maincp.cities') </a></li>--}}
                            {{--<li><a href="{{ route('years.index') }}">سنوات التصنيع</a></li>--}}
                            {{--<li>--}}
                            {{--<a href="{{ route('spareparts.commerceType') }}">@lang('maincp.commercial_spare_parts') </a>--}}

                            {{--</li>--}}
                        </ul>
                    </li>


                    <li class="has-submenu">
                        <a href="#"><i
                                    class="zmdi zmdi-border-all"></i><span>@lang('trans.orders_management')   </span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="{{ route('bank.transfer.client') }}">
                                    @lang('trans.bank_transfer_from_client')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('bank.transfer.company') }}">
                                    @lang('trans.bank_transfer_from_company')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('financial.company.dues') }}">
                                    @lang('trans.money_required')
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="zmdi zmdi-flag"></i><span>@lang('maincp.reports')</span> </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('reports.bank.transfer.client') }}">@lang('trans.reports_bank_transfer_from_client') </a>
                            </li>
                            <li>
                                <a href="{{ route('reports.bank.transfer.transporter') }}">@lang('trans.reports_bank_transfer_from_company')  </a>
                            </li>
                            <li><a href="{{ route('reports.orders') }}">@lang('trans.reports_orders') </a></li>

                        </ul>
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