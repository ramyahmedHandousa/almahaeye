@extends('admin.layouts.master')
@section('title' ,__('maincp.about_us'))
@section('content')
    <form action="{{ route('administrator.settings.store') }}" data-parsley-validate="" novalidate="" method="post"
          enctype="multipart/form-data">

    {{ csrf_field() }}

    <!-- Page-Title -->

        <div class="row">
            <div class="col-sm-12 ">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> @lang('maincp.back')<span class="m-l-5"><i
                                    class="fa fa-reply"></i></span>
                    </button>

                </div>
                <h4 class="page-title">@lang('maincp.data_about_the_application') </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="col-xs-6">
                        <div class="col-lg-10 col-xs-12">
                            <label>عمولة التطبيق </label>
                            <input class="form-control number" type="number" style="margin: 15px auto" name="taxs"
                                   value="{{ $setting->getBody('taxs') }}" placeholder="العمولة"
                                   maxlength="500" >
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group {{ $errors->has('taxs_text') ? 'has-error' : '' }}">
                            <label for="taxs"> نص عمولة التطبيق  </label>
                            <textarea   class="form-control msg_body" required
                                      name="taxs_text">{{ $setting->getBody('taxs_text') }}</textarea>
                        </div>
                    </div>

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
    <script type="text/javascript"
            src="{{ request()->root() }}/public/assets/admin/js/validate-{{ config('app.locale') }}.js"></script>
    <script>


        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');

    </script>

@endsection




