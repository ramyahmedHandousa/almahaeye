@extends('website.layouts.master')

@section('content')

    <!-- start slider -->
    @include('website.layouts.sections.slider')
    <!-- end slider -->
    <!-- start our Goal section -->
    @include('website.layouts.sections.our-goal')
    <!-- end section -->
    <!-- start categories section -->
    @include('website.layouts.sections.main-categories',['mainCategories' => $mainCategories ?? []])
    <!-- end categories section -->
    <!-- start most order products -->
    @include('website.layouts.sections.products-most-order')
    <!-- end products -->
    <!-- start Offers products -->
    @include('website.layouts.sections.offers')
    <!-- end products -->
{{--    @include('website.layouts.sections.filter-categories-have-products')--}}
    <!-- start banner -->

@endsection
