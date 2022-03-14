<div class="dropdown">
    <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
            aria-expanded="false">
                          <span class="icon">
                            <i class="fas fa-user"></i>
                          </span>
        {!! \Illuminate\Support\Str::limit(auth()->user()?->name, 10, ' ...') !!}
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li>
            <a class="dropdown-item" href="{{ route('my-profile')}}">
                حسابى
            </a>
        </li>
            <a class="dropdown-item" href="{{ route('orders.index')}}">
                طلباتي
            </a>
        <li>

        </li>
{{--        <li>--}}
{{--        <li>--}}
{{--            @if (auth()->user()->type == 'client')--}}
{{--                <a class="dropdown-item" href="{{ route('wishlist')}}">--}}
{{--                    قائمه التمنى--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        </li>--}}
{{--        <li>--}}
{{--            @if (auth()->user()->type == 'vendor')--}}
{{--                <a class="dropdown-item" href="{{route('vendors.orders')}}">--}}
{{--                    طلباتى--}}
{{--                </a>--}}
{{--            @else--}}
{{--                <a class="dropdown-item" href="{{route('profile.order.tracking')}}">--}}
{{--                    طلباتى--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        </li>--}}

{{--            <li>--}}
                @if (auth()->user()->type == 'vendor')
                    <li>
                            <a class="dropdown-item" href="{{ route('vendor-products.index')}}">
                                منتجاتى
                            </a>
                    </li>
                @endif

            @if (auth()->user()->type == 'client')
                <li>
                    <a class="dropdown-item" href="{{ route('addresses.index')}}">
                        عناوينى
                    </a>
                </li>
            @endif
            @if(auth()->user()?->is_active == 0)
                <li style="background-color: #e0c057">
                    <a class="dropdown-item" href="{{route('check-user-code')}}">
                    تفعيل الحساب
                    </a>
                </li>
            @endif
            <li>
                <a class="dropdown-item" href="{{route('contact-us')}}">
                    تواصل معنا
                </a>
            </li>

{{--            <li>--}}
{{--                <a class="dropdown-item" href="{{ route('aboutus')  }}">--}}
{{--                    من نحن--}}
{{--                </a>--}}
{{--            </li>--}}

            <li>
                <a class="dropdown-item" href="{{route('global-setting','terms')}}">
                    الشروط والأحكام
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{route('global-setting','privacy')}}">
                    سياسة الاسترجاع
                </a>
            </li>
            <li>
                <a class="dropdown-item" onclick="window.localStorage.clear()" href="{{ route('log-out') }}">
                    تسجيل الخروج
                </a>
            </li>
    </ul>
</div>
