@extends('admin.layouts.master')

@section('content')


    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-custom  waves-effect waves-light"
                            onclick="window.history.back();return false;"> رجوع <span class="m-l-5"><i
                                    class="fa fa-reply"></i></span>
                    </button>

                </div>
                <h4 class="page-title">بيانات المستخدم</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card-box">


                    <h4 class="header-title m-t-0 m-b-30"> بيانات </h4>


                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="userName">الاسم الكامل*</label>
                            <input type="text" name="name" value="{{ $user->name  }}" class="form-control"
                                   readonly
                                   placeholder="اسم المستخدم بالكامل..."/>
                            <p class="help-block" id="error_userName"></p>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>
                    </div>


                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="userPhone">رقم الجوال*</label>
                            <input type="text" name="phone" value="{{ $user->phone  }}"
                                   class="form-control" readonly
                                   placeholder="رقم الجوال..."/>
                            @if($errors->has('phone'))
                                <p class="help-block">
                                    {{ $errors->first('phone') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="emailAddress">البريد الإلكتروني*</label>

                            <input type="email" name="email" parsley-trigger="change"
                                   value="{{ $user->email  }}"
                                   class="form-control" placeholder="البريد الإلكتروني..." readonly/>
                            @if($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif

                        </div>

                    </div>


                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="emailAddress">تاريخ إنشاء المستخدم</label>

                            <input type="email" name="email" parsley-trigger="change"
                                   value="{{ $user->created_at}}"
                                   class="form-control"  readonly/>
                            @if($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif

                        </div>

                    </div>

                    <!--<div class="col-xs-6">-->
                    <!--    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">-->
                    <!--        <label for="emailAddress">عدد مرات الدخول على الحساب</label>-->

                    <!--        <input type="email" name="email" parsley-trigger="change"-->
                    <!--               value="{{ $user->login_count }}"-->
                    <!--               class="form-control"  readonly/>-->
                    <!--        @if($errors->has('email'))-->
                    <!--            <p class="help-block">{{ $errors->first('email') }}</p>-->
                    <!--        @endif-->

                    <!--    </div>-->

                    <!--</div>-->

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="emailAddress">آخر تاريخ و وقت تم الدخول فيه</label>

                            <input type="email" name="email" parsley-trigger="change"
                                   value="{{ $user->updated_at }}"
                                   class="form-control"  readonly/>
                            @if($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif

                        </div>

                    </div>


                    <div class="row">

                    </div>

                    @if(!$user->roles()->whereName('owner')->first() && auth()->id() != $user->id)
                    <div class="row">
                    <div class="form-group">
                        <label for="passWord2">الصلاحيات *</label>
                        {{--<select multiple="multiple"--}}

                                {{--data-plugin="multiselect" disabled>--}}
                            {{--@foreach($roles as  $value)--}}

                                {{--<option value="{{ $value->name }}"--}}
                                        {{--@if($user->roles->pluck('name', 'name')) @foreach($user->roles->pluck('name', 'name') as $roleUser) @if($roleUser == $value->name) selected @endif @endforeach @endif >{{ $value->title }}</option>--}}

                            {{--@endforeach--}}

                        {{--</select>--}}





                        <ul>
                                @foreach($user->roles->pluck('name', 'name') as $roleUser)

                                       <li> {{ $roleUser }}</li>

                                @endforeach
                                </ul>



                    </div>


                    </div>
                @endif


                </div>
            </div><!-- end col -->

            <div class="col-lg-4">
                <div class="card-box" style="overflow: hidden;">


                    <h4 class="header-title m-t-0 m-b-30">الصورة الشخصية</h4>

                    <div class="form-group">
                        <div class="col-sm-12">



                            <div class="form-group">
                                <a data-fancybox="gallery"

                                   href="{{ $user->getFirstMediaUrl()  }}">
                                    <img class="img-thumbnail"

                                         src="{{ $user->getFirstMediaUrl() }}"/>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->


@endsection

