
$('#country').change(function () {
    var countryID = $(this).val();
    if (countryID) {
        $.ajax({
            type: "GET",
            url: "/countries/data",
            data: {countryID: countryID},
            dataType: 'json',
            success: function (res) {
                if (res) {
                    $.each(res, function (key, value) {
                        $("#city").empty().append('<option value="" selected disabled>اختار  المدينه </option>');
                        $("#state").empty().append('<option value="" selected disabled>اختار  الحى </option>');
                        $("#region").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            }
        });
    }
});
$('#region').change(function () {
    var countryID = $(this).val();
    if (countryID) {
        $.ajax({
            type: "GET",
            url: "/countries/data",
            data: {countryID: countryID},
            dataType: 'json',
            success: function (res) {
                if (res) {
                    $.each(res, function (key, value) {
                        $("#city").empty().append('<option value="" selected disabled>اختار  المدينه </option>');
                        $("#state").empty().append('<option value="" selected disabled>اختار  الحى </option>');
                        $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            }
        });
    }
});
$('#city').change(function () {
    var countryID = $(this).val();
    if (countryID) {
        $.ajax({
            type: "GET",
            url: "/countries/data",
            data: {countryID: countryID},
            dataType: 'json',
            success: function (res) {
                if (res) {
                    $.each(res, function (key, value) {
                        $("#state").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            }
        });
    }
});
