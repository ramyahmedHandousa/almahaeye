@extends('admin.layouts.master')

@section('title' , __('maincp.add_roles'))


@section('styles')


    <style>
        #parsley-id-multiple-abilities li {
            position: absolute;
            top: -22px;
            right: 80px;
        }
    </style>

@endsection

@section('content')
    <form method="POST" action="{{ route('roles.store')  }}" enctype="multipart/form-data" data-parsley-validate
          novalidate>
    @csrf




    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">


                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> @lang('maincp.back')
                    </button>


                </div>
                <h4 class="page-title">@lang('maincp.add_roles')</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">

                    <h4 class="header-title m-t-0 m-b-30">@lang('maincp.add_roles')</h4>

                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="userName"> @lang('trans.titleArabic')*</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   class="form-control requiredFieldWithMaxLenght"
                                   required
                                   placeholder="@lang('trans.titleArabic')..."/>
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('title'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('title') }}
                                </p>
                            @endif
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xs-12">
                            <label for="passWord2">@lang('maincp.permission') *</label>
                            <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                                <ul style="list-style-type: none;">


                                    @if (is_array($abilities) || is_object($abilities))

                                        @foreach($abilities as $ability)

                                            <li style="width: 23%; float: right; background: #f9f9f9;  min-height: 190px; margin-left: 10px; margin-bottom: 10px;font-size: 20px ">



                                                    <input type="checkbox" name="main_abilities[]"  value="{{ $ability->id }}"
                                                           id="{{ $ability->name }}">

                                                    <label for="{{ $ability->name }}">{{ $ability->title }}</label>



                                                @if (count(array($ability->children)) > 0)

                                                    <ul style="list-style-type: none; padding-right: 1.5em;">

                                                        @foreach($ability->children  as $key =>$child)

                                                            <li style="font-size: 14px;">
                                                                <input type="checkbox"   name="sub_abilities[]"
                                                                       value="{{ $child->id }}"
                                                                       id="{{ $child->name }}-{{ $key }}">
                                                                <label for="{{ $child->name }}-{{ $key }}">{{ $child->title }}</label>

                                                            </li>
                                                        @endforeach


                                                    </ul>

                                                @endif
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>



                            </div>
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


    <script>

        @if(session()->has('error'))
        setTimeout(function () {
            showMessage('{{ session()->get('error') }}');
        }, 3000);

        @endif

        function showMessage(message) {

            var shortCutFunction = 'error';
            var msg = message;
            var title = 'خطأ!';
            toastr.options = {
                positionClass: 'toast-top-center',
                onclick: null,
                showMethod: 'slideDown',
                hideMethod: "slideUp",
            };
            var $toast = toastr[shortCutFunction](msg, title);
            // Wire up an event handler to a button in the toast, if it exists
            $toastlast = $toast;


        }


    </script>

    <script src="{{asset('assets/admin/js/cbFamily.js')}}"></script>
    <script type="text/javascript"  >
        $("h4 input:checkbox").cbFamily(function (){
            return $(this).parents("h4").next().find("input:checkbox");
        });

    </script>

    <script type="text/javascript"
            src="{{ request()->root() }}/assets/admin/js/validate-{{ config('app.locale') }}.js"></script>


@endsection
