@extends('admin.layouts.master')
@section('title', 'إدارة المستخدمين')
@section('content')


    <form method="POST" action="{{ route('helpAdmin.update', $user->id) }}" enctype="multipart/form-data"
          data-parsley-validate novalidate>
    @csrf
    {{ method_field('PUT') }}



    <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">

                    <a href="#" onclick="window.history.back();return false;"
                       class="btn btn-custom  waves-effect waves-light">
												<span><span>رجوع  </span>
													<i class="fa fa-reply"></i>
												</span>
                    </a>
                </div>
                <h4 class="page-title">تعديل المستخدم</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card-box">


                    <h4 class="header-title m-t-0 m-b-30">تعديل بيانات المستخدم</h4>


                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="userName">الاسم الكامل*</label>
                            <input type="text" name="name" value="{{ $user->name   }}" class="form-control"
                                   required
                                   placeholder="اسم المستخدم بالكامل..."
                                   data-parsley-maxLength="20"
                                   data-parsley-maxLength-message=" الاسم  يجب أن يكون عشرون حروف فقط"
                                   data-parsley-minLength="3"
                                   data-parsley-minLength-message=" الاسم  يجب أن يكون اكثر من 3 حروف "
                                   data-parsley-required-message="يجب ادخال  اسم المستخدم"

                            />
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
                            <input type="number" name="phone" value="{{ $user->phone }}" class="form-control"
                                   required
                                   data-parsley-maxLength="10"
                                   data-parsley-maxLength-message=" الاسم  يجب أن يكون 10 حروف فقط"
                                   data-parsley-minLength="5"
                                   data-parsley-minLength-message=" الاسم  يجب أن يكون اكثر من 5 حروف "
                                   data-parsley-type-message="أدخل رقم الجوال بطريقة صحيحة"
                                   data-parsley-pattern="/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/"
                                   data-parsley-pattern-message="أدخل  رقم الجوال بطربقة صحيحة ليبدا من (05)"
                                   data-parsley-required-message="يجب ادخال رقم الجوال"
                                   placeholder="رقم الجوال..."
                            />
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
                                   class="form-control"
                                   placeholder="البريد الإلكتروني..."
                                   data-parsley-type="email"
                                   data-parsley-type-message="أدخل البريد الالكتروني بطريقة صحيحة"
                                   data-parsley-required-message="يجب ادخال  البريد الالكتروني"
                                   data-parsley-maxLength="30"
                                   data-parsley-maxLength-message=" البريد الالكتروني  يجب أن يكون ثلاثون حرف فقط"
                                   {{--data-parsley-pattern="/^([a-z0-9_\.-]+\@[\da-z\.-]+\.[a-z\.]{2,6})$/gm"--}}
                                   {{--data-parsley-pattern-message="أدخل  البريد الالكتروني بطريقة الايميل ومن غير مسافات"--}}
                                   required
                            />
                            @if($errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif

                        </div>

                    </div>

                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="pass1">كلمة المرور*</label>

                            <input type="password" name="password" id="pass1"
                                   class="form-control"
                                   placeholder="كلمة المرور..."
                                   data-parsley-maxLength="20"
                                   data-parsley-maxLength-message=" الباسورد  يجب أن يكون عشرون حروف فقط"
                                   data-parsley-minLength="6"
                                   data-parsley-minLength-message=" الباسورد  يجب أن يكون اكثر من 6 حروف "
                            />

                            @if($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                            @endif

                        </div>
                    </div>


                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="passWord2">تأكيد كلمة المرور*</label>
                            <input
                                    data-parsley-equalto="#pass1"
                                   data-parsley-equalto-message=" تاكيد كلمة المرور غير متساوية مع كلمة المرور الأساسية "
                                   name="password_confirmation" type="password"
                                   placeholder="تأكيد كلمة المرور..."
                                   class="form-control" id="passWord2"
                            >
                            @if($errors->has('password_confirmation'))
                                <p class="help-block">{{ $errors->first('password_confirmation') }}</p>
                            @endif

                        </div>
                    </div>

                    <div class="form-group text-right m-t-20">
                        <button class="btn btn-primary waves-effect waves-light m-t-20" type="submit">
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


                    <h4 class="header-title m-t-0 m-b-30">الصورة الشخصية</h4>

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <div class="col-sm-12">

                            <input type="hidden" value="{{ $user->getFirstMediaUrl() }}" name="oldImage"/>
                            <input type="file" accept=".png,.jpg,.jpeg" name="image" class="dropify"
                                   data-max-file-size="1M" data-show-remove="false"
                                   data-default-file="{{ $user->getFirstMediaUrl() }}"/>

                        </div>
                        @if($errors->has('image'))
                            <p class="help-block">{{ $errors->first('image') }}</p>
                        @endif
                    </div>

                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </form>

@endsection

