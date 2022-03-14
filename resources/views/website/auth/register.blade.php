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
                <h2 class="title">تسجيل عضو جديد</h2>
            </div>
            <form class="row" method="post" action="{{route('register-user')}}">

                @csrf
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
                        <option value=''>اختار المحافظة</option>
                    </select>
                </div>

                <div class="col-lg-4 form-group">
                    <select class="form-select" id="city" required>
                        <option value=''>اختار المدينة</option>
                    </select>
                </div>

                <div class="col-lg-4 form-group">
                    <select class="form-select" name="country_id"  id="state"  required>
                        <option value=''>اختار الحي</option>
                    </select>

                    @error('country_id') <span class="error">{{ $message }}</span> @enderror
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


    <script>
        function initAutocomplete() {

            map = new google.maps.Map(document.getElementById('googleMap'), {

                // center: {lat:  window.lat   , lng:  window.lng   },
                center: {lat: 24.774265, lng: 46.738586},
                zoom: 15,
                mapTypeId: 'roadmap'
            });


            var marker;
            google.maps.event.addListener(map, 'click', function (event) {

                map.setZoom();
                var mylocation = event.latLng;
                map.setCenter(mylocation);


                $('#lat').val(event.latLng.lat());
                $('#lng').val(event.latLng.lng());



                codeLatLng(event.latLng.lat(), event.latLng.lng());

                setTimeout(function () {
                    if (!marker)
                        marker = new google.maps.Marker({position: mylocation, map: map});
                    else
                        marker.setPosition(mylocation);
                }, 600);

            });


            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });


            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();
                // var location = place.geometry.location;
                // var lat = location.lat();
                // var lng = location.lng();
                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];


                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                    $('#lat').val(place.geometry.location.lat());
                    $('#lng').val(place.geometry.location.lng());
                    $('#address').val(place.formatted_address);


                });


                map.fitBounds(bounds);
            });


        }


        function showPosition(position) {

            map.setCenter({lat: position.coords.latitude, lng: position.coords.longitude});
            codeLatLng(position.coords.latitude, position.coords.longitude);


        }


        function codeLatLng(lat, lng) {

            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({
                'latLng': latlng
            }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        // console.log(results[1].formatted_address);
                        $("#demo").html(results[1].formatted_address);

                        $("#address").val(results[1].formatted_address);
                        $("#map").val(results[1].formatted_address);
                        $("#pac-input").val(results[1].formatted_address);

                        $('.alert').addClass('fade');





                    } else {
                    }
                } else {
                    alert('Geocoder failed due to: ' + status);
                }
            });
        }
    </script>
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&amp;callback=initAutocomplete&libraries=places">
    </script>


    <script>
        $('#country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: '{{ route('countries-data') }}',
                    data: {countryID: countryID},
                    dataType: 'json',
                    success: function (res) {
                        if (res) {
                            $.each(res, function (key, value) {
                                $("#city").empty().append('<option value="" selected disabled>اختار  المدينه </option>');
                                $("#state").empty().append('<option value="" selected disabled>اختار  الحى </option>');
                                $("#region").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    }
                });
            }
        });
        $('#region').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: '{{ route('countries-data') }}',
                    data: {countryID: countryID},
                    dataType: 'json',
                    success: function (res) {
                        if (res) {
                            $.each(res, function (key, value) {
                                $("#city").empty().append('<option value="" selected disabled>اختار  المدينه </option>');
                                $("#state").empty().append('<option value="" selected disabled>اختار  الحى </option>');
                                $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    }
                });
            }
        });
        $('#city').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: '{{ route('countries-data') }}',
                    data: {countryID: countryID},
                    dataType: 'json',
                    success: function (res) {
                        if (res) {
                            $.each(res, function (key, value) {
                                $("#state").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    }
                });
            }
        });
    </script>
@endsection
