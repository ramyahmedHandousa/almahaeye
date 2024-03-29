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
        <h2 class="title">{{trans('website.auth.pls_phone')}}  </h2>
        <form class="row validation-code" action="{{route('auth-send-new-password')}}" method="POST">
            {{csrf_field()}}

            <input type="hidden" value="{{$token}}" name="token">
            <div class="col-lg-6 form-group " style="margin-bottom: 50px;margin-top: 20px">
                <span class="label label-info">{{trans('website.auth.new_password')}}   :</span>
                <input type="password" name="password"  maxlength="20" class="form-control inputCode" placeholder="{{trans('website.auth.new_password')}}  " required>
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-6 form-group " style="margin-bottom: 50px;margin-top: 20px">
                <span class="label label-info">{{trans('website.auth.confirm_new_password')}}    :</span>
                <input type="password" name="confirm_password"  maxlength="20" class="form-control inputCode" placeholder="{{trans('website.auth.confirm_new_password')}}    :"  required>
                @error('confirm_password') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="col-12">
                <div class="row submit-row">
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
