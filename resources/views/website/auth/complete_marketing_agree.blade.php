@extends('website.layouts.master')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="{{asset('website/templates/css/bootstrap-datetimepicker.css')}}">
    <style>
        .error{
            color: red;
        }

    </style>
@endsection
@section('content')

    <section>
        <div class="container">
            <div class="sec-title">
                <h2 class="title">إتفاقية التسويق :    </h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="alert alert-danger my_errors_form" style="display: none">
                <ul>



                </ul>
            </div>

            <form id="my_form" class="row" method="post" action="{{route('submit-marking-agree')}}" enctype="multipart/form-data">

                @csrf
                <h5 style="margin-bottom: 2%">
                    إتفاقیة تسویق إلكتروني أبرمت ھذه الاتفاقیة الیوم
                    {{$currentDay}}
                    الموافق
                    <input hidden type="date" name="date_now" value="{{date("Y-m-d")}}">
                    {{date("Y-m-d")}}
                    في مدینة الدمام المملكة العربیة السعودیة فیما بین كل من:

                </h5>
                <h5 >
                      1.السادة شركة/ عین المھا للنظارات ب- سجل تجاري رقم 2050141744 وعنوانھا الدمام ھاتف رقم 966504966997+ ویمثلھا في التوقیع على ھذه الإتفاقیة
                </h5>


                <h5 style="margin-bottom: 2%">
                     السید/
                    علي منصور الحرز
                        <input name="master_one[name]" value="علي منصور الحرز" hidden>
                    سعودي الجنسیة
                    بموجب بطاقة أحوال رقم
                    1003232715
                        <input name="master_one[status_card]"  value="1003232715" hidden>
                    صادرة من
                    الدمام
                        <input name="master_one[comingـfrom]"  value="الدمام" hidden>
                    تاریخ
                    1409/6/11
                        <input type="text" name="master_one[date]"  value="1409/6/11" hidden>,
                    ویشار إلیھ فیما بعد.
                    بـ (الطرف الأول).
                </h5>
                <h5 style="margin-bottom: 2%">
                    2.السادة شركة/
                        <input  name="master_two[company_name]" style="padding: 2px">
                    - بسجل تجاري رقم
                        <input name="master_two[commercialـrecord]">
                    وعنوانھا
                    <input name="master_two[address]">
                    ھاتف رقم
                        <input name="master_two[number]">
                    ویمثلھا في التوقیع على ھذه الإتفاقیة السید/
                        <input name="master_two[name]">
                    سعودي الجنسیة
                    بموجب بطاقة أحوال رقم
                        <input name="master_two[status_card]">
                    صادرة من
                        <input name="master_two[comingـfrom]">
                    , تاریخ
                        <input type="text" id="hijri-date-input" name="master_two[date]">
                    ـ, ویشار إلیھ فیما بـ (الطرف الثاني) .
                </h5>


                <hr>

                <h4>
                    یتم حساب سعر النظارة بمبلغ وقدره (....) ریال سعودي, على أن یشتمل النظارة على جمیع ملحقاتھا,
                    ویحق للطرف الأول بموجب أحكام ھذه الاتفاقیة بیع النظارة بسعر أعلى.

                </h4>

                <div class="container pt-4">
                    <button class="btn btn-sm" id="addBtn" type="button">
                        إضافة جديدة
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">  رقم</th>
                                <th class="text-center">  صورة الماركة</th>
                                <th class="text-center">  إسم الماركة</th>
                                <th class="text-center">  نوع المنتج</th>
                                <th class="text-center">  سعر المنتج</th>
                                <th class="text-center">  مسح</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>

                </div>

                <button class="btn btn-sm btn-success" id="addBtn" type="submit">
                    تسجيل الإتفاقية
                </button>

            </form>

        </div>
    </section>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{asset('website/templates/js/momentjs.js')}}"></script>

    <script src="{{asset('website/templates/js/moment-hijri.js')}}"></script>

    <script src="{{asset('website/templates/js/bootstrap-hijri-datetimepicker.js')}}"></script>

    <script>

        $('#my_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '{{route('submit-marking-agree')}}',
                data: $(this).serialize(),
                success: function(data) {
                    window.location.href = '/';
                },
                error:function (er) {
                    printErrorMsg(er.responseJSON.errors)
                }
            });
        });

        function printErrorMsg (msg) {
            $(".my_errors_form").find("ul").html('');
            $(".my_errors_form").css('display','block');
            $.each( msg, function( key, value ) {
                $(".my_errors_form").find("ul").append('<li>'+value+'</li>');
            });
        }

        var selectBrands = document.createElement('select'),
            selectProductTypes = document.createElement('select'),
            brands = [],
            brandOptions = "",
            productTypes = [],
            productTypesOptions = "";

        @foreach($brands as $brand)
            brands[{{$brand->id}}]  = '{{$brand->name}}';
        @endforeach

        @foreach($productTypes as $productType )
            productTypes[{{$productType->id}}]  = '{{$productType->name}}';
        @endforeach

        brands.forEach( function(name,id) {
            brandOptions += '<option value="' + id + '">' + name + '</option>';
        });

        productTypes.forEach( function(name,id) {
            productTypesOptions += '<option value="' + id + '">' + name + '</option>';
        });

        selectBrands.innerHTML = brandOptions;
        selectProductTypes.innerHTML = productTypesOptions;


        function renderSelect() {
            $(".js-example-tags").select2({ tags: true });
        }

        $(document).ready(function () {

            $(".js-example-tags").select2({ tags: true });
            // Denotes total number of rows
            var rowIdx = 0;

            // jQuery button click event to add a row
            $('#addBtn').on('click', function () {

                $('#tbody').append(`<tr id="R${++rowIdx}">
                         <td class="row-index text-center">
                            <p>  ${rowIdx}</p>
                         </td>
                         <td class="row-index text-center">
                            <p>  <input type="file"  placeholder="صورة الماركة"  name="products[${rowIdx}][brand_image]"></p>
                         </td>
                         <td class="row-index text-center" style="width: 25%">
                            <select required class="form-control select_brands-${rowIdx} js-example-tags" name="products[${rowIdx}][brand_name]"> </select>
                         </td>
                         <td class="row-index text-center" style="width: 20%">
                            <select required class="form-control select_product_types-${rowIdx}  " name="products[${rowIdx}][product_type]"> </select>
                          </td>
                         <td class="row-index text-center">
                            <p>  <input required type="number" placeholder="السعر" step="0.01" min="0" max="1000" name="products[${rowIdx}][product_price]"></p>
                         </td>
                        <td class="text-center">
                            <button class="btn btn-danger remove" type="button">مسح</button>
                        </td>
                    </tr>`
                );
                $('.select_brands-' + rowIdx).append(brandOptions);
                $('.select_product_types-' + rowIdx).append(productTypesOptions);
                renderSelect();

            });

            // jQuery button click event to remove a row.
            $('#tbody').on('click', '.remove', function () {

                // Getting all the rows next to the row
                // containing the clicked button
                var child = $(this).closest('tr').nextAll();

                // Iterating across all the rows
                // obtained to change the index
                child.each(function () {

                    // Getting <tr> id.
                    var id = $(this).attr('id');

                    // Getting the <p> inside the .row-index class.
                    var idx = $(this).children('.row-index').children('p');

                    // Gets the row number from <tr> id.
                    var dig = parseInt(id.substring(1));

                    // Modifying row index.
                    idx.html(` ${dig - 1}`);

                    // Modifying row id.
                    $(this).attr('id', `R${dig - 1}`);
                });

                // Removing the current row.
                $(this).closest('tr').remove();

                // Decreasing total number of rows by 1.
                rowIdx--;
            });
        });

        // $(function () {
        //     $("#hijri-date-input").hijriDatePicker();
        // });



        $(function () {

            initHijrDatePicker();

            //initHijrDatePickerDefault();

            $('#hijri-date-input').hijriDatePicker({
                hijri:true,
            });

        });

        function initHijrDatePicker() {

            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "DD-MM-YYYY",
                hijriFormat:"iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                // showSwitcher: true,
                // allowInputToggle: true,
                useCurrent: true,
                isRTL: true,
                viewMode:'months',
                keepOpen: false,
                hijri: true,
                showClear: true,
                showTodayButton: true,
                showClose: true
            });
        }


    </script>

@endsection
