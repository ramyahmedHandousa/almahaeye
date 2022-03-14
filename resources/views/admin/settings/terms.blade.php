@extends('admin.layouts.master')
@section('title' ,__('maincp.use_Treaty'))

@section('content')
    <form action="{{ route('administrator.settings.store') }}" data-parsley-validate novalidate method="post"
          enctype="multipart/form-data">

    {{ csrf_field() }}


        <div class="row">
            <div class="col-sm-12 " >
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> @lang('maincp.back')<span class="m-l-5"><i
                                    class="fa fa-reply"></i></span>
                    </button>

                </div>
                <h4 class="page-title">@lang('trans.terms')   </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 " >
                <div class="card-box">


                    {{--<h4 class="header-title m-t-0 m-b-30">@lang('trans.terms') </h4>--}}


                    <h2 class="text-center">اللغة العربية</h2><br>
                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('terms_user_ar') ? 'has-error' : '' }}">
                            <label for="terms_clients">النص    </label>
                            <textarea id="editor" class="msg_body requiredField" required
                                      name="terms_user_ar">
                                {{ $setting->getBody('terms_user_ar' ) }}
                            </textarea>
                        </div>
                    </div>

{{--                    <div class="col-xs-6">--}}
{{--                        <div class="form-group {{ $errors->has('terms_user1_ar') ? 'has-error' : '' }}">--}}
{{--                            <label for="terms_clients">النص الثاني </label>--}}
{{--                            <textarea id="editor1" class="msg_body requiredField" required--}}
{{--                                      name="terms_user1_ar">--}}
{{--                                {{ $setting->getBody('terms_user1_ar' ) }}--}}
{{--                            </textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <h2 class="text-center">اللغة الإنجليزية</h2><br>

                    <div class="col-xs-12">
                        <div class="form-group {{ $errors->has('terms_user_en') ? 'has-error' : '' }}">
                            <label for="terms_clients">النص   </label>
                            <textarea id="editor1" class="msg_body requiredField" required
                                      name="terms_user_en">
                                {{ $setting->getBody('terms_user_en' ) }}
                            </textarea>
                        </div>
                    </div>

{{--                    <div class="col-xs-6">--}}
{{--                        <div class="form-group {{ $errors->has('terms_user1_en') ? 'has-error' : '' }}">--}}
{{--                            <label for="terms_clients">النص الثاني </label>--}}
{{--                            <textarea id="editor3" class="msg_body requiredField" required--}}
{{--                                      name="terms_user1_en">--}}
{{--                                {{ $setting->getBody('terms_user1_en' ) }}--}}
{{--                            </textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="form-group text-right m-t-20">
                        <button class="btn btn-primary waves-effect waves-light m-t-20" type="submit">
                           @lang('maincp.save_data')
                        </button>
                        <button onclick="window.history.back();return false;" type="reset"
                                class="btn btn-default waves-effect waves-light m-l-5 m-t-20">
                           @lang('maincp.disable')
                        </button>
                    </div>

                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->
    </form>
@endsection


@section('scripts')

    <script>


        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');

    </script>

@endsection

