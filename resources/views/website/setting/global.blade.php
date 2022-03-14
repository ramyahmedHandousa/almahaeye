@extends('website.layouts.master')

@section('content')


    <section>
        <!-- start internal-page -->
        <div class="container">
            <h2 class="title">{{$text}}</h2>
            <p> {{$body}} </p>
        </div>
        <!-- end internal-page -->
    </section>
@endsection



