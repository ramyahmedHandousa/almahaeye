@extends('admin.layouts.master')

@section("title", __("maincp.call_us"))
@section('styles')

    <style>
        .customeStyleSocail{

            margin: 10px auto;

        }
    </style>
@endsection
@section('content')
    <form action="{{ route('administrator.settings.store') }}" data-parsley-validate="" novalidate="" method="post"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-0">
                    <div class="btn-group pull-right m-t-15">
                        <button type="button" class="btn btn-custom  waves-effect waves-light"
                                onclick="window.history.back();return false;"> @lang('maincp.back')<span class="m-l-5"><i
                                        class="fa fa-reply"></i></span>
                        </button>
                    </div>

                </div>
                <h4 class="page-title">الإعدادات العامة</h4>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive  ">

                    <div class="form-group">

                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2">رقم السجل </span>
                                <input class="form-control" type="text" name="commercial_number"
                                       value="{{ $setting->getBody('commercial_number') }}" placeholder="رقم السجل "
                                       maxlength="500" >
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2"> سعر التوصيل   </span>
                                <input class="form-control" type="text" name="delivery_price"
                                       value="{{ $setting->getBody('delivery_price') }}" placeholder=" سعر التوصيل "
                                       maxlength="500" >
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2">الفاكس </span>
                                <input class="form-control" type="text" name="fax"
                                       value="{{ $setting->getBody('fax') }}" placeholder="0123456789"
                                       maxlength="500" >
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2">@lang('maincp.e_mail') </span>
                                <input class="form-control" type="email" name="contactus_email"
                                       value="{{ $setting->getBody('contactus_email') }}" placeholder="Example@Advertisement.sa"
                                       maxlength="500"
                                >
                            </div>
                        </div>


                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-facebook"></i></span>
                                <input type="text" class="form-control" name="faceBook"
                                       value="{{ $setting->getBody('faceBook') }}"
                                       placeholder="@lang('maincp.facebook') "
                                       aria-label="Recipient's username" aria- describedby="basic-addon2"
                                       maxlength="500" >
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-twitter"></i></span>
                                <input type="text" name="twitter"
                                       value="{{ $setting->getBody('twitter') }}" class="form-control"
                                       placeholder="@lang('maincp.twitter') "
                                       aria-label="Recipient's username" aria- describedby="basic-addon2"
                                       maxlength="500" >
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2">
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="whatsapp"
                                       value="{{ $setting->getBody('whatsapp') }}" class="form-control"
                                       placeholder="whatsapp " aria-label="Recipient's username" maxlength="500">
                            </div>
                        </div>

                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-instagram"></i></span>
                                <input type="text" name="instagram"
                                       value="{{ $setting->getBody('instagram') }}" class="form-control"
                                       placeholder="@lang('maincp.instagram')  "
                                       aria-label="Recipient's username" aria- describedby="basic-addon2"
                                       maxlength="500">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-snapchat"></i></span>
                                <input type="text" name="snapchat"
                                       value="{{ $setting->getBody('snapchat') }}" class="form-control"
                                       aria-label="Recipient's username" aria- describedby="basic-addon2"
                                       maxlength="500">
                            </div>
                        </div>


                        <div class="col-lg-6 col-xs-12">
                            <div class="input-group customeStyleSocail">
                                <span class="input-group-addon" id="basic-addon2">@lang('maincp.address') </span>
                                <input class="form-control" type="text" name="address"
                                       value="{{ $setting->getBody('address') }}" placeholder="address"
                                       maxlength="500"
                                >
                            </div>
                        </div>

                        <div class="col-xs-12 text-right">

                            <button type="submit" class="btn btn-warning">
                               @lang('maincp.save_data')   <i style="display: none;" id="spinnerDiv"
                                                class="fa fa-spinner fa-spin"></i>
                            </button>

                        </div>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </form>
@endsection


@section('scripts')
    <script type="text/javascript">

        $("#checkbox_minimum_order").on('change', function() {
            if ($(this).is(':checked')) {
                $("#minimum_order").show();
                $(this).attr('value', 'true');
            } else {
                $("#minimum_order").hide();
                $(".minimum_order").attr('value', 0);
            }
        });

        $('form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);


            var form = $(this);
            form.parsley().validate();

            if (form.parsley().isValid()) {
                $('#spinnerDiv').show();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {

                        messageDisplay( 'نجاح' ,data.message )
                    },
                    error: function (data) {
                    }
                });
            }
        });

        function messageDisplay($title, $message) {
            var shortCutFunction = 'success';
            var msg = $message;
            var title = $title;
            toastr.options = {
                positionClass: 'toast-top-left',
                onclick: null
            };
            $toastlast = toastr[shortCutFunction](msg, title);
        }

    </script>
@endsection







