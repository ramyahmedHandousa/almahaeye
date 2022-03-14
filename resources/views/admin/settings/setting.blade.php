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
                <h4 class="page-title">اسماء السلع المحظورة </h4>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> السلع المحظورة</h4>

                    <div class="form-group">
                        <label for="userName">@lang('maincp.name')*</label>
                        <input type="text" name="suspendElement" parsley-trigger="change" required
                               placeholder="@lang('maincp.name') ..." class="form-control"
                               id="userName" value="{{ $setting->getBody('suspendElement') }}"
                               data-parsley-required-message="هذا الحقل إلزامي">
                    </div>





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




