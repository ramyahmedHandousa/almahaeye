@extends('website.layouts.master')

@section('styles')

    <style>
        .error{
            color: red;
        }
        .inputCode{
            font-size: 30px;
            color: #0a0302;
        }
    </style>
@endsection
@section('content')

    <div class="container" style="margin-top:5%;margin-bottom: 5%">
        <h2 class="title">{{trans('website.auth.pls_phone')}}      </h2>
        <form class="row validation-code" action="{{route('auth-send-forget-password')}}" method="POST">
            {{csrf_field()}}

                <div class="col-lg-6 form-group " style="margin-bottom: 50px;margin-top: 20px">
                    <span class="label label-info">{{trans('website.auth.phone')}} :</span>
                    <input type="text" name="phone" placeholder="{{trans('website.auth.pls_phone')}}  "  maxlength="20" class="form-control inputCode" required>
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>

            <div class="col-12">
                <div class="row submit-row">
                    <div class="col-lg-3 order2">
                        <a class="btn btn-gray" href="{{ url('/')}}">{{trans('website.global.back')}}</a>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" class="btn the-btn-222 the-btn-2 btn-block">{{trans('website.global.confirm')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@section('scripts')

@endsection
