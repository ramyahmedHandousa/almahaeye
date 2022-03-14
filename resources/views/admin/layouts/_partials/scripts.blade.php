<!-- jQuery  -->
<script src="/assets/admin/js/jquery.min.js"></script>
<script src="/assets/admin/js/bootstrap-rtl.min.js"></script>
<script src="/assets/admin/js/detect.js"></script>
<script src="/assets/admin/js/fastclick.js"></script>

<script src="/assets/admin/js/jquery.slimscroll.js"></script>
<script src="/assets/admin/js/jquery.blockUI.js"></script>
<script src="/assets/admin/js/waves.js"></script>
<script src="/assets/admin/js/wow.min.js"></script>
<script src="/assets/admin/js/jquery.nicescroll.js"></script>
<script src="/assets/admin/js/jquery.scrollTo.min.js"></script>

<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript"
        src="/assets/admin/plugins/jquery-knob/excanvas.js"></script>
<![endif]-->
<script src="/assets/admin/plugins/jquery-knob/jquery.knob.js"></script>


<!-- responsive-table-->
<script src="/assets/admin/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js"
        type="text/javascript"></script>


<!-- Dashboard init -->
<script src="/assets/admin/pages/jquery.dashboard.js"></script>


<!-- file uploads js -->
<!--<script src="/assets/admin/plugins/fileuploads/js/dropify.min.js"></script>-->
<script src="https://jeremyfagis.github.io/dropify/dist/js/dropify.js"></script>
<!-- Validation js (Parsleyjs) -->
<script type="text/javascript"
        src="/assets/admin/plugins/parsleyjs/dist/parsley.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>

<script src="/assets/admin/plugins/toastr/toastr.min.js"></script>

<script src="/assets/admin/plugins/switchery/switchery.min.js"></script>
<script src="/assets/admin/plugins/waypoints/lib/jquery.waypoints.js"></script>
<script src="/assets/admin/plugins/counterup/jquery.counterup.min.js"></script>

<script type="text/javascript"
        src="/assets/admin/plugins/multiselect/js/jquery.multi-select.js"></script>

<script src="/assets/admin/plugins/ckeditor/ckeditor.js"></script>
<script src="/assets/admin/plugins/ckeditor/samples/js/sample.js"></script>

<!-- Sweet Alert js -->
<script src="/assets/admin/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script src="/assets/admin/pages/jquery.sweet-alert.init.js"></script>


<!-- App js -->
<script src="/assets/admin/js/jquery.core.js"></script>
<script src="/assets/admin/js/jquery.app.js"></script>
<script src="/assets/admin/js/validate-ar.js"></script>

<!-- Datatables-->
<script src="/assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="/assets/admin/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="/assets/admin/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="/assets/admin/plugins/datatables/jszip.min.js"></script>
<script src="/assets/admin/plugins/datatables/pdfmake.min.js"></script>
<script src="/assets/admin/plugins/datatables/vfs_fonts.js"></script>
<script src="/assets/admin/plugins/datatables/buttons.html5.min.js"></script>
<script src="/assets/admin/plugins/datatables/buttons.print.min.js"></script>
<script src="/assets/admin/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="/assets/admin/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="/assets/admin/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="/assets/admin/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="/assets/admin/plugins/datatables/dataTables.scroller.min.js"></script>


<!-- Datatable init js -->
<script src="/assets/admin/pages/datatables.init.js"></script>
{{--<script src="/assets/admin/js/examples.min.js"> </script>--}}

<!-- Toastr js -->
<script src="/assets/admin/plugins/toastr/toastr.min.js"></script>
<script src="/assets/admin/plugins/summernote/dist/summernote.min.js"></script>

<!-- Modal-Effect -->
<script src="/assets/admin/plugins/custombox/dist/custombox.min.js"></script>
<script src="/assets/admin/plugins/custombox/dist/legacy.min.js"></script>


<script src="/assets/admin/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $('body').delegate('.numbersOnly', 'keyup keypress', function (event) {

        var limit = $(this).attr('data-limit');
        var message = $(this).attr('data-message');
        var field = $(this).attr('name');

        if (!limit) {
            limit = 25;
        }

        if (this.value.length > limit) {
            $(this).css({
                'border': '1px solid red',
                'font-size': '14px',
                'color': 'red'
            });

            /****Not Work yet****/

            $('.' + field).css({
                'font-size': '12px'
            });

            $('.' + field).html(message);




        } else {
            $(this).removeAttr('style');
            $('.' + field).html('');

        }


        // if (!Number(this.value)) {
        //     this.value = this.value.replace(/[^0-9\.]/g, '');
        //     event.preventDefault();
        //     return false;
        // }


        if (this.value.length > limit) {

            this.value = this.value.replace(/[^0-9\.]/g, '');
            if(!Number(this.value)){
                $('.' + field).html(message);
            }
            event.preventDefault();
            return false;
        }

        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
</script>

@yield('scripts')
<script>

    // Date Picker
    //    jQuery('.datepicker').datepicker();

    //    jQuery('.datepicker-autoclose').datepicker({
    //        autoclose: true,
    //        todayHighlight: true
    //    });

    $('.datepicker').datepicker({format: 'yyyy-mm-dd',autoclose: true,todayHighlight: true});
    initSample();

    //    TableManageButtons.init();


</script>





