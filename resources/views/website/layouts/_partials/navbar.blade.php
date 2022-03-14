
<div id="top">
    <div class="container">
        <ul>
{{--            <li class="phone">--}}
{{--                    <span class="icon">--}}
{{--                        <i class="fas fa-phone"></i>--}}
{{--                    </span>--}}
{{--                <a href="tel:+98888377261">+98888377261</a>--}}
{{--            </li>--}}
{{--            <li class="email">--}}
{{--                    <span class="icon">--}}
{{--                        <i class="fas fa-envelope"></i>--}}
{{--                    </span>--}}
{{--                <a href="mailto:almahaeye@gamil.com">almahaeye@gamil.com</a>--}}

{{--            </li>--}}
        </ul>
        <ul>
            <li class="lang">
                <div class="dropdown">
                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="icon">
                                <img loading="lazy"   src="{{asset('website/templates/images/saudi-arabia.png')}}" alt="">
                            </span>
                        العربية
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="#">
                                    <span class="icon">
                                        <img loading="lazy"   src="{{asset('website/templates/images/saudi-arabia.png')}}" alt="">
                                    </span>
                                العربية
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                    <span class="icon">
                                        <img loading="lazy"   src="{{asset('website/templates/images/united-states-of-america.png')}}" alt="">
                                    </span>
                                الإنجليزية
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @auth
                <li class="profile-menu">
                    @include('.website.layouts._partials.dropdown-navbar.auth')
                </li>
            @endauth

            @guest
                <li class="profile">
                    @include('.website.layouts._partials.dropdown-navbar.guest')
                </li>
            @endguest

        </ul>
    </div>
</div>
