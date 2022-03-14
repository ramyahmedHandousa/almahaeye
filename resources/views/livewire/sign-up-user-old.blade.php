<!-- login section -->
<section>
    <div class="container">
        <div class="sec-title">
            <h2 class="title">تسجيل عضو جديد</h2>
        </div>
        <form class="row"   wire:submit.prevent="save">

            <div class="col-lg-4 form-group">
                <input type="text" wire:model="name" class="form-control" placeholder="اسم الاول">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="col-lg-4 form-group">
                <input type="text" wire:model="last_name" class="form-control" placeholder="اسم الأخير">
                @error('last_name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="col-lg-4 form-group">
                <input type="text" wire:model="email" class="form-control" placeholder="البريد الإلكترونى">
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>

{{--            <div class="col-lg-4 form-group">--}}
{{--                <input type="text" class="form-control" placeholder="رقم الهاتف">--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 form-group">--}}
{{--                <select class="form-select">--}}
{{--                    <option value="0">اختار الدولة</option>--}}
{{--                    <option value="1">السعودية</option>--}}
{{--                    <option value="1">مصر</option>--}}
{{--                    <option value="1">الاردن</option>--}}
{{--                    <option value="1">الكويت</option>--}}
{{--                    <option value="1">البحرين</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 form-group">--}}
{{--                <select class="form-select">--}}
{{--                    <option value="0">اختار مدينة</option>--}}
{{--                    <option value="1">المدينة</option>--}}
{{--                    <option value="1">جدة</option>--}}
{{--                    <option value="1">الرياض</option>--}}
{{--                    <option value="1">مكة</option>--}}
{{--                    <option value="1">الطائف</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 form-group">--}}
{{--                <input type="text" class="form-control" placeholder="الحى">--}}
{{--            </div>--}}
{{--            <div class="col-lg-8 form-group input-icon">--}}
{{--                <input type="text" class="form-control" placeholder="العنوان">--}}
{{--                <div class="icon" data-bs-toggle="modal" data-bs-target="#exampleModal">--}}
{{--                    <i class="fas fa-map-marker-alt"></i>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 form-group">--}}
{{--                <input type="password" class="form-control" placeholder="كلمة المرور">--}}
{{--            </div>--}}
{{--            <div class="col-lg-4 form-group">--}}
{{--                <input type="password" class="form-control" placeholder="تأكيد كلمة المرور">--}}
{{--            </div>--}}
{{--            <div class="col-12 form-group">--}}
{{--                <label class="form-check-label">--}}
{{--                    <input class="form-check-input" type="checkbox" value="">--}}
{{--                    أوافق على جميع الشروط والاحكام و سياسة الخصوصية--}}
{{--                </label>--}}
{{--            </div>--}}
            <div class="col-12">
                <div class="row submit-row">
                    <div class="col-lg-3 order2">
                        <a class="btn btn-gray" href="{{url('/')}}">الغاء</a>
                    </div>

                    <div class="col-lg-3">
                        <button type="submit" class="btn">التالى</button>
                    </div>
                </div>
            </div>
{{--            <!-- Modal -->--}}
{{--            <div class="modal fade" id="exampleModal"   data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                <div class="modal-dialog modal-dialog-centered">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h5 class="modal-title" id="exampleModalLabel">خريطة جوجل</h5>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}

{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-gray" data-bs-dismiss="modal">الغاء</button>--}}
{{--                            <button type="button" class="btn">حفظ</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </form>
    </div>
</section>
