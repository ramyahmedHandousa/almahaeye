<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <link rel="shortcut icon" href="/assets/admin/images/favicon.ico">
    <title>لوحة التحكم  (عيون المها )      </title>
    <link rel="stylesheet" href="/css/all.css">
    <style>
        input,
        input::-webkit-input-placeholder {
            font-size: 11px;
            line-height: 3;
        }
    </style>


{{--    <script src="/assets/admin/js/modernizr.min.js"></script>--}}
</head>
<body>
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page" style="margin:  3% auto">
    <div class="text-center">
        <a href="{{ route('admin.login') }}" class="logo" style="font-family: JF-Flat-Regular;">
            <span>لوحة التحكم  (عيون المها )      </span>
        </a>
    </div>
    @yield('content')
</div>

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
{{--<script src="/js/all.js"></script>--}}

</body>
</html>
