@extends('admin.layouts.master')
@section('title' , 'إضافة مستخدم')
@section('content')
    <form id="myForm" method="POST" action="{{ route('helpAdmin.store') }}" enctype="multipart/form-data" data-parsley-validate
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
                <h4 class="page-title">إدارة المستخدمين</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> إضافة مستخدم  </h4>
                    <div class="col-xs-12">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="userName">الاسم  *</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                   required
                                   placeholder="اسم المستخدم الأول..."
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
                            <input type="number" name="phone" value="{{ old('phone') }}" class="form-control"
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

                            <input type="email" name="email" parsley-trigger="change" value="{{ old('email') }}"
                                   class="form-control"
                                   placeholder="البريد الإلكتروني..." required
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
                            <input type="password" name="password" id="pass1" value="{{ old('password') }}"
                                   class="form-control"
                                   placeholder="كلمة المرور..."
                                   required
                                   data-parsley-required-message="هذا الحقل مطلوب"
                                   data-parsley-maxLength="20"
                                   data-parsley-maxLength-message=" الباسورد  يجب أن يكون عشرون حروف فقط"
                                   data-parsley-minLength="5"
                                   data-parsley-minLength-message=" الباسورد  يجب أن يكون اكثر من 5 حروف "
                            />

                            @if($errors->has('password'))
                                <p class="help-block">{{ $errors->first('password') }}</p>
                            @endif

                        </div>
                    </div>


                    <div class="col-xs-6">
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="passWord2">تأكيد كلمة المرور*</label>
                            <input   name="password_confirmation" type="password" required
                                   placeholder="تأكيد كلمة المرور..." class="form-control" id="passWord2"
                                   data-parsley-required-message="تأكيد كلمة المرور مطلوب"
                                   data-parsley-maxlength="55"
                                   data-parsley-minlength="8"
                                   data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (55) حرف"
                                   data-parsley-minlength-message=" أقل عدد الحروف المسموح بها هى (8) حرف"
                                   data-parsley-equalto="#pass1"
                                   data-parsley-equalto-message ='غير مطابقة لكلمة المرور'
                            >
                            @if($errors->has('password_confirmation'))
                                <p class="help-block">{{ $errors->first('password_confirmation') }}</p>
                            @endif


                        </div>
                    </div>


                    {{--<div class="form-group">--}}
                        {{--<label for="passWord2">العنوان*</label>--}}
                        {{--<input name="address" value="{{ old('address') }}" type="text" placeholder="العنوان..."--}}
                               {{--class="form-control"--}}
                               {{--data-parsley-maxlength="191"--}}
                               {{--data-parsley-maxlength-message=" أقصى عدد الحروف المسموح بها هى (191) حرف"--}}
                        {{-->--}}

                    {{--</div>--}}

                    <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                        <label for="passWord2">الصلاحيات *</label>
                        <select multiple="multiple" class="multi-select" id="my_multi_select1" name="roles[]" required
                                data-parsley-required-message="من فضلك اختار صلاحية على الاقل"
                                data-plugin="multiselect">
                            @foreach($roles as  $value)

                                <option value="{{ $value->name }}" {{ (collect(old('roles'))->contains($value->name)) ? 'selected':'' }}>{{ $value->title }}</option>
                            @endforeach

                        </select>

                        @if($errors->has('roles'))
                            <p class="help-block"> {{ $errors->first('roles') }}</p>
                        @endif

                    </div>

                    <div class="form-group text-right m-t-20">
                        <button id="send" class="btn btn-primary waves-effect waves-light m-t-20" type="submit">
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
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input data-parsley-fileextension='jpg,png' id="image" type="file" accept='image/*' name="image" class="dropify" data-max-file-size="6M"/>

                        </div>
                    </div>

                        <span class="help-block">
	                	<strong hidden id='error' style="color: red;">الصورة يجب ان تكون بصيغة PNG او JPG</strong>
	            	</span>


                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </form>
@endsection

@section('scripts')
<script>


     $(document).ready(function() {

                  $('body').on('submit','#myForm',function(e){

                        var fileName = $('#image').val();
                        var meme = fileName.substr(fileName.length - 3);


                         if(meme != 'jpg' && meme !='png'){
                                e.preventDefault();

                            $('#error').show();
                                // swal({
                                //     title: "خطأ !",
                                //     text: "ربما حدث خطأ أثناء رفع الملف او الملف تالف ... يمكنك تعديله",
                                //     type: "error",
                                //     showCancelButton: false,
                                //     confirmButtonColor: "#DD6B55",
                                //     confirmButtonText: "موافق",
                                //     confirmButtonClass: 'btn-danger waves-effect waves-light',
                                //     closeOnConfirm: true,
                                //     closeOnCancel: false,
                                // });
                                }else
                                {
                                    $('#error').hide();
                                }
                    });




    //         window.ParsleyValidator.addValidator('fileextension', function (value, requirement) {
    //     		var tagslistarr = requirement.split(',');
    //             var fileExtension = value.split('.').pop();
				// 		var arr=[];
				// 		$.each(tagslistarr,function(i,val){
   	// 					 arr.push(val);
				// 		});
    //         if(jQuery.inArray(fileExtension, arr)!='-1') {
    //           console.log("is in array");
    //           return true;
    //         } else {
    //           console.log("is NOT in array");
    //           return false;
    //         }
    //     }, 32)
    //     .addMessage('ar', 'fileextension', 'صيغة الصورة يجب ان تكون PNG او JPG');

    //     $("#myForm").parsley();

    //     $("#myForm").on('submit', function(e) {
    //         var f = $(this);
    //         f.parsley().validate();

    //         if (f.parsley().isValid()) {
    //             alert('The form is valid');
    //         } else {
    //             alert('There are validation errors');
    //             $("#error").show();
    //             e.preventDefault();
    //         }


    // });
});

</script>

@endsection
