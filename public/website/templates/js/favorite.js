
let favoriteProduct =   document.querySelectorAll('.add-product-to-favorite');


$(".add-product-to-favorite").click(function(){

    $(".wishlist a").removeAttr("onclick");
    var product_id = $(this).attr('data-id');

    var heartFavorite = $('.favorite-product-'+ product_id);

    $.ajax({
        url: "/my-favorite-products",
        type:"POST",
        beforeSend:function () {
            heartFavorite.hasClass('colorRed') ? heartFavorite.removeClass('colorRed') : heartFavorite.addClass('colorRed');
        },
        data:{
            product_id:product_id,
        },
        success:function(response){

            var data = response.data;

            localStorage.setItem('wishlistNumbers',data['total_wishlist']);

            document.querySelector('.wishlist span').textContent = data['total_wishlist'];

            $(".wishlist span ").css({"font-size":"40px"});

            if (data['total_wishlist'] === 0){
                window.location.href = '/';
            }
        },
        error: function(error) {

        },complete:function () {
            setTimeout(function () {
                $(".wishlist span ").css({"font-size":"20px"});
            },500);
        }
    });
});





function onLoadItemsNumber(){
    let itemsNumber = parseInt(localStorage.getItem('wishlistNumbers'));

    if (itemsNumber){
        localStorage.setItem('wishlistNumbers',itemsNumber  );
        document.querySelector('.wishlist span ').textContent = itemsNumber;
    }
}

onLoadItemsNumber();
