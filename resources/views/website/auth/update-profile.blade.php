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
            <h2 class="title" id="title-profile">تعديل البيانات الشخصيه </h2>
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
                    <button type="submit" class="btn btn-xs the-btn the-btn-22" style="height:50px;width:150px; margin-top:30px;">تغيير الصوره
                    </button>
                </form>
            </div>
            <div class="col-lg-9">
                <div id="information">
                    <form action="{{ route('auth.update.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <div class="col-lg-3">الاسم الأول</div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="first_name" placeholder="الاسم الأول"
                                       value="{{ auth()->user()->first_name }}" required >
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-3">الاسم الأخير</div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="last_name" placeholder="الاسم الأخير"
                                       value="{{ auth()->user()->last_name }}" required >
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-3">البريد الإلكترونى</div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control form-control2" name="email" placeholder="البريد الالكترونى"
                                       value="{{ auth()->user()->email }}" required >
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-3">رقم الهاتف</div>
                            <div class="col-lg-9">
                                <input type="number" id="phoneCode" placeholder="رقم الجوال" class="form-control form-control2" name="phone"
                                       value="{{ auth()->user()->phone }}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-lg-3">كلمة المرور</div>
                            <div class="col-lg-9">
                                <a class="form-control btn btn-sm" id="change-password">تغير كلمة المرور</a>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row submit-row">
                                <div class="col-lg-3">
                                    <button type="submit" class="btn">حفظ التغييرات</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div id="new-password" style="display: none">
                    <form action="{{ route('auth.update.password')}}"  method="POST" >
                                @csrf
                                <div class="row form-group">
                                    <div class="col-lg-3">كلمة المرور القديمة</div>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control"  name="oldpassword"
                                               placeholder="كلمة المرور القديمة" required >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-3">كلمة المرور الجديدة</div>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control"  name="password" placeholder="كلمة المرور الجديدة"  required >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-3">إعادة كلمة المرور الجديدة</div>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control"  name="password_confirmation" placeholder="إعادة كلمة المرور الجديدة"
                                               required >
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row submit-row">
                                        <div class="col-lg-3 order2">
                                            <a class="btn btn-gray" href="{{ route('my-profile')}}">الغاء</a>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn">حفظ التغييرات</button>
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
            $("#title-profile").text("تعيين كلمة المرور")
            $("#information").hide();
            $("#new-password").show();
        })
    </script>
@endsection
