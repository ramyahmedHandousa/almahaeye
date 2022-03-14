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
        <select class="form-select" name="country_id" wire:model="country_id" required>
            <option value=''>اختار الحي</option>
            @foreach($stats as $stat)
                <option value={{ $stat->id }}>{{ $stat->name }}</option>
            @endforeach
        </select>
        @error('country_id') <span class="error">{{ $message }}</span> @enderror
    </div>
@endif
