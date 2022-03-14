@extends('admin.layouts.master')
@section('title' , 'إضافة مستخدم')

@section('styles')
    <style>

        .hidden-category{
            visibility: hidden !important;
        }


    </style>
@endsection
@section('content')
    <form id="myForm" method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" data-parsley-validate
          novalidate>
    {{ csrf_field() }}

    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> رجوع <span class="m-l-5"><i
                                    class="fa fa-reply"></i></span>
                    </button>
                </div>
                <h4 class="page-title">إدارة المشاريع</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">إضافة مشروع</h4>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
                            <label for="owner">owner*</label>
                            <input type="text" name="owner" value="{{ old('owner') }}" class="form-control"
                                   required placeholder="owner  ..."
                                   data-parsley-maxLength="225" data-parsley-maxLength-message=" owner  يجب أن يكون 225 حروف فقط"
                                   data-parsley-minLength="3" data-parsley-minLength-message=" owner  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  owner  "

                            />
                            <p class="help-block" id="error_owner"></p>
                        </div>

                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">title*</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                   required placeholder="title  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" title  يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"
                                   data-parsley-minLength-message=" title  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  title  "
                            />
                            <p class="help-block" id="error_title"></p>
                        </div>

                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type">type*</label>
                            <input type="text" name="type" value="{{ old('type') }}" class="form-control"
                                   required  placeholder="type  ..."  data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" type  يجب أن يكون 225 حروف فقط"
                                   data-parsley-minLength="3"  data-parsley-minLength-message="
                                   type  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  type  "
                            />
                            <p class="help-block" id="error_type"></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                            <label for="size">size*</label>
                            <input type="text" name="size" value="{{ old('size') }}" class="form-control"
                                   required placeholder="size  ..."
                                   data-parsley-maxLength="225" data-parsley-maxLength-message=" size  يجب أن يكون 225 حروف فقط"
                                   data-parsley-minLength="3" data-parsley-minLength-message=" size  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  size  "
                            />
                            <p class="help-block" id="error_size"></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('consultants') ? ' has-error' : '' }}">
                            <label for="consultants">consultants*</label>
                            <input type="text" name="consultants" value="{{ old('consultants') }}" class="form-control"
                                   required placeholder="consultants  ..."
                                   data-parsley-maxLength="225" data-parsley-maxLength-message=" consultants  يجب أن يكون 225 حروف فقط"
                                   data-parsley-minLength="3" data-parsley-minLength-message=" consultants  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  consultants  "
                            />
                            <p class="help-block" id="error_consultants"></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('scope_of_work') ? ' has-error' : '' }}">
                            <label for="scope_of_work">scope_of_work*</label>
                            <textarea name="scope_of_work" id="scope_of_work" cols="30" rows="10"
                                      class="form-control" required
                                      data-parsley-required-message="يجب ادخال  scope_of_work  ">{{ old('scope_of_work') }}</textarea>
                            <p class="help-block" id="error_scope_of_work"></p>
                        </div>
                    </div>

                    <div class="form-group text-right m-t-20">
                        <button id="hiddenButton" class="btn btn-primary waves-effect waves-light m-t-20" type="submit">
                            حفظ البيانات
                        </button>
                        <button onclick="window.history.back();return false;" type="reset"
                                class="btn btn-default waves-effect waves-light m-l-5 m-t-20">
                            إلغاء
                        </button>
                    </div>

                </div>
            </div><!-- end col -->

            <div class="col-lg-4">
                <div class="card-box" style="overflow: hidden;">
                    <h4 class="header-title m-t-0 m-b-30">  صورة المشروع الأساسية</h4>
                    <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                        <div class="col-sm-12">
                            <input data-parsley-fileextension='jpg,png' id="image" type="file" required
                                   accept='.jpeg,.png,.jpg' name="image" class="dropify" data-max-file-size="6M"/>
                            @if($errors->has('image'))
                                <p class="help-block">
                                    {{ $errors->first('image') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-box" style="overflow: hidden;">
                    <h4 class="header-title m-t-0 m-b-30">  صور  اخري  </h4>
                    <div class="form-group {{ $errors->has('images.*') ? ' has-error' : '' }}">
                        <div class="col-sm-12">
                            <input data-parsley-fileextension='jpg,png' id="images" type="file"
                                   accept='.jpeg,.png,.jpg' multiple name="images[]" class="dropify"
                                   data-max-file-size="6M"/>
                            @if($errors->has('images.*'))
                                <p class="help-block">
                                    {{ $errors->first('images.*') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </form>
@endsection

@section('scripts')


@endsection
