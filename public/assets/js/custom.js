$(document).ready(function () {

    // Increment button click handler
    $('.plus').click(function (e) {
        e.preventDefault();
        // Get the current quantity value
        var quantity = parseInt($('.qty-input').val());

        // Increment the quantity
        console.log(quantity)
        $('.qty-input').val(quantity + 1);
    });

    // Decrement button click handler
    $('.minus').click(function (e) {
        e.preventDefault();
        // Get the current quantity value
        var quantity = parseInt($('.qty-input').val());

        // Decrement the quantity, but not below 1
        if (quantity > 1) {
            $('.qty-input').val(quantity - 1);
        }
    });

    // Increment button click handler
    $('.increment-btn').click(function (e) {
        e.preventDefault();
        var incre_value = $(this).parents('.quantity').find('.qty-input').val();
        var value = parseInt(incre_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });

    $('.decrement-btn').click(function (e) {
        e.preventDefault();
        var decre_value = $(this).parents('.quantity').find('.qty-input').val();
        var value = parseInt(decre_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            console.log(value)
            $(this).parents('.quantity').find('.qty-input').val(value);
        }
    });
});


// Update Cart Data
$(document).ready(function () {

    $('.changeQuantity').click(function (e) {
        // alert("hello world");
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var thisClick = $(this);
        var quantity = $(this).closest(".cartpage").find('.qty-input').val();
        var produk_id = $(this).closest(".cartpage").find('.produk_id').val();
        // var produk_id = $this.data('product-id');
        // alert(produk_id);
        var data = {
            '_token': $('input[name=_token]').val(),
            'quantity': quantity,
            'produk_id': produk_id,
        };

        $.ajax({
            url: 'update-to-cart',
            type: 'POST',
            data: data,
            success: function (response) {
                // window.location.reload();
                // console.log(response.gtprice)
                thisClick.closest(".cartpage").find('.cart-grand-total-price').text(response.gtprice);
                // $('#totalajaxcall').load(location.href + ' .totalpricingload');
                // this.closest(".totalajaxcall").find('.totalpricingload').load(location.href + '');
                // $('.totalpricingload').html(response.totalpricingload);

                // thisClick.closest(".cartpage").find('.cart-grand-total-price').text(response.gtprice);
                // $('#totalajaxcall').load(location.href + ' .totalpricingload'); //harus ada spasinya
                // $('#totalajaxcall').load(location.href + ' .totalallproduk');
                // alertify.set('notifier', 'position', 'top-right');
                // alertify.success(response.status);
            }
        });
    });
});


