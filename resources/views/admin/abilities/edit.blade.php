@extends('admin.layouts.master')

@section('content')

    <form method="POST" action="{{ route('abilities.update', $ability->id) }} }}"
          enctype="multipart/form-data"
          data-parsley-validate novalidate>
    @csrf
    {{ method_field('PUT') }}


    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12 col-sm-offset-2" >
                <div class="btn-group pull-right m-t-15">
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 " >
                <div class="card-box">


                    <h4 class="header-title m-t-0 m-b-30">تعديل بيانات  </h4>


                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">إسم بالعربي*</label>
                            <input type="text" name="name" value="{{ $ability->name }}"
                                   class="form-control"
                                   required placeholder="name  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message="    يجب أن يكون 225 حروف فقط" data-parsley-minLength="1"
                                   data-parsley-minLength-message="    يجب أن يكون اكثر من 1 حروف "
                                   data-parsley-required-message="يجب ادخال  name_ar  "
                            />
                            <p class="help-block" id="error_name"></p>
                        </div>

                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">إسم بالإنجليزي*</label>
                            <input type="text" name="title" value="{{ $ability?->title }}"
                                   class="form-control"
                                   required placeholder="title  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message="    يجب أن يكون 225 حروف فقط" data-parsley-minLength="1"
                                   data-parsley-minLength-message="    يجب أن يكون اكثر من 1 حروف "
                                   data-parsley-required-message="يجب ادخال  name_en  "
                            />
                            <p class="help-block" id="error_title"></p>
                        </div>

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

@stop

