@extends('website.layouts.master')
@section('styles')

@endsection
@section('content')

<section class="cart">
    <!-- start internal-page -->
    <div class="container">

        <div class="row">
            <!-- cart products -->

                @include('website.cart.sections.list-products')

                @include('website.cart.sections.list-address')

                @include('website.cart.sections.list-shipping')

                @include('website.cart.sections.order-info')

        </div>
    </div>
    <!-- end internal-page -->
</section>

@endsection
@section('scripts')


    <script>

    </script>

    <script>



    </script>

@endsection
