@extends('admin.layouts.master')

@section('styles')


    <style>
        #parsley-id-multiple-abilities li{
            position: absolute;
            top: -22px;
            right: 80px;
        }
    </style>

@endsection


@section('content')
    <form method="POST" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data"
          data-parsley-validate novalidate>

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12" >
                <div class="btn-group pull-right m-t-15">
                    <a href="{{ route('roles.index') }}" type="button" class="btn btn-custom waves-effect waves-light"
                       aria-expanded="false">@lang('maincp.view_the_roles')
                        <span class="m-l-5">
                        <i class="fa fa-reply"></i>
                    </span>
                    </a>
                </div>
                <h4 class="page-title">الأدوار</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12" >
                <div class="card-box">


                    <div id="errorsHere"></div>
                    <div class="dropdown pull-right">


                    </div>

                    <h4 class="header-title m-t-0 m-b-30">@lang('maincp.edit_roles')</h4>


                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="userName"> @lang('trans.titleArabic')*</label>
                            <input type="text" name="title" value="{{ $role->title}}" class="form-control requiredFieldWithMaxLenght"
                                   required data-parsley-trigger="keyup"
                                   placeholder="@lang('trans.titleArabic')..."/>
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('title'))
                                <p class="help-block validationStyle">
                                    {{ $errors->first('title') }}
                                </p>
                            @endif
                        </div>

                    </div>



                    <div class="col-xs-12">
                        <label for="passWord2">@lang('maincp.permission') *</label>
                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                            <ul style="list-style-type: none;">
                                @if (is_array($abilities) || is_object($abilities))
                                    @foreach($abilities as  $ability)
                                        <li style="width: 32%; min-height: 190px; float: right; background: #f9f9f9; margin-left: 5px; margin-bottom: 10px; ">


                                                <input type="checkbox" {{ collect($role->abilities->pluck('id'))->contains($ability->id)  ? "checked" : ""}}
                                                name="main_abilities[]" data-id="{{$ability->id}}"  value="{{ $ability->id }}" id="{{ $ability->name }}">
                                                <label for="{{ $ability->name }}">{{ $ability->title }}</label>

                                             
                                            <ul style="list-style-type: none; padding-right: 1.5em;">
                                                @if($ability->children)
                                                    @foreach($ability->children  as $key =>$child)

                                                        <li style="font-size: 14px;">
                                                            <input type="checkbox" {{ collect($role->abilities->pluck('id'))->contains($child->id)  ? "checked" : ""}}
                                                                name="sub_abilities[]" class="select-my-{{$ability->id}}" value="{{ $child->id }}" id="{{ $child->name }}-{{ $key }}">
                                                            <label for="{{ $child->name }}-{{ $key }}">{{ $child->title }}</label>
                                                        </li>

                                                    @endforeach
                                                @endif

                                            </ul>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>

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
            src="{{ request()->root() }}/assets/admin/js/validate-{{ config('app.locale') }}.js"></script>



 <script src="{{asset('assets/admin/js/cbFamily.js')}}"></script>
 <script type="text/javascript"  >
     $("h4 input:checkbox").cbFamily(function (){
         return $(this).parents("h4").next().find("input:checkbox");
     });

 </script>
@endsection


