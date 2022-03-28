@extends('website.layouts.master')

@section('styles')

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

            <form class="row" method="post" action="{{route('submit-marking-agree')}}" enctype="multipart/form-data">

                @csrf

                <h5 style="margin-bottom: 2%">
                    إتفاقیة تسویق إلكتروني أبرمت ھذه الاتفاقیة الیوم الاربعاء الموافق
                    <input type="date" name="date_now">
                    في مدینة الدمام المملكة العربیة السعودیة فیما بین كل من:

                </h5>
                <h5 >
                      1.السادة شركة/ عین المھا للنظارات ب- سجل تجاري رقم 2050141744 وعنوانھا الدمام ھاتف رقم 966504966997+ ویمثلھا في التوقیع على ھذه الإتفاقیة
                </h5>
                <h5 style="margin-bottom: 2%">
                     السید/
                        <input name="master_one[name]">
                    سعودي الجنسیة
                    بموجب بطاقة أحوال رقم
                        <input name="master_one[status_card]">
                    صادرة من
                        <input name="master_one[comingـfrom]">
                    تاریخ
                        <input type="date" name="master_one[date]">,
                    ویشار إلیھ فیما بعد.
                    بـ (الطرف الأول).
                </h5>
                <h5 style="margin-bottom: 2%">
                    2.السادة شركة/
                        <input  name="master_two[company_name]">
                    - بسجل تجاري رقم
                        <input name="master_two[commercialـrecord]">
                    وعنوانھا الدمام ھاتف رقم
                        <input name="master_two[number]">
                    ویمثلھا في التوقیع على ھذه الإتفاقیة السید/
                        <input name="master_two[name]">
                    سعودي الجنسیة
                    بموجب بطاقة أحوال رقم
                        <input name="master_two[status_card]">
                    صادرة من
                        <input name="master_two[comingـfrom]">
                    , تاریخ
                        <input type="date" name="master_two[date]">
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
                                <th class="text-center">  إسم المنتج</th>
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

    <script>
        $(document).ready(function () {

            // Denotes total number of rows
            var rowIdx = 0;

            // jQuery button click event to add a row
            $('#addBtn').on('click', function () {

                // Adding a row inside the tbody.
                $('#tbody').append(`<tr id="R${++rowIdx}">
                     <td class="row-index text-center">
                        <p>  ${rowIdx}</p>
                     </td>
                     <td class="row-index text-center">
                        <p>  <input type="text"  placeholder="إسم المنتج "  name="products[${rowIdx}][product_name]"></p>
                     </td>
                     <td class="row-index text-center">
                        <p>  <input type="text"  placeholder="نوع المنتج"  name="products[${rowIdx}][product_type]"></p>
                      </td>
                     <td class="row-index text-center">
                        <p>  <input type="number" placeholder="السعر" step="0.01" min="0" max="1000" name="products[${rowIdx}][product_price]"></p>
                     </td>
                    <td class="text-center">
                        <button class="btn btn-danger remove" type="button">مسح</button>
                    </td>
              </tr>`);
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
    </script>

@endsection
