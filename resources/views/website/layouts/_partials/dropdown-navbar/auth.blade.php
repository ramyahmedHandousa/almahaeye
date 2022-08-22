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
                {{trans('website.auth.profile')}}
            </a>
        </li>
            <a class="dropdown-item" href="{{ route('orders.index')}}">
                {{trans('website.auth.orders')}}
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
                                {{trans('website.auth.products')}}
                            </a>
                    </li>
                @endif

            @if (auth()->user()->type == 'client')
                <li>
                    <a class="dropdown-item" href="{{ route('addresses.index')}}">
                        {{trans('website.auth.address')}}
                    </a>
                </li>
            @endif
            @if(auth()->user()?->is_active == 0)
                <li style="background-color: #e0c057">
                    <a class="dropdown-item" href="{{route('check-user-code')}}">
                       {{trans('website.auth.active_account')}}
                    </a>
                </li>
            @endif
            @if(auth()->user()?->marketing_agree != 1)
                <li  style="background-color:@if(auth()->user()?->marketing_agree == 0 && auth()->user()?->marketing_agree_info != null)  #e0c057 @else #e78989 @endif">
                    <a class="dropdown-item" href="{{route('complete-marking-agree')}}">
                        {{trans('website.auth.marking_agree')}}
                    </a>
                </li>
            @endif
            <li>
                <a class="dropdown-item" href="{{route('contact-us')}}">
                    {{trans('website.auth.contact_us')}}
                </a>
            </li>

{{--            <li>--}}
{{--                <a class="dropdown-item" href="{{ route('aboutus')  }}">--}}
{{--                    من نحن--}}
{{--                </a>--}}
{{--            </li>--}}

            <li>
                <a class="dropdown-item" href="{{route('global-setting','terms')}}">
                    {{trans('website.auth.terms')}}
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{route('global-setting','privacy')}}">
                    {{trans('website.auth.privacy')}}
                </a>
            </li>
            <li>
                <a class="dropdown-item" onclick="window.localStorage.clear()" href="{{ route('log-out') }}">
                    {{trans('website.auth.log_out')}}
                </a>
            </li>
    </ul>
</div>
