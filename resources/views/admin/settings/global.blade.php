@extends('admin.layouts.master')
@section('title' ,__('maincp.use_Treaty'))
@section('styles')



@endsection
@section('content')

    <div class="se-pre-con"></div>

    <form action="{{ route('administrator.settings.store') }}" data-parsley-validate="" novalidate="" method="post"
          enctype="multipart/form-data">

    {{ csrf_field() }}

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2" >
                <div class="btn-group pull-right m-t-15">
                </div>
{{--                <h4 class="page-title">@lang('trans.terms')   </h4>--}}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" >
                <div class="card-box">




                    @foreach (config('translatable.locales') as $locale => $value)
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="terms_website"> سياسة الخصوصية - {{ $value }} </label>
                                <textarea  rows="10" class="form-control msg_body" name="privacy_{{ $value }}">{{ $setting->getBody('privacy_'.$value) }}</textarea>
                            </div>
                        </div>
                    @endforeach
                    @foreach (config('translatable.locales') as $locale => $value)
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="about_app_desc">محتوي الموقع باللغة - {{ $value }} </label>
                                    <textarea  rows="10" class="form-control msg_body" name="about_app_{{ $value }}">{{ $setting->getBody('about_app_'.$value) }}</textarea>
                                </div>
                            </div>
                    @endforeach
                    @foreach (config('translatable.locales') as $locale => $value)
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="about"> عن المطور باللغة - {{ $value }} </label>
                                    <textarea   rows="10" class="form-control msg_body" name="developer_{{ $value }}">{{ $setting->getBody('developer_'.$value) }}</textarea>
                                </div>
                            </div>
                    @endforeach
                    @foreach (config('translatable.locales') as $locale => $value)
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="terms_website">شروط الاستخدام - {{ $value }} </label>
                                    <textarea   rows="10" class="form-control msg_body" name="terms_{{ $value }}">{{ $setting->getBody('terms_'.$value) }}</textarea>
                                </div>
                            </div>
                    @endforeach
                    @foreach (config('translatable.locales') as $locale => $value)
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="terms_website">وصف الموقع - {{ $value }} </label>
                                    <textarea  rows="10" class="form-control msg_body" name="website_description_{{ $value }}">{{ $setting->getBody('website_description_'.$value) }}</textarea>
                                </div>
                            </div>
                    @endforeach


                    <div class="form-group text-right m-t-20">
                        <button class="btn btn-primary waves-effect waves-light m-t-20" type="submit" id="btnSubmit">
                            @lang('maincp.save_data')
                        </button>
                        <button onclick="window.history.back();return false;" type="reset"
                                class="btn btn-default waves-effect waves-light m-l-5 m-t-20">
                            @lang('maincp.disable')
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <!-- end row -->
    </form>
@endsection


@section('scripts')


    <script type="text/javascript">

        $('form').on('submit', function (e) {
            e.preventDefault();

            $("#btnSubmit").html("جاري حفظ البيانات...");

            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();


            var formData = new FormData(this);


            var form = $(this);
            form.parsley().validate();

            if (form.parsley().isValid()) {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {


                        if (data.status == true) {
                            $("#btnSubmit").html("حفظ البيانات");
                            var shortCutFunction = 'success';

                            var msg = data.message;
                            var title = 'نجاح';
                            toastr.options = {
                                maxOpened: 1,
                                preventDuplicates: 1,
                                positionClass: 'toast-top-left',
                                onclick: null
                            };
                            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                            $toastlast = $toast;
                        }

                    },
                    error: function (data) {

                    }
                });
            } else {
                $("#btnSubmit").html("حفظ البيانات");
            }

        });
    </script>


@endsection

