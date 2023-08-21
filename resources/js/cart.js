(function($) {
    function reRenderCartMenu() {
        $.ajax({
            url: "/reRender-cart-menu", // Replace with your endpoint to fetch updated cart data
            method: 'get',
            success: function(updatedCartHtml) {
                // $('#cart-menu-container').html(updatedCartHtml);
                $('#cart-menu-container').replaceWith(updatedCartHtml);
            }
        });
    }
    window.removeProduct = function (ID) {
        $.ajax({
            url: "/cart/" + ID,
            //data-id
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: function success(response) {
                $("#".concat(ID)).remove();
                $("#m".concat(ID)).remove();
                // re-render the CartMenu component
                reRenderCartMenu();
                // alert('Successfully Product Deleted');
            }
        });
    };
    $('.item-quantity').on('change', function(e) {

        $.ajax({
            url: "/cart/" + $(this).data('id'), //data-id
            method: 'put',
            data: {
                quantity: $(this).val(),
                _token: csrf_token
            },
            success: response => {
                // re-render the CartMenu component
                reRenderCartMenu();
            }
        });
    });

    $('.remove-item').on('click', function(e) {

        let id = $(this).data('id');
        $.ajax({
            url: "/cart/" + id, //data-id
            method: 'delete',
            data: {
                _token: csrf_token
            },
            success: response => {
                $(`#${id}`).remove();
                $(`#m${id}`).remove();

                reRenderCartMenu();
                // alert('Successfully Product Deleted');

            }
        });
    });

    // $('#cart-menu-container').on('click', '.remove-item', function(e) {
    //
    //     let id = $(this).data('id');
    //         $.ajax({
    //             url: "/cart/" + id, //data-id
    //             method: 'delete',
    //             data: {
    //                 _token: csrf_token
    //             },
    //             success: response => {
    //                 // $(`#${id}`).remove();
    //                 reRenderCartMenu();
    //                 // alert('Successfully Product Deleted');
    //
    //             }
    //         });
    // });

    $('.add-to-cart').on('click', function(e) {

        $.ajax({
            url: "/cart",
            method: 'post',
            data: {
                product_id: $(this).data('id'),
                quantity: $(this).data('quantity'),
                _token: csrf_token
            },
            success: response => {
                // re-render the CartMenu component
                reRenderCartMenu();

                alert('Successfully Product Added');
            }
        });
    });

})(jQuery);