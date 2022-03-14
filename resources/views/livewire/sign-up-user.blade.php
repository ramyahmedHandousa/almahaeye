<section>
    <div class="container">
        <div class="sec-title">
            <h2 class="title">تسجيل عضو جديد</h2>
        </div>
        <form class="row"   wire:submit.prevent="save">

            <div class="col-lg-4 form-group">
                <input type="text"  wire:model.lazy="first_name" class="form-control" placeholder="اسم الاول" required>
                @error('first_name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="col-lg-4 form-group">
                <input type="text"  wire:model.lazy="last_name" class="form-control" placeholder="اسم الأخير" required>
                @error('last_name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="col-lg-4 form-group">
                <input type="text"  wire:model.lazy="email" class="form-control" placeholder="البريد الإلكترونى" required>
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="col-lg-4 form-group">
                <input type="text"  wire:model.lazy="phone" class="form-control" placeholder="رقم الهاتف" required>
                @error('phone') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-4 form-group">
                <input type="password" wire:model.lazy="password" class="form-control" placeholder="كلمة المرور" required>
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-4 form-group">
                <input type="password" wire:model.lazy="confirm_password" class="form-control" placeholder="تأكيد كلمة المرور" required>
                @error('confirm_password') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="col-lg-4 form-group" >
                <select class="form-select" wire:model="country" required>
                    <option value=''>اختار الدولة</option>
                    @foreach($countries as $country)
                        <option value={{ $country->id }}>{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('country') <span class="error">{{ $message }}</span> @enderror
            </div>

            @if(count($subCountries) > 0)
                <div class="col-lg-4 form-group">
                    <select class="form-select" wire:model="subCountry" required>
                        <option value=''>اختار المحافظة</option>
                        @foreach($subCountries as $subCountry)
                            <option value={{ $subCountry->id }}>{{ $subCountry->name }}</option>
                        @endforeach
                    </select>
                    @error('subCountry') <span class="error">{{ $message }}</span> @enderror
                </div>
            @endif
            @if(count($cities) > 0)
                <div class="col-lg-4 form-group">
                    <select class="form-select" wire:model="ciy" required>
                        <option value=''>اختار المدينة</option>
                        @foreach($cities as $city)
                            <option value={{ $city->id }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('ciy') <span class="error">{{ $message }}</span> @enderror
                </div>
            @endif
            @if(count($stats) > 0)
                <div class="col-lg-4 form-group">
                    <select class="form-select" wire:model="country_id" required>
                        <option value=''>اختار الحي</option>
                        @foreach($stats as $stat)
                            <option value={{ $stat->id }}>{{ $stat->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id') <span class="error">{{ $message }}</span> @enderror
                </div>
            @endif


{{--            <div class="col-12" >--}}
{{--                <div class="mb-15"  wire:ignore >--}}
{{--                    <h5>اختر موقعك علي الخريطه</h5>--}}
{{--                    <input   id="pac-input" name="address_search"--}}
{{--                           class="controls " value="{{old('address_search')}}"--}}
{{--                           type="text"   style="z-index: 1; position: absolute;  top: 10px !important;--}}
{{--		    left: 197px; height: 40px;   width: 63%;   border: none;  box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; padding: 0 1em;   color: rgb(86, 86, 86);--}}
{{--		    font-family: Roboto, Arial, sans-serif;   user-select: none;  font-size: 18px;   margin: 10px;"  placeholder="بحث"  >--}}
{{--                    <input type="hidden" name="latitude"  wire:model="latitude" value="{{old('latitude')}}" id="lat"/>--}}
{{--                    <input type="hidden" name="longitude" wire:model="longitude" value="{{old('longitude')}}" id="lng"/>--}}
{{--                    <input type="hidden" name="address"   wire:model="address" value="{{old('address')}}" id="address"/>--}}
{{--                    <div  id="googleMap" width="100%" height="300" style="height: 300px;"></div>--}}
{{--                    @error('latitude') <span class="error">{{ $message }}</span> @enderror--}}
{{--                    @error('longitude') <span class="error">{{ $message }}</span> @enderror--}}
{{--                    @error('address') <span class="error">{{ $message }}</span> @enderror--}}
{{--                </div>--}}
{{--            </div>--}}

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



