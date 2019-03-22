$('#add-product').on('click', function () {
    let id = $(this).data('id');
    $.post('?c=cart&a=addproduct', {id: id, quantity: 1},
        function (response, status) {
            if (response.result === 'OK') {
                alert(`Товар id # ${id} добавлен в корзину`);
            } else {
                alert('error' + status);
            }
        }
    );
});

$('#load_more').on('click', function () {
    let page = $(this).data('page');
    $.post('?c=product&a=page', {page: page},
        function (response, status) {
            let body = $('body');
            body.html(response);
            $('html, body').animate({scrollTop: $(document).height()}, 1500);
            console.log(status);
        }
    );

    return false;
});