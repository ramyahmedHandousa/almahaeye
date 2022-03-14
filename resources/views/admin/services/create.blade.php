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
    <form id="myForm" method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" data-parsley-validate
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
                <h4 class="page-title">إدارة الخدمات</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">إضافة خدمة</h4>

                    <div class="col-xs-12">
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
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description">description*</label>
                            <textarea name="description" id="description" cols="30" rows="10"
                                      class="form-control" required
                                      data-parsley-required-message="يجب ادخال  description  ">{{ old('description') }}</textarea>
                            <p class="help-block" id="error_description"></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="description">content*</label>
                            <textarea name="content" id="content" cols="30" rows="10"
                                      class="form-control" required
                                      data-parsley-required-message="يجب ادخال  content  ">{{ old('content') }}</textarea>
                            <p class="help-block" id="error_content"></p>
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
                    <h4 class="header-title m-t-0 m-b-30">  صورة الخدمة الأساسية</h4>
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
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </form>
@endsection

@section('scripts')


@endsection
