@extends('admin.layouts.master')

@section('content')

    <div id="messageError"></div>
    <form data-parsley-validate novalidate method="POST" action="{{ route('administrator.settings.store') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> @lang('maincp.back')<span class="m-l-5"><i
                                    class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">أهداف الموقع     </h4>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">


                    @for($i = 1 ; $i <= 3 ;$i++)

                                <h4 style="margin-bottom: 2%">الآهداف التعرفية رقم {{$i}}</h4>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="userName">إسم الهدف -باللغة العربية*</label>
                                        <input type="text" name="static_name_ar_{{$i}}" parsley-trigger="change" required
                                               placeholder="@lang('maincp.name') ..." class="form-control"
                                               id="userName" value="{{ $setting->getBody('static_name_ar_'.$i) }}"
                                               data-parsley-required-message="هذا الحقل إلزامي">
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="userName">إسم الهدف -باللغة الإنجليزية*</label>
                                        <input type="text" name="static_name_en_{{$i}}" parsley-trigger="change" required
                                               placeholder="@lang('maincp.name') ..." class="form-control"
                                               id="userName" value="{{ $setting->getBody('static_name_en_'.$i) }}"
                                               data-parsley-required-message="هذا الحقل إلزامي">
                                    </div>
                                </div>
                                <div class="col-xs-6" >
                                    <div class="form-group">
                                        <label for="terms_website"> الوصف -  باللغة العربية     </label>
                                        <input type="text" name="static_desc_ar_{{$i}}" parsley-trigger="change" required
                                               placeholder="الوصف -  باللغة العربية ..." class="form-control"
                                               id="userName" value="{{ $setting->getBody('static_desc_ar_'.$i) }}"
                                               data-parsley-required-message="هذا الحقل إلزامي">
                                    </div>
                                </div>
                                <div class="col-xs-6" style="margin-bottom: 5%" >
                                    <div class="form-group">
                                        <label for="terms_website"> الوصف -  باللغة الإنجليزية     </label>
                                        <input type="text" name="static_desc_en_{{$i}}" parsley-trigger="change" required
                                               placeholder="الوصف -  باللغة الإنجليزية..." class="form-control"
                                               id="userName" value="{{ $setting->getBody('static_desc_en_'.$i) }}"
                                               data-parsley-required-message="هذا الحقل إلزامي">
                                    </div>
                                </div>

                    @endfor


                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect waves-light" type="submit"> @lang('maincp.save_data')
                        </button>
                        <button onclick="window.history.back();return false;"
                                class="btn btn-default waves-effect waves-light m-l-5">@lang('maincp.disable')
                        </button>
                    </div>

                </div>
            </div><!-- end col -->


        </div>
        <!-- end row -->
    </form>


@endsection


@section('scripts')
    <script type="text/javascript">

        $('form').on('submit', function (e) {
            e.preventDefault();
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

                        //  $('#messageError').html(data.message);

                        var shortCutFunction = 'success';
                        var msg = data.message;
                        var title = 'نجاح';
                        toastr.options = {
                            positionClass: 'toast-top-left',
                            onclick: null
                        };
                        var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                        $toastlast = $toast;
                        {{--setTimeout(function () {--}}
                        {{--window.location.href = '{{ route('categories.index') }}';--}}
                        {{--}, 3000);--}}
                    },
                    error: function (data) {

                    }
                });
            }
        });

    </script>
@endsection




