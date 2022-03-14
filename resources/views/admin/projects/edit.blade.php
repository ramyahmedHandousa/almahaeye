@extends('admin.layouts.master')
@section('title', __('maincp.users_manager'))



@section('styles')


    <style>
        #parsley-id-multiple-roles li{
            position: absolute;
            top: -22px;
            right: 80px;
        }
    </style>

@endsection

@section('content')


    <form method="POST" action="{{ route('projects.update', $project->id) }}"
          enctype="multipart/form-data"
          data-parsley-validate novalidate>
    {{ csrf_field() }}
    {{ method_field('PUT') }}



    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12 col-sm-offset-2" >
                <div class="btn-group pull-right m-t-15">
                   {{--  <a href="{{ route('users.create') }}" type="button" class="btn btn-custom waves-effect waves-light"
                       aria-expanded="false"> @lang('maincp.add')
                        <span class="m-l-5">
                        <i class="fa fa-plus"></i>
                    </span>
                    </a> --}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="col-md-4">

                    <div class="card-box" style="overflow: hidden;">
                        <h4 class="header-title m-t-0 m-b-30">الصورة الرئيسية</h4>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="file" name="image" class="dropify" data-max-file-size="6M"
                                       data-default-file="{{$project->getFirstMediaUrl
                                        ('master_image','thumb')}}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                <div class="card-box" style="overflow: hidden;">
                    <h4 class="header-title m-t-0 m-b-30">  صور  اخري  </h4>
                    <div class="form-group {{ $errors->has('images.*') ? ' has-error' : '' }}">
                        <div class="col-sm-12">
                            @if(count($images) > 0)

                                @foreach($images as  $image)
                                    <div class="col-md-3">

                                        <input data-parsley-fileextension='jpg,png' id="images" multiple type="file"
                                               accept='.jpeg,.png,.jpg' name="images[{{$image->id}}]"
                                               class="dropify"
                                               data-default-file="{{ asset($image->getUrl()) }}"
                                               data-max-file-size="6M"/>
                                    </div>
                                @endforeach
                                @if(count($images) < 4)
                                        @for($i=0;$i < 4 - count($images);$i++)
                                            <div class="col-md-3">
                                                <input data-parsley-fileextension='jpg,png' id="images" type="file"
                                                       accept='.jpeg,.png,.jpg' name="images[]" class="dropify"
                                                       data-max-file-size="6M"/>
                                            </div>
                                        @endfor
                                @endif
                            @else

                                @for($i=0;$i < 4;$i++)
                                    <div class="col-md-3">
                                        <input data-parsley-fileextension='jpg,png' id="images" type="file"
                                               accept='.jpeg,.png,.jpg' name="images[]" class="dropify"
                                               data-max-file-size="6M"/>
                                    </div>
                                @endfor
                            @endif


                            @if($errors->has('images.*'))
                                <p class="help-block">
                                    {{ $errors->first('images.*') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-12 " >
                <div class="card-box">


                    <h4 class="header-title m-t-0 m-b-30">تعديل بيانات المشروع</h4>


                    <div class="col-xs-1">
                        <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                            <label for="owner">order*</label>
                            <select   class="form-control" name="order" id="order">
                                <option value="">select</option>
                                @for($i = 1 ;$i <= 8 ; $i++)
                                    <option value="{{$i}}"
                                            @if($project->order == $i) selected @endIf
                                    >{{$i}}</option>
                                @endfor
                            </select>
                            <p class="help-block" id="error_owner"></p>
                        </div>

                    </div>

                    <div class="col-xs-3">
                        <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
                            <label for="owner">owner*</label>
                            <input type="text" name="owner" value="{{ $project->owner }}"
                                   class="form-control"
                                   required placeholder="owner  ..."
                                   data-parsley-maxLength="225" data-parsley-maxLength-message=" owner  يجب أن يكون 225 حروف فقط"
                                   data-parsley-minLength="3" data-parsley-minLength-message=" owner  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  owner  "

                            />
                            <p class="help-block" id="error_owner"></p>
                        </div>

                    </div>


                    <div class="col-xs-4">
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type">type*</label>
                            <input type="text" name="type" value="{{ $project->type }}"
                                   class="form-control"
                                   required  placeholder="type  ..."  data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" type  يجب أن يكون 225 حروف فقط"
                                   data-parsley-minLength="3"  data-parsley-minLength-message="
                                   type  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  type  "
                            />
                            <p class="help-block" id="error_type"></p>
                        </div>
                    </div>


                    <div class="col-xs-4">
                        <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                            <label for="size">size*</label>
                            <input type="text" name="size" value="{{ $project->size }}"
                                   class="form-control"
                                   required placeholder="size  ..."
                                   data-parsley-maxLength="225" data-parsley-maxLength-message=" size  يجب أن يكون 225 حروف فقط"
                                   data-parsley-minLength="3" data-parsley-minLength-message=" size  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  size  "
                            />
                            <p class="help-block" id="error_size"></p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">title*</label>
                            <input type="text" name="title" value="{{ $project->title }}"
                                   class="form-control"
                                   required placeholder="title  ..." data-parsley-maxLength="225"
                                   data-parsley-maxLength-message=" title  يجب أن يكون 225 حروف فقط" data-parsley-minLength="3"
                                   data-parsley-minLength-message=" title  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  title  "
                            />
                            <p class="help-block" id="error_title"></p>
                        </div>

                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('consultants') ? ' has-error' : '' }}">
                            <label for="consultants">consultants*</label>
                            <input type="text" name="consultants" value="{{ $project->consultants }}"
                                   class="form-control"
                                   required placeholder="consultants  ..."
                                   data-parsley-maxLength="225" data-parsley-maxLength-message=" consultants  يجب أن يكون 225 حروف فقط"
                                   data-parsley-minLength="3" data-parsley-minLength-message=" consultants  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  consultants  "
                            />
                            <p class="help-block" id="error_consultants"></p>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('scope_of_work') ? ' has-error' : '' }}">
                            <label for="scope_of_work">scope_of_work*</label>
                            <textarea name="scope_of_work" id="scope_of_work" cols="30" rows="10"
                                      class="form-control" required
                                      data-parsley-required-message="يجب ادخال  scope_of_work  ">{{ $project->scope_of_work}}
                            </textarea>
                            <p class="help-block" id="error_scope_of_work"></p>
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

@endsection

@section('scripts')

<script type="text/javascript"
        src="{{ request()->root() }}/public/assets/admin/js/validate-{{ config('app.locale') }}.js"></script>

@endsection

