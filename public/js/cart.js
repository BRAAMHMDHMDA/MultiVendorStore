(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else {
		var a = factory();
		for(var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
	}
})(self, function() {
return /******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/cart.js ***!
  \******************************/
(function ($) {
  function reRenderCartMenu() {
    $.ajax({
      url: "/reRender-cart-menu",
      // Replace with your endpoint to fetch updated cart data
      method: 'get',
      success: function success(updatedCartHtml) {
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

  $('.item-quantity').on('change', function (e) {
    $.ajax({
      url: "/cart/" + $(this).data('id'),
      //data-id
      method: 'put',
      data: {
        quantity: $(this).val(),
        product_id: $(this).data('product_id'),
        _token: csrf_token
      },
      success: function success(response) {
        // re-render the CartMenu component
        reRenderCartMenu();
        $('#error').html('')
      },
      error: function error(response) {{
        $('#error').html(response.responseJSON.message)
      }}
    });
  });
  $('.remove-item').on('click', function (e) {
    var id = $(this).data('id');
    $.ajax({
      url: "/cart/" + id,
      //data-id
      method: 'delete',
      data: {
        _token: csrf_token
      },
      success: function success(response) {
        $("#".concat(id)).remove();
        $("#m".concat(id)).remove();
        reRenderCartMenu();
        // alert('Successfully Product Deleted');
      }
    });
  });
  $('.add-to-cart').on('click', function (e) {
    $.ajax({
      url: "/cart",
      method: 'post',
      data: {
        product_id: $(this).data('id'),
        quantity: $(this).data('quantity'),
        _token: csrf_token
      },
      success: function success(response) {
        // re-render the CartMenu component
        reRenderCartMenu();
        // $('#alert').css('display', 'block');
        $('#alert').append("<div style=\"width: 32%;display: inline-block;margin-right: 15px\" class=\"alert alert-success \" role=\"alert\">\n" +
            "  <strong>Added Successfully!</strong> Product Added To Cart.\n" +
            "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
            "    <span aria-hidden=\"true\">&times;</span>\n" +
            "  </button>\n" +
            "</div>");
      }
    });
  });

  $('.add-to-wishlist').on('click', function (e) {
    $.ajax({
      url: "/wishlist",
      method: 'post',
      data: {
        product_id: $(this).data('id'),
        _token: csrf_token
      },
      success: function success(response) {
        $('#alert').append("<div style=\"width: 32%;display: inline-block;margin-right: 15px\" class=\"alert alert-success \" role=\"alert\">\n" +
            "  <strong>Added Successfully!</strong> Product Added To Wishlist.\n" +
            "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
            "    <span aria-hidden=\"true\">&times;</span>\n" +
            "  </button>\n" +
            "</div>");
      },
      error: function error(){
        $('#alert').append("<div style=\"width: 32%;display: inline-block;margin-right: 15px\" class=\"alert alert-warning \" role=\"alert\">\n" +
            "  Product Already in Wishlist.\n" +
            "  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
            "    <span aria-hidden=\"true\">&times;</span>\n" +
            "  </button>\n" +
            "</div>");
      }
    });
  });
  $('.remove-wishlist').on('click', function (e) {
    var id = $(this).data('id');
    $.ajax({
      url: "/wishlist/" + id,
      //data-id
      method: 'delete',
      data: {
        _token: csrf_token
      },
      success: function success(response) {
        $("#".concat(id)).remove();
        // alert('Successfully Product Deleted');
      }
    });
  });

})(jQuery);
/******/ 	return __webpack_exports__;
/******/ })()
;
});