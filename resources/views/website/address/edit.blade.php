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

    <div class="container">
        <div class="sec-title">
            <h2 class="title">إنشاء عنوان جديد</h2>
        </div>
        <div class="row">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-lg-12">
                <form class="row" method="post" action="{{ route('addresses.update',$address->id) }}" enctype="multipart/form-data" >
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="col-12 form-group">
                        <input type="text" value='{{$address->notes}}' class="form-control" name="notes" placeholder="أضف ملاحظة">
                    </div>

                    <div class="col-12" >
                        <div class="mb-15" >
                            <h5>اختر موقعك علي الخريطه</h5>
                            <input   id="pac-input" name="address_search" required
                                     class="controls mapSearchLocation" value="{{$address->address}}"
                                     type="text"    placeholder="بحث"  >
                            <input type="hidden" name="latitude"  value="{{$address->latitude}}" id="lat"/>
                            <input type="hidden" name="longitude" value="{{$address->longitude}}" id="lng"/>
                            <input type="hidden" name="address"   value="{{$address->address}}" id="address"/>
                            <div  id="googleMap" width="100%" height="300" style="height: 300px;"></div>
                            @error('latitude') <span class="error">{{ $message }}</span> @enderror
                            @error('longitude') <span class="error">{{ $message }}</span> @enderror
                            @error('address') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 10px; margin-bottom: 5px;">
                        <div class="row submit-row">
                            <div class="col-lg-3 order2">
                                <a class="btn btn-gray" href="{{route('addresses.index')}}">الغاء</a>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn">حفظ</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

    <script src="{{asset('website/templates/js/mapLocation.js')}}"></script>

    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&amp;callback=initAutocomplete&language={{app()->getLocale()}}&libraries=places">
    </script>
@endsection
