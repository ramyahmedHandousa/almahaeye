@extends('admin.layouts.master')
@section('title', __('maincp.users_manager'))


@section('styles')



@endsection
@section('content')


    <form method="POST" action="{{ route('sliders.update', $slider->id) }}"
          enctype="multipart/form-data"
          data-parsley-validate novalidate>
    {{ csrf_field() }}
    {{ method_field('PUT') }}


    <!-- Page-Title -->
        <div class="row">
            <div class="col-lg-12 ">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> رجوع <span class="m-l-5"><i
                                    class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">إسم {{$pageName}}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 ">
                <div class="card-box">


                    <h4 class="header-title m-t-0 m-b-30">تعديل {{$pageName}}</h4>

                    <div class="row">



                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="usernames">صورة slider *</label>
                                    <input type="hidden" value="{{ $slider->getFirstMediaUrl
                                    ('master_image') }}" name="oldImage"/>
                                    <input type="file" name="image" class="dropify" data-max-file-size="6M"
                                           data-default-file="{{ $slider->getFirstMediaUrl('master_image') }}"/>
                                </div>
                            </div>
                        <!-- end col -->
                    </div>


                    <div class="form-group text-right m-t-20">
                        <button class="btn btn-warning waves-effect waves-light m-t-20" type="submit">
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

    <script type="text/javascript">
        function validImages() {

            var images = $( "input[name='image']" ).val();
            var oldImage = $( "input[name='oldImage']" ).val();

            if ( (images === undefined || images === "" ) && (oldImage === undefined || oldImage === "")   ) {
                var shortCutFunction = 'error';
                var msg = 'من فضلك إختار   صورة واحدة علي الأقل  ';
                var title = 'نجاح';
                toastr.options = {
                    positionClass: 'toast-top-left',
                    preventDuplicates: true,
                    onclick: null
                };
                var $toast = toastr[shortCutFunction](msg, title);
                $toastlast = $toast;
                return false;
            }

            return true;
        }

        // $('form').on('submit', function (e) {
        //
        //     e.preventDefault();
        //
        //     var formData = new FormData(this);
        //
        //     var form = $(this);
        //
        //     form.parsley().validate();
        //
        //     if (form.parsley().isValid() && validImages()){
        //     // if (form.parsley().isValid() ){
        //         $('.loading').show();
        //
        //         $.ajax({
        //             type: 'POST',
        //             url: $(this).attr('action'),
        //             data: formData,
        //             cache: false,
        //             contentType: false,
        //             processData: false,
        //             success: function (data) {
        //
        //                 $('.loading').hide();
        //                 messageDisplay( 'نجاح' , data.message);
        //
        //                 setTimeout(function () {
        //                     window.location.href = data.url;
        //                 }, 2000);
        //             },
        //             error: function (data) {
        //
        //                 $('.loading').hide();
        //                 errorMessageTostar('فشل',data.responseJSON.error[0]);
        //             }
        //         });
        //
        //     }
        //
        //
        // });

        function messageDisplay($title, $message) {
            var shortCutFunction = 'success';
            var msg = $message;
            var title = $title;
            toastr.options = {
                positionClass: 'toast-top-left',
                onclick: null
            };
            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
            $toastlast = $toast;
        }

        function errorMessageTostar($title, $message) {
            var shortCutFunction = 'error';
            var msg = $message;
            var title = $title;
            toastr.options = {
                positionClass: 'toast-top-left',
                onclick: null
            };
            var $toast = toastr[shortCutFunction](msg, title);
            $toastlast = $toast;
        }

    </script>
@endsection
