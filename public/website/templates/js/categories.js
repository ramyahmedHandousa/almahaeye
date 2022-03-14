
$('#mainCategory').change(function () {
    var categoryId = $(this).val();
    var subCategoryId = $("#subCategory");
    if (categoryId) {
        $.ajax({
            type: "GET",
            url: '/list/categories/data',
            data: {categoryId: categoryId},
            dataType: 'json',
            success: function (res) {
                if (res) {
                    subCategoryId.empty().append('<option value="" selected disabled>اختر القسم الفرعى </option>');
                    $.each(res, function (key, value) {
                        subCategoryId.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                }
            }
        });
    }
});
