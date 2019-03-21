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
            $('body').html(response);
            console.log(status);
        }
    );
    return false;
});