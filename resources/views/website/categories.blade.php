@extends('website.layouts.master')

@section('content')

    @if(count($products) > 0 )

        @include('website.categories.products')
    @else

        @include('website.categories.all')

    @endif

@endsection


