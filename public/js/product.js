$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function loadProduct(page){
        const data = {
            product_name: $('#product_name').val(),
            is_sales: $('#is_sales').val(),
            product_price_to: $('#product_price_to').val(),
            product_price_end: $('#product_price_end').val(),
            page: page
        };
        console.log('Sending data:', data);
        $.ajax({
            url: '/product/list',
            type: 'GET',
            data: data,
            success: function(response){
                let product = response.data;
                let userTable = $('#user-table');
                userTable.empty();
                let pagination1 = $('#pagination1');
                let pagination2 = $('#pagination2');
                pagination1.empty();
                pagination2.empty();
                $('#pagination-info').empty();
                if(product.length === 0){
                    userTable.append('<tr><td colspan="6" id="no-data">Không có dữ liệu</td></tr>');
                } else{
                    let from = (response.current_page - 1) * response.per_page + 1;
                    let to = from + product.length - 1;
                    let total = response.total;
                    $('#pagination-info').html(`Hiển thị từ ${from} đến ${to} trong tổng số <strong>${total}</strong> sản phẩm`);
                    product.forEach(function(product,index){
                        let statusText;
                        switch(product.is_sales) {
                            case 0:
                                statusText = '<td class="text-danger">Ngừng bán</td>';
                                break;
                            case 1:
                                statusText = '<td class="text-success">Đang bán</td>';
                                break;
                            default:
                                statusText = 'Không xác định';
                                break;
                        }   
                        userTable.append(`<tr>
                        <td>${index + 1 + (page - 1) * 20}</td>
                        <td>
                            <div class="product-name">
                            ${product.product_name}
                            <img class="product-image" src="storage/${product.product_image}" alt="Hình sản phẩm">
                        </div>
                        </td>
                        <td>${product.description}</td>
                        <td>$${product.product_price}</td>
                        ${statusText}
                        <td>
                            <a href="/product/${product.product_id}/edit" class="btn update mr-1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <button  class="btn delete mr-1 deleteProduct" data-id="${product.product_id}" data-name="${product.product_name}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                      </tr>`);
                    });
                    if(total>20){
                        $('#pagination-wrapper').show();
                        $('#pagination-wrapper2').show();
                        // Thêm nút phân trang ngược lại
                        pagination1.append('<a href="#" class="prev-page">&laquo;</a>');
                        pagination2.append('<a href="#" class="prev-page">&laquo;</a>');
                        for (let i = 1; i <= response.last_page; i++) {
                            let activeClass = (i === response.current_page) ? 'current' : '';
                            pagination1.append(`
                                <a href="#" data-page="${i}" class="page-link ${activeClass}" style="line-height:13px;">${i}</a>
                            `);
                            pagination2.append(`
                                <a href="#" data-page="${i}" class="page-link ${activeClass}" style="line-height:13px;">${i}</a>
                            `);
                        }
                         // Thêm nút phân trang tiếp theo
                         pagination1.append('<a href="#" class="next-page">&raquo;</a>');
                         pagination2.append('<a href="#" class="next-page">&raquo;</a>');
                        $('.page-link').on('click', function(e) {
                            e.preventDefault();
                            let page = $(this).text();
                            loadProduct(page);
                        });
                        $('.next-page').on('click', function (e) {
                            e.preventDefault();
                            const currentPage = response.current_page;
                            if (currentPage < response.last_page) {
                                loadUser(currentPage + 1);
                            }
                        });
    
                        $('.prev-page').on('click', function (e) {
                            e.preventDefault();
                            const currentPage = response.current_page;
                            if (currentPage > 1) {
                                loadUser(currentPage - 1);
                            }
                        }); 
                    } else {
                        $('#pagination-wrapper').hide();
                        $('#pagination-wrapper2').hide();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy danh sách sản phẩm:', error);
            }
        });
    }
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        loadProduct(1); 
    });
    $('#search').on('click', function(e) {
        e.preventDefault();
        $('#search-form').submit(); 
    });
    $('#clear-search').on('click', function(e) {
        e.preventDefault();
        $('#product_name').val(''); 
        $('#is_sales').val(''); 
        $('#product_price_to').val('');
        $('#product_price_end').val('');
        loadProduct(1); 
    });
    loadProduct(1);
    // Delete Product
    $(document).on('click', '.deleteProduct', function() {
        var product_id = $(this).data('id');
        var product_name = $(this).data('name');
        $('#product_name-to-delete').text(product_name);
        $('#product-id-to-delete').text(product_id);
        $('#myModal').modal('show');
    });
    $(document).on('click','#btn-delete',function(){
        var product_id = $('#product-id-to-delete').text();
        $.ajax({
            url: '/product/'+product_id,
            method: 'DELETE',
            success: function(response){
                if(response.message === 'Xóa sản phẩm thành công'){
                    $(this).closest('tr').remove();
                    alert('Xóa thành công');
                    $('#myModal').modal('hide');
                    loadProduct(1);
                }else{
                    alert('Xóa thất bại!');
                }
            },
            error: function(error) {
                console.error(error);
                alert('Xóa sản phẩm bị lỗi');
            }
        });
    });

});