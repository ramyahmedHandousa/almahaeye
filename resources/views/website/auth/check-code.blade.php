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

    <div class="container" style="margin-top:10px;">
        <h2 class="title">{{trans('website.auth.confirm_phone')}} </h2>

        <form class="row validation-code" action="{{route('auth.activation.account')}}" method="POST">
            @csrf

            <input type="hidden" value="{{request('token')}}" name="token">

                <div class="col-lg-2 form-group ">
                </div>


                <div class="col-lg-2 form-group ">
                    <input type="text" name="code1" id="n0"  maxlength="1" class="form-control input-key inputCode" autofocus data-next="1" required>
                    @error('code1') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-2 form-group">
                    <input type="text"  name="code2" id="n1" maxlength="1"  class="form-control input-key inputCode" data-next="2" required>
                    @error('code2') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-2 form-group">
                    <input type="text"  name="code3" id="n2" maxlength="1"  class="form-control input-key inputCode" data-next="3" required>
                    @error('code3') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-2 form-group">
                    <input type="text"  name="code4" id="n3" maxlength="1"  class="form-control input-key inputCode" data-next="0" required>
                    @error('code4') <span class="error">{{ $message }}</span> @enderror
                </div>



            <div class="form-group" style="margin-bottom: 40px">
            </div>
            <div class="sub-title">{{trans('website.auth.resend_code_text')}} <span id="time">3</span> {{trans('website.auth.minutes')}}
                <span class="edit" id="active">
                    <a href="{{route('auth.resend.code')}}"> {{trans('website.auth.resend_code')}}  </a></span>
            </div>
            <div class="col-12">
                <div class="row submit-row">
                    <div class="col-lg-3 order2">
                        <a class="btn btn-gray" href="{{ url('/')}}">{{trans('website.global.back')}}</a>
                    </div>
                    <div class="col-lg-3">
                        {{-- <button type="submit" class="btn">تأكيد</button> --}}
                        <button type="submit" class="btn the-btn-222 the-btn-2 btn-block">{{trans('website.global.confirm')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@section('scripts')

    <script>
        var start;
        var timer_is_on = 0;

        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            start = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;
                timer_is_on = 1;
                $('#active').hide();
                if (--timer < 0) {
                    timer = duration;
                }
                if (timer == 0) {
                    clearTimeout(start);
                    $('#active').show();
                }
            }, 1000);
        }

        window.onload = function () {
            var fiveMinutes = 60 * 3,
                display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
        };

        function stop() {
            clearTimeout(start);
            $('#active').show();
        }


        $(document).ready(function() {
            $('.input-key').keyup(function(e) {
                if (this.value.length === this.maxLength) {
                    let next = $(this).data('next');
                    $('#n' + next).focus();
                }
            });
        });
    </script>
@endsection
