@extends('admin.layouts.master')

@section('title' , __('maincp.public_notication'))

@section('styles')

    <link href="{{asset("assets/admin/plugins/multiselect/css/multi-select.css")}}"  rel="stylesheet" type="text/css" />

@endsection
@section('content')

    <form data-parsley-validate novalidate method="POST" action="{{ route('notifications_admin.send_promo_code') }}"
          enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- Page-Title -->
        <div class="row">
            <div class="col-lg-12  ">
                <div class="btn-group pull-right m-t-15">


                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> @lang('maincp.back')<span class="m-l-5"><i
                                class="fa fa-reply"></i></span>
                    </button>


                </div>
                <h4 class="page-title">@lang('maincp.public_notication')</h4>
            </div>



            <div class="col-lg-12   ">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">@lang('maincp.content_notify')</h4>

                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('users') ? ' has-error' : '' }}">
                            <label for="userName">  إختر الفئة المستهدفة من الإشعار*</label>
                            <select name="type" id="" class="form-control requiredField notification_change" required>
                                <option value="" selected disabled=""> يتم إرسال الكود إلي</option>
                                <option value="topic"  > للكل  </option>
                                <option value="all_users"  > لكل المستخدمين   </option>
                                <option value="user"  > لعدد محدود من المستخدمين   </option>
{{--                                <option value="all_agent"  > لكل الوكلاء   </option>--}}
{{--                                <option value="agent"  > لعدد محدود من الوكلاء   </option>--}}
{{--                                <option value="all_deliveries"  > لكل المندوبين   </option>--}}
{{--                                <option value="delivery"  > لعدد محدود من المندوبين   </option>--}}
                            </select>
                            @if($errors->has('users'))
                                <p class="help-block">
                                    {{ $errors->first('users') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="userName">  إختر كود الخصم*</label>
                            <select name="code" id="" class="form-control requiredField code_change" required>
                                <option value="" selected disabled=""> إختر كود الخصم الخاص بي الطلبات</option>
                                @foreach($codes as $code)
                                    <option value="{{$code->code}}"  > {{$code->code}}   </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="userName">@lang('trans.title_notify_arabic') *</label>
                            <input type="text" name="title" parsley-trigger="change" required
                                   placeholder="@lang('trans.title_notify_arabic')..." class="form-control requiredField "
                                   id="userName">
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('notification_message') ? 'has-error' : '' }}">
                        <label for="notification_message">@lang('trans.content_notify_arabic') </label>
                        <textarea  class="form-control requiredField " name="message" required></textarea>
                    </div>


                    <div class="col-lg-12" id="renderHtml">

                    </div>
                    <div class="form-group text-right m-b-0 ">
                        <button class="btn btn-warning waves-effect waves-light m-t-20"
                                type="submit">@lang('maincp.save_data')
                        </button>
                        <button onclick="window.history.back();return false;"
                                class="btn btn-default waves-effect waves-light m-l-5 m-t-20"> @lang('maincp.disable')
                        </button>
                    </div>


                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->
    </form>


@endsection


@section('scripts')

    <script type="text/javascript" src="{{asset('assets/admin/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/admin/plugins/jquery-quicksearch/jquery.quicksearch.js')}}"></script>
    <script>
        $('.notification_change').on('change', function (e) {
            var type  =   $(this).val();

            if (type === "user"||type === "agent"||type === "delivery"){
                $.ajax({
                    type: 'GET',
                    beforeSend: function (){
                        $('.loading').show();
                    },
                    url: "{{ route('notifications_admin.renderUsesData') }}",
                    data: {type : type},
                    datatype:'json',
                    success: function (data) {
                        $('.loading').hide();
                        $("#renderHtml").html(data.html)
                        runSearchMulti();
                    },
                    error: function (data) {
                        $('.loading').hide();
                        errorMessageTostar('نعتذر', data.responseJSON.message)
                    }
                });
            }


        });

        $('.code_change').on('change', function (e) {
            var id  =   $(this).val();
                $.ajax({
                    type: 'GET',
                    beforeSend: function (){
                    },
                    url: "{{ route('notifications_admin.get_promo_code') }}",
                    data: {id : id},
                    datatype:'json',
                    success: function (data) {
                        messageDisplay("أكواد الخصم",data.message)
                    },
                    error: function (data) {
                        $('.loading').hide();
                        errorMessageTostar('نعتذر', data.responseJSON.message)
                    }
                });
        });

        function messageDisplay($title, $message) {
            var shortCutFunction = 'info';
            var msg = $message;
            var title = $title;
            toastr.options = {
                positionClass: 'toast-top-left',
                onclick: null
            };
            $toastlast = toastr[shortCutFunction](msg, title);
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


        function runSearchMulti(){
            $('#my_multi_select3').multiSelect({
                selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='....إختر ...'>",
                selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='...إختر...'>",
                afterInit: function (ms) {
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function (e) {
                            if (e.which === 40) {
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function (e) {
                            if (e.which == 40) {
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
                },
                afterSelect: function () {
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function () {
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });

        }

    </script>


@endsection



