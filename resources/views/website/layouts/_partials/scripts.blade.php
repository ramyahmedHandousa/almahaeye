
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG"
        crossorigin="anonymous"></script>
<!-- start slick slider -->
<script src="{{asset('website/templates/js/slick.min.js')}}"></script>
<!-- end slick slider -->
<!-- <script src="js/code.js"></script> -->
<script src="{{asset('website/templates/js/code-rtl.js')}}"></script>
<script src="{{asset('website/templates/js/cart.js')}}"></script>
<script src="{{asset('website/templates/js/favorite.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('website/templates/js/bootstrap-slider.min.js')}}"></script>
<script>
    $("#price").slider();
</script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    @if(session()->has('success'))
        setTimeout(function () {
            showMessage('success','@lang('institutioncp.success')','{{ session()->get('success') }}');
        }, 1000);
    @endif

    @if(session()->has('my-errors'))
        setTimeout(function () {
            showMessage('error','@lang('institutioncp.error')','{{ session()->get('my-errors') }}');
        }, 1000);
    @endif

    function showMessage(status,title,message) {
        toastr.options = {
            positionClass: 'toast-top-left',
            onclick: null,
            showMethod: 'slideDown',
            hideMethod: "slideUp",
            preventDuplicates: true,
        };
        toastr[status](message, title);
    }

    $('#loginForm').on('submit', function (e) {

        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            beforeSend: function () {
                $("#button-login").html('<img src="/preloader.gif"  loading="lazy" alt="">')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {

                showMessage('success','@lang('institutioncp.success')', response.message)
                setTimeout(() => location.reload(),500)
            },
            error: function (error) {
                setTimeout(() =>
                        showMessage('error','@lang('institutioncp.error')', error.responseJSON.errors[0])
                    ,500)

                $("#button-login").html(' سجل دخول')

            }, complete: function () {

            }
        });
    });


    var  cartItems = '{{(bool)\Illuminate\Support\Facades\Session::get('cart')}}';

    if(!cartItems){
        localStorage.setItem('itemsNumbers',0  );
        document.querySelector('.cart-basket span').textContent = 0;
    }

</script>
