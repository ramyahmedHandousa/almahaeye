
<div class="dropdown">
    <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
            aria-expanded="false">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
        {{trans('website.auth.login')}}
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
        <div class="login-dropdown">
            <h4 class="title">{{trans('website.auth.login_text')}}</h4>
{{--            <div class="sub-title">مرحبا بك مجددا</div>--}}
            <form method="post" id="loginForm" action="{{route('login')}}">
                @csrf
                <div class="input-group form-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input name="email" type="email" required class="form-control" placeholder=" {{trans('website.auth.email')}}">
                </div>
                <div class="input-group form-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input name="password" type="text" required class="form-control" placeholder=" {{trans('website.auth.password')}}">
                </div>
                <div class="form-group">
                    <button class="btn" id="button-login" type="submit"> {{trans('website.auth.login')}}</button>

                </div>
            </form>
                <div class="form-group remember-group">
{{--                    <div class="remember">--}}
{{--                        <label class="form-check-label">--}}
{{--                            <input class="form-check-input" type="checkbox" value="">--}}
{{--                            تذكرنى--}}
{{--                        </label>--}}
{{--                    </div>--}}
                    <div class="resetpass"><a href="{{route('auth-forget-password')}}"> {{trans('website.auth.forget_password')}}</a></div>
                </div>
                <div class="form-group">
                    <p>{{trans('website.auth.text_static')}}</p>
                </div>
                <div class="form-group">
                    <a class="btn" href="{{route('sign-user')}}"> {{trans('website.auth.register_user')}}</a>
                </div>
                <div class="form-group">
                    <a class="btn" href="{{route('sign-up-vendor')}}"> {{trans('website.auth.register_vendor')}}</a>
                </div>

        </div>
    </ul>
</div>

