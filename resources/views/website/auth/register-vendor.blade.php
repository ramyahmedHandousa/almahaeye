@extends('website.layouts.master')

@section('styles')

    <style>
        .error{
            color: red;
        }
        .mapSearchLocation{
            z-index: 1; position: absolute;  top: 10px !important;
            left: 197px; height: 40px;   width: 63%;   border: none;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
            padding: 0 1em;   color: rgb(86, 86, 86);
            font-family: Roboto, Arial, sans-serif;
            user-select: none;  font-size: 18px;   margin: 10px;
        }
    </style>
@endsection
@section('content')

    <section>
        <div class="container">
            <div class="sec-title">
                <h2 class="title">تسجيل تاجر جديد</h2>
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
            <form class="row" method="post" action="{{route('register-vendor')}}" enctype="multipart/form-data">

                @csrf

                <div class="col-lg-4 form-group">
                    <input type="text"  name="trade_name" value="{{old('trade_name')}}" class="form-control" placeholder="الإسم التجاري" required>
                    @error('trade_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-4 form-group">
                    <input type="text"  name="first_name" value="{{old('first_name')}}" class="form-control" placeholder="اسم الاول" required>
                    @error('first_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-4 form-group">
                    <input type="text"  name="last_name" value="{{old('last_name')}}" class="form-control" placeholder="اسم الأخير" required>
                    @error('last_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-4 form-group">
                    <input type="text"  name="email" value="{{old('email')}}" class="form-control" placeholder="البريد الإلكترونى" required>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-4 form-group">
                    <input type="text"  name="phone" value="{{old('phone')}}" class="form-control" placeholder="رقم الهاتف" required>
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-4 form-group">
                    <input type="password" name="password" class="form-control" placeholder="كلمة المرور" required>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="col-lg-4 form-group">
                    <input type="password" name="confirm_password" class="form-control" placeholder="تأكيد كلمة المرور" required>
                    @error('confirm_password') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-4 form-group">
                    <select class="form-select" id="country"   required>
                        <option value=''>اختار الدولة</option>
                        @foreach($countries as $country)
                            <option value={{ $country->id }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-4 form-group">
                    <select class="form-select"  id="region"  required>
                        <option value=''>اختار المنطقة</option>
                    </select>
                </div>

                <div class="col-lg-4 form-group">
                    <select class="form-select" id="city" name="country_id"  required>
                        <option value=''>اختار المدينة</option>
                    </select>
                </div>

{{--                <div class="col-lg-4 form-group">--}}
{{--                    <select class="form-select" name="country_id"  id="state"  required>--}}
{{--                        <option value=''>اختار الحي</option>--}}
{{--                    </select>--}}

{{--                    @error('country_id') <span class="error">{{ $message }}</span> @enderror--}}
{{--                </div>--}}


                <div class="col-lg-8 form-group">
                    <input type="text"  name="city_address" value="{{old('city_address')}}" class="form-control" placeholder="عنوان الحي الخاص بك  " required>
                    @error('city_address') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-4 form-group">
                    <select class="form-select" name="bank_id" required>
                        <option value=''>اختار البنك</option>
                        @foreach($banks as $bank)
                            <option value={{ $bank->id }}>{{ $bank->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-4 form-group">
                    <input type="text"  name="iban" value="{{old('iban')}}" class="form-control" placeholder=" رقم الأيبان" required>
                    @error('iban') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-4 form-group">
                    <input type="text"  name="commercial_registration" value="{{old('commercial_registration')}}" class="form-control" placeholder="رقم السجل التجاري" required>
                    @error('commercial_registration') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-lg-4 form-group">  </div>

                <div class="col-lg-12 row" style="margin-top: 5%;margin-bottom: 5%">

                    <div class="col-lg-4 form-group">
                        <div class="row">
                            <label class="col-lg-8"  >صورة السجل التجارى</label>
                            @error('image_commercial') <span class="error">{{ $message }}</span> @enderror
                            <div class="col-lg-4">
                                <div class="upload-file form-group">
                                    <label >
                                        <div class="upload-icon">
                                            <img class="prev" id="image_commercial" loading="lazy"
                                                 src="{{ asset('website/templates/images/upload-to-cloud.png') }}">
                                        </div>
                                        <input type="file" name="image_commercial" onChange="img_record(this);" class="inputfile"
                                                 />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                    <div class="col-lg-4 form-group">--}}
{{--                        <div class="row">--}}
{{--                            <label class="col-lg-8">اتفاقية التسويق</label>--}}
{{--                            @error('image_marketing_agreement') <span class="error">{{ $message }}</span> @enderror--}}
{{--                            <div class="col-lg-4">--}}
{{--                                <div class="upload-file form-group">--}}
{{--                                    <label >--}}
{{--                                        <div class="upload-icon">--}}
{{--                                            <img class="prev" id="image_marketing_agreement" loading="lazy"--}}
{{--                                                 src="{{ asset('website/templates/images/upload-to-cloud.png') }}">--}}
{{--                                        </div>--}}
{{--                                        <input type="file" name="image_marketing_agreement" onChange="marketing_record(this);"  class="inputfile"--}}
{{--                                                />--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <p>يجب تحميل الاتفاقية و توقيعها و ارفاقها مرة اخرى لإتمام التسجيل</p>--}}
{{--                            <a href="{{asset('website/uploads/e-marketing.pdf')}}" target="_blank">تحميل اتفاقية التسويق الإلكتروني</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-lg-4 form-group">
                        <div class="row">
                            <label for="image_service_provider" class="col-lg-8">صورة مقدم الخدمة</label>
                            @error('image_service_provider') <span class="error">{{ $message }}</span> @enderror
                            <div class="col-lg-4">
                                <div class="upload-file form-group">
                                    <label>
                                        <div class="upload-icon">
                                            <img class="prev" id="image_service_provider"  loading="lazy"
                                                 src="{{ asset('website/templates/images/upload-to-cloud.png') }}">
                                        </div>
                                        <input type="file" name="image_service_provider" id="file-input" onChange="img_pathUrl(this);"
                                               class="inputfile"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="col-12" >
                    <div class="mb-15" >
                        <h5>اختر موقعك علي الخريطه</h5>
                        <input   id="pac-input" name="address_search" required
                                 class="controls mapSearchLocation" value="{{old('address_search')}}"
                                 type="text"    placeholder="بحث"  >
                        <input type="hidden" name="latitude"  value="{{old('latitude')}}" id="lat"/>
                        <input type="hidden" name="longitude" value="{{old('longitude')}}" id="lng"/>
                        <input type="hidden" name="address"   value="{{old('address')}}" id="address"/>
                        <div  id="googleMap" width="100%" height="300" style="height: 300px;"></div>
                        @error('latitude') <span class="error">{{ $message }}</span> @enderror
                        @error('longitude') <span class="error">{{ $message }}</span> @enderror
                        @error('address') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-12 form-group">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="" required>
                        أوافق على جميع الشروط والاحكام و سياسة الخصوصية
                    </label>
                </div>

                <div class="col-12">
                    <div class="row submit-row">
                        <div class="col-lg-3 order2">
                            <a class="btn btn-gray" href="{{url('/')}}">إلغاء</a>
                        </div>

                        <div class="col-lg-3">
                            <button type="submit" class="btn">التالى</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    {{--    @livewire('sign-up-user')--}}

@endsection


@section('scripts')

    <script src="{{asset('website/templates/js/mapLocation.js')}}"></script>

    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&amp;callback=initAutocomplete&libraries=places">
    </script>


    <script src="{{asset('website/templates/js/countries.js')}}"></script>

    <script>
        function img_pathUrl(input) {
            $('#image_service_provider')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
        }

        function img_record(input) {
            $('#image_commercial')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
        }

        function marketing_record(input) {
            $('#image_marketing_agreement')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
        }
    </script>
@endsection
