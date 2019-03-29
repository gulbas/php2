$('#add-product').on('click', function () {
    let id = $(this).data('id');
    $.post('/cart/addProduct/', {id: id, quantity: 1},
        function (response, status) {
            // if (response.result === 'OK') {
            //     alert(`Товар id # ${id} добавлен в корзину`);
            // } else {
            //     alert('error' + status);
            // }
            $('#count').html(response.quantityOfGoodsInTheCart);
        }
    );
});

$('#load_more').on('click', function () {
    let page = $(this).data('page');
    $.post('/product/page/', {page: page},
        function (response, status) {
        // window.location.reload();
            let body = $('body');
            body.html(response);
            $('html, body').animate({scrollTop: $(document).height()}, 1500);
            console.log(status);
        }
    );
    return false;
});

$('.deleteItemCart').on('click', function () {
    let id = $(this).data('id');
    $.post('/cart/remove/', {id: id},
        function (response) {
            let body = $('body');
            body.html(response);
        }
    );
    return false;
});

$('.deleteProduct').on('click', function () {
    let id = $(this).data('id');
    $.post('/product/remove/', {id: id},
        function (response) {
            let body = $('body');
            body.html(response);
        }
    );
    return false;
});

$('.status').on('click', function () {
    let id = $(this).data('id');
    $.post('/admin/order/', {change: id},
        function (response) {
            let body = $('body');
            body.html(response);
        }
    );
    return false;
});

