
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function () {
    setTimeout(function () {
        $('body').addClass('loaded');
        $('body').removeClass('scroll-hidden');
    }, 2000);
});



$('[data-dismiss=modal]').on('click', function (e) {
    window.location.reload(true);
})

$(document).ready(function () {

    var table = $('#datatable-fixed-header').DataTable({
        fixedHeader: true,
        columnDefs: [{orderable: false, targets: [0]}],
        "language": {
            "lengthMenu": "@lang('maincp.show') _MENU_ @lang('maincp.perpage')",
            "info": "@lang('maincp.show') @lang('maincp.perpage') _PAGE_ @lang('maincp.from')_PAGES_",
            "infoEmpty": "@lang('maincp.no_recorded_data_available')",
            "infoFiltered": "(@lang('maincp.filter_from_max_total') _MAX_)",
            "paginate": {
                "first": "@lang('maincp.first')",
                "last": "@lang('maincp.last')",
                "next": "@lang('maincp.next')",
                "previous": "@lang('maincp.previous')"
            },
            "search": "@lang('maincp.search'):",
            "zeroRecords": "@lang('maincp.no_recorded_data_available')",

        },

    });
});





$(function () {
    $('body').on('change', '.filteriTems', function (e) {

            e.preventDefault();

            var keyName = $('#filterItems').val();
            var pageSize = $('#recordNumber').val();

            var url = $(this).attr('data-url');

            if (keyName != '' && pageSize != '') {
                var path = '{{  request()->root().'/'.request()->path() }}' + '?name=' + keyName + '&pageSize=' + pageSize;
            } else if (keyName != '' && pageSize == '' && pageSize == 'all') {
                var path = '{{  request()->root().'/'.request()->path() }}' + '?name=' + keyName;
            } else if (keyName == '' && pageSize != '') {
                var path = '{{  request()->root().'/'.request()->path() }}' + '?pageSize=' + pageSize;
            } else {
                var path = '{{  request()->root().'/'.request()->path() }}' + '?pageSize=' + pageSize;
            }

            $.ajax({
                type: "POST",
                url: url,
                data: {keyName: keyName, path: path, pageSize: pageSize}
            }).done(function (data) {
                window.history.pushState("", "", path);
                $('.articles').html(data);
            }).fail(function () {
                alert('Articles could not be loaded.');
            });


        }
    );
});

$('body').on('click', '.suspendElement', function () {
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-type');
    var url = $(this).attr('data-url');
    swal({
        title: "{{ __('maincp.make_sure') }}",
        text: $(this).attr('data-message'),
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{{ __('maincp.accepted') }}",
        cancelButtonText: "{{ __('maincp.disable') }}",
        confirmButtonClass: 'btn-warning waves-effect waves-light',
        closeOnConfirm: true,
        closeOnCancel: true,
    }, function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {id: id, type: type},
                dataType: 'json',
                success: function (data) {

                    if (data.status == true) {

                        if (data.type == 1) {
                            var shortCutFunction = 'success';
                            var msg = data.message;

                            $('.suspend' + data.id).delay(500).slideDown();
                            $('.unsuspend' + data.id).slideUp();

                            $('.StatusActive' + data.id).delay(500).slideDown();
                            $('.StatusNotActive' + data.id).slideUp();


                        } else {
                            var shortCutFunction = 'success';

                            var msg = data.message;

                            $('.unsuspend' + data.id).delay(500).slideDown();
                            $('.suspend' + data.id).slideUp();


                            $('.StatusNotActive' + data.id).delay(500).slideDown();
                            $('.StatusActive' + data.id).slideUp();

                        }

                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 1200);

                        // var shortCutFunction = 'success';
                        // var msg = 'لقد تمت عملية الحذف بنجاح.';
                        var title = data.title;
                        toastr.options = {
                            positionClass: 'toast-top-center',
                            onclick: null,
                            showMethod: 'slideDown',
                            hideMethod: "slideUp",
                        };
                        var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                        $toastlast = $toast;
                    }else{



                        var shortCutFunction = 'error';
                        var msg = data.message;
                        var title = "@lang('institutioncp.error')";
                        toastr.options = {
                            positionClass: 'toast-top-center',
                            onclick: null,
                            showMethod: 'slideDown',
                            hideMethod: "slideUp",
                        };
                        var $toast = toastr[shortCutFunction](msg, title);
                        // Wire up an event handler to a button in the toast, if it exists
                        $toastlast = $toast;
                    }


                }
            });
        }
    });
});



function redirectPage(route) {

    window.history.pushState("", "", route);
}

$('.dropify').dropify({
    messages: {
        // 'default': ' {{ __('institutioncp.insert_image') }} ',
        // 'replace': '{{ __('institutioncp.drag_and_drop_to_replace') }}',
        // 'remove': '{{ __('institutioncp.delete') }}',
        // 'error': '{{ __('institutioncp.something_went_wrong_try_again') }}'
        'default': 'من فضلك ضع صورة ',
        'replace': 'غير الصورة',
        'remove': 'مسح',
        'error': 'يوجد خطا ما'
    },
    error: {
        'fileSize': 'The file size is too big (1M max).',
        'fileExtension': ' (pdf png gif jpg jpeg)',
    }
});


function checkSelect(item) {
    var checked = $(item).prop('checked');

    $('.checkboxes-items').each(function (i) {
        $(this).prop('checked', checked);
    })
}


$(document).ready(function () {
    $('form').parsley();
});
