@extends('website.layouts.master')

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="title">كيف يمكننا مساعدتك ؟</div>
                    <div class="sub-title">سيتم التواصل معك بعد ان تصلنا رسالتك او شكوتك في اقل من 24 ساعة</div>
                    <div class="contact-form">
                        <form method="post" action="{{route('send.contact.us')}}" id="submit-contact-us">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>ادخل اسمك بالكامل :</label>
                                <input type="text" name="name" class="form-control form-control2" placeholder="الاسم"  >
                            </div>
                            <div class="form-group">
                                <label>ادخل رقم الجوال :</label>
                                <input type="text" name="phone" class="form-control form-control2" placeholder="الرقم" required>
                            </div>
                            <div class="form-group">
                                <label>ادخل الإيميل الخاص بك   :</label>
                                <input type="email" name="email" class="form-control form-control2" placeholder="الإيميل" required>
                            </div>
                            <div class="form-group">
                                <label>رسالتك او شكوتك :</label>
                                <textarea class="form-control form-control2" name="message" rows="5" placeholder="اكتب هنا " required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="button-contact-us"  class="btn the-btn-2 btn-block btn-larg">ارسال</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="title">بيانات التواصل</div>
                    <div class="sub-title">سيتم التواصل معك بعد ان تصلنا رسالتك او شكوتك في اقل من 24 ساعة</div>
                    <ul class="list-group">
                        <li>
                            <span>البريد الإلكتروني</span>
                            <span>almahaeye@gamil.com</span>
                        </li>
                        <li>
                            <span>خط ساخن</span>
                            <span>+98888377261</span>
                        </li>
                        <li>
                            <span>رقم فاكس</span>
                            <span>+98888377261</span>
                        </li>
                        <li>
                            <span>العنوان</span>
                            <span>السعودية - دمام - شارع فلان ابن فلان</span>
                        </li>
                        <li>
                            <span>الوتس آب</span>
                            <span>+98888377261</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>
        $('#submit-contact-us').on('submit',() => $("#button-contact-us").hide());
    </script>
@endsection


