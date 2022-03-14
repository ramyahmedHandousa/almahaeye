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
            <div class="col-md-8">
                <div class="card-box">

                    <div class="col-xs-6">
                        <div class="form-group {{ $errors->has('about_us') ? 'has-error' : '' }}">
                            <label for="about_us_en">ABOUT COMPANY    </label>
                            <textarea   class="form-control msg_body" cols="30" rows="10" required
                                      name="about_us">{{ $setting->getBody('about_us') }}</textarea>
                        </div>
                    </div>


                    <div class="col-xs-6">
                        <div class="form-group {{ $errors->has('our_mission') ? 'has-error' : '' }}">
                            <label for="about_us_ar">WHAT WE DO   </label>
                            <textarea class="form-control msg_body" cols="30" rows="10" required
                                      name="our_mission">{{ $setting->getBody('our_mission') }}</textarea>
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
            <div class="col-md-4">

                <div class="card-box" style="overflow: hidden;">
                    <h4 class="header-title m-t-0 m-b-30">  Photo ABOUT COMPANY </h4>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="file" name="about_app_image" class="dropify" data-max-file-size="6M"
                                   data-default-file="{{asset($setting->getBody
                                   ('about_app_image'))}}"
                            />
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->
    </form>
@endsection


@section('scripts')
 <script type="text/javascript"
            src="{{ request()->root() }}/public/assets/admin/js/validate-{{ config('app.locale') }}.js"></script>
<script>

</script>

@endsection




