@extends('admin.layouts.master')

@section('title' ,  __('maincp.notification'))

@section('content')
    <!-- Page-Title -->
    <form method="POST" action="{{ route('send_public_notification') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> @lang('maincp.back')<span class="m-l-5"><i
                                class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">@lang('maincp.notification')  </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">@lang('maincp.notification') </h4>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName"> العنوان بالعربية* </label>
                            <input type="text" name="title"  value="{{ old('title') }}" class="form-control" required
                                   placeholder=" العنوان بالعربية "
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message=" العنوان بالعربية إلزامي"
                                   data-parsley-maxlength="200"
                                   data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (200) حرف"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="اقل عدد حروف مسموح به هو 3 حروف"/>
                            @if($errors->has('title'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('title') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName"> العنوان بالانجليزية* </label>
                            <input type="text" name="title_en"  value="{{ old('title_en') }}" class="form-control" required
                                   placeholder=" العنوان بالانجليزية "
                                   data-parsley-trigger="keyup"
                                   data-parsley-required-message=" العنوان بالانجليزية إلزامي"
                                   data-parsley-maxlength="200"
                                   data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (200) حرف"
                                   data-parsley-minlength="3"
                                   data-parsley-minlength-message="اقل عدد حروف مسموح به هو 3 حروف"/>
                            @if($errors->has('title_en'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('title_en') }}
                                </p>
                            @endif
                        </div>
                    </div>



                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="userName"> الرسالة بالعربية* </label>
                            <textarea name="body"  class="form-control" required
                                      placeholder=" الرسالة بالعربية "
                                      data-parsley-trigger="keyup"
                                      data-parsley-required-message=" الرسالة بالعربية إلزامي"
                                      data-parsley-maxlength="250"
                                      data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (250) حرف"
                                      data-parsley-minlength="3"
                                      data-parsley-minlength-message="اقل عدد حروف مسموح به هو 3 حروف">{{ old('body') }}</textarea>
                            @if($errors->has('body'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('body') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="userName"> الرسالة بالانجليزية* </label>
                            <textarea name="body_en"  class="form-control" required
                                      placeholder=" الرسالة بالانجليزية "
                                      data-parsley-trigger="keyup"
                                      data-parsley-required-message=" الرسالة بالانجليزية إلزامي"
                                      data-parsley-maxlength="250"
                                      data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (250) حرف"
                                      data-parsley-minlength="3"
                                      data-parsley-minlength-message="اقل عدد حروف مسموح به هو 3 حروف">{{ old('body_en') }}</textarea>
                            @if($errors->has('body_en'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('body_en') }}
                                </p>
                            @endif
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <div class="form-group text-right m-b-0 ">
                            <button class="btn btn-primary waves-effect waves-light m-t-20" type="submit">ارسال</button>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div><!-- end col -->
        </div>
    </form>
    <!-- end row -->
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#datatable-fixed-header-notify').DataTable({
                fixedHeader: true,
                "order": [[4, "desc"]],
                // columnDefs: [{orderable: false, targets: [0]}],
                "language": {
                    "lengthMenu": "@lang('maincp.show') _MENU_ @lang('maincp.perpage')",
                    "info": "@lang('maincp.show') @lang('maincp.perpage') _PAGE_ @lang('maincp.from')_PAGES_",
                    "infoEmpty": "@lang('maincp.no_recorded_data_available')",
                    "infoFiltered": "(@lang('maincp.filter_from_max_total') _MAX_)",
                    "paginate": {
                        "first": "@lang('maincp.first')",
                        "last": "@lang('maincp.last')",
                        "next": "@lang('maincp.next')",
                        "previous": "@lang('maincp.previous')"
                    },
                    "search": "@lang('maincp.search'):",
                    "zeroRecords": "@lang('maincp.no_recorded_data_available')",
                },
            });
        });
    </script>

@endsection



