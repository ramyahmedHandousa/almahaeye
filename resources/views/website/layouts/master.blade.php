<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>عين المها</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('website.layouts._partials.styles')
    <style>
        .colorRed{
            color: red !important;
        }
    </style>
    @yield('styles')
    @livewireStyles
</head>

<body>
<!-- start top -->
@include('website.layouts._partials.navbar')
<!-- end top -->
<!-- start header-2 -->
@include('website.layouts.sections.header')
<!-- end header -->

<div style="margin-top: 2%;margin-bottom: 5%">
    @yield('content')
</div>


<!-- end products -->
<!-- start subscription box -->
@include('website.layouts._partials.subscription-box')
<!-- end subscribe -->

<!-- start footer -->
@include('website.layouts._partials.footer')
<!-- end footer -->

@include('website.layouts._partials.scripts')

@yield('scripts')

@livewireScripts
</body>

</html>
