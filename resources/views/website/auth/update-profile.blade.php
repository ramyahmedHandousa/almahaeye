@extends('website.layouts.master')
@section('styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')

    <div class="container">
        <div class="sec-title" style="margin-top: 20px;">
            <h2 class="title" id="title-profile"> {{trans('website.auth.edit_profile')}} </h2>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-3">
                <form action="{{route('auth.update.image')}}" method="POST" enctype="multipart/form-data">
                   @csrf
                    <div class="upload-file form-group">
                        <label>
                            <div class="upload-icon">
                                <img class="prev" id="img_profile" loading="lazy"
                                     src="{{ auth()->user()?->getFirstMediaUrl('master_image') ?: asset('website/templates/images/avatar.png') }}">
                            </div>
                            <input type="file" name="image" accept="image/*" onChange="img_profilePath(this);"
                                   id="file-input" class="inputfile"/>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-xs the-btn the-btn-22" style="height:50px;width:150px; margin-top:30px;">  {{trans('website.auth.change_image')}}
                    </button>
                </form>
            </div>
            <div class="col-lg-9">
                <div id="information">
                    <form action="{{ route('auth.update.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <div class="col-lg-3">{{trans('website.auth.first_name')}}  </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="first_name" placeholder="{{trans('website.auth.first_name')}}  "
                                       value="{{ auth()->user()->first_name }}" required >
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-3">{{trans('website.auth.last_name')}}  </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="last_name" placeholder="{{trans('website.auth.last_name')}}  "
                                       value="{{ auth()->user()->last_name }}" required >
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-3">{{trans('website.auth.email')}}  </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control2" name="email" placeholder="{{trans('website.auth.email')}}  "
                                       value="{{ auth()->user()->email }}" required >
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-3">  {{trans('website.auth.phone')}}</div>
                            <div class="col-lg-9">
                                <input type="number" id="phoneCode" placeholder="{{trans('website.auth.phone')}}  " class="form-control form-control2" name="phone"
                                       value="{{ auth()->user()->phone }}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-3">{{trans('website.auth.password')}}  </div>
                            <div class="col-lg-9">
                                <a class="form-control btn btn-sm" id="change-password">{{trans('website.auth.change_password')}}    </a>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row submit-row">
                                <div class="col-lg-3">
                                    <button type="submit" class="btn">{{trans('website.auth.save_changes')}}  </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div id="new-password" style="display: none">
                    <form action="{{ route('auth.update.password')}}"  method="POST" >
                                @csrf
                                <div class="row form-group">
                                    <div class="col-lg-3">{{trans('website.auth.old_password')}}    </div>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control"  name="oldpassword"
                                               placeholder="{{trans('website.auth.old_password')}}    " required >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-3">{{trans('website.auth.new_password')}}    </div>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control"  name="password" placeholder="{{trans('website.auth.new_password')}}"  required >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-3">{{trans('website.auth.confirm_new_password')}}      </div>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control"  name="password_confirmation" placeholder="{{trans('website.auth.confirm_new_password')}}"
                                               required >
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row submit-row">
                                        <div class="col-lg-3 order2">
                                            <a class="btn btn-gray" href="{{ route('my-profile')}}">{{trans('website.global.cancel')}}</a>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn">{{trans('website.auth.save_changes')}}  </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end internal-page -->
@endsection

@section('scripts')

    <script>

        function img_profilePath(input) {
            $('#img_profile')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
        }

        $("#change-password").click(() => {
            $("#title-profile").text('{{trans('website.auth.new_password')}}')
            $("#information").hide();
            $("#new-password").show();
        })
    </script>
@endsection
