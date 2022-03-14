
<div class="dropdown">
    <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
            aria-expanded="false">
                            <span class="icon">
                                <i class="fas fa-user"></i>
                            </span>
        تسجيل الدخول
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
        <div class="login-dropdown">
            <h4 class="title">سجل دخولك</h4>
            <div class="sub-title">مرحبا بك مجددا</div>
            <form method="post" id="loginForm" action="{{route('login')}}">
                @csrf
                <div class="input-group form-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input name="email" type="email" required class="form-control" placeholder="البريد الالكترونى">
                </div>
                <div class="input-group form-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input name="password" type="text" required class="form-control" placeholder="كلمة المرور">
                </div>
                <div class="form-group">
                    <button class="btn" id="button-login" type="submit">سجل دخول</button>

                </div>
            </form>
                <div class="form-group remember-group">
{{--                    <div class="remember">--}}
{{--                        <label class="form-check-label">--}}
{{--                            <input class="form-check-input" type="checkbox" value="">--}}
{{--                            تذكرنى--}}
{{--                        </label>--}}
{{--                    </div>--}}
                    <div class="resetpass"><a href="{{route('auth-forget-password')}}">نسيت كلمة المرور ؟</a></div>
                </div>
                <div class="form-group">
                    <p>يمكنك إنشاء حساب بخطوات سهلة ,فقط إضغط
                        على تسجيل جديد وقم بملا الحقول المطلوبة, ثم
                        إستمتع بالمميزات التي نقدمها لك</p>
                </div>
                <div class="form-group">
                    <a class="btn" href="{{route('sign-user')}}">تسجيل جديد</a>
                </div>
                <div class="form-group">
                    <a class="btn" href="{{route('sign-up-vendor')}}">تسجيل تاجر جديد</a>
                </div>

        </div>
    </ul>
</div>

