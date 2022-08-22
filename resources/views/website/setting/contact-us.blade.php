@extends('website.layouts.master')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="title">{{trans('website.setting.contact_us.how_can_help')}}</div>
                    <div class="sub-title"> {{trans('website.setting.contact_us.contact_text')}}</div>
                    <div class="contact-form">
                        <form method="post" action="{{route('send.contact.us')}}" id="submit-contact-us">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>      :{{trans('website.setting.contact_us.full_time')}}</label>
                                <input type="text" name="name" class="form-control form-control2" placeholder="{{trans('website.setting.contact_us.full_time')}}"  >
                            </div>
                            <div class="form-group">
                                <label>{{trans('website.setting.contact_us.mobile')}}      :</label>
                                <input type="text" name="phone" class="form-control form-control2" placeholder="{{trans('website.setting.contact_us.mobile')}}" required>
                            </div>
                            <div class="form-group">
                                <label>          :{{trans('website.setting.contact_us.email')}}</label>
                                <input type="email" name="email" class="form-control form-control2" placeholder="{{trans('website.setting.contact_us.email')}}" required>
                            </div>
                            <div class="form-group">
                                <label>   :{{trans('website.setting.contact_us.message')}}</label>
                                <textarea class="form-control form-control2" name="message" rows="5" placeholder="  {{trans('website.setting.contact_us.message')}} " required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="button-contact-us"  class="btn the-btn-2 btn-block btn-larg">{{trans('website.setting.contact_us.send')}} </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="title">  {{trans('website.setting.contact_us.contact')}}</div>
                    <div class="sub-title"> {{trans('website.setting.contact_us.contact_text')}}</div>
                    <ul class="list-group">
                        <li>
                            <span>{{trans('website.setting.contact_us.e_mail')}}   </span>
                            <span>almahaeye@gamil.com</span>
                        </li>
                        <li>
                            <span> {{trans('website.setting.contact_us.hotline')}}</span>
                            <span>+98888377261</span>
                        </li>
                        <li>
                            <span>{{trans('website.setting.contact_us.fax')}}   </span>
                            <span>+98888377261</span>
                        </li>
                        <li>
                            <span> {{trans('website.setting.contact_us.address')}}</span>
                            <span>السعودية - دمام - شارع فلان ابن فلان</span>
                        </li>
                        <li>
                            <span> {{trans('website.setting.contact_us.whatsapp')}}</span>
                            <span>+98888377261</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>
        $('#submit-contact-us').on('submit',() => $("#button-contact-us").hide());
    </script>
@endsection


