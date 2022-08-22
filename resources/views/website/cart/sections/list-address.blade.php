<div class="title cart-list-address" style="display: none">  {{trans('website.address.choose_address')}}   </div>

<div class="col-lg-8 cart-list-address"  style="display: none">
    <div class="box">
        <div >
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    @if(auth()->user()?->address)
                        @foreach(auth()->user()?->address as $address)
                            <tr>
                                <td>
                                    <input class="form-check-input cart-choose-address" name="address" type="radio" value="{{$address->id}}">
                                </td>
                                <td>{{$address->address}}</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>

            <a href="{{route('addresses.create')}}" target="_blank"><h5 class="sub-title">{{trans('website.address.add_address')}}  </h5></a>

        </div>
    </div>
</div>
