@extends('admin.layouts.master')

@section('content')


    <form id="myForm" method="POST" action="{{ route('abilities.store') }}" enctype="multipart/form-data" data-parsley-validate
          novalidate>
    @csrf

    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> رجوع <span class="m-l-5"><i
                                class="fa fa-reply"></i></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">إضافة  </h4>

                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="name">master*</label>
                            <select name="parent_id" class="form-control" id="">
                                <option value="" selected>choose</option>
                                @foreach($abilities as $abilitiy)
                                    <option value="{{$abilitiy->id}}">{{$abilitiy->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">إسم*</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                   required placeholder="name  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" name_ar  يجب أن يكون 225 حروف فقط" data-parsley-minLength="1"
                                   data-parsley-minLength-message=" name_ar  يجب أن يكون اكثر من 1 حروف "
                                   data-parsley-required-message="يجب ادخال  name_ar  "
                            />
                            <p class="help-block" id="error_name"></p>
                        </div>
                    </div>


                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                            <label for="title">عنوان  *</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                   required placeholder="name_en  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" name_en  يجب أن يكون 225 حروف فقط" data-parsley-minLength="1"
                                   data-parsley-minLength-message=" name_en  يجب أن يكون اكثر من 1 حروف "
                                   data-parsley-required-message="يجب ادخال  name_en  "
                            />
                            <p class="help-block" id="error_title"></p>
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


        </div>
        <!-- end row -->
    </form>

@stop

