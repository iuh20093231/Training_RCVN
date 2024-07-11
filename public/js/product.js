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
                let pagination1 = $('#pagination1');
                let pagination2 = $('#pagination2');
                userTable.empty();// Xóa nội dung hiện tại của bảng
                pagination1.empty();// Xóa nội dung hiện tại của phân trang
                pagination2.empty();
                if(product.length === 0){
                    userTable.append('<tr><td colspan="6" id="no-data">Không có dữ liệu</td></tr>');
                } else{
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
                        <td>${product.product_name}</td>
                        <td>${product.description}</td>
                        <td>$${product.product_price}</td>
                        ${statusText}
                        <td>
                            <a href="#" class="update mr-1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a href="#" class="delete mr-1"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>`);
                    });
                    // if(product.length >= 20){
                        for (let i = 1; i <= response.last_page; i++) {
                            let activeClass = (i === response.current_page) ? 'active' : '';
                            pagination1.append(`
                                <li class="page-item ${activeClass}"><a class="page-link" href="#">${i}</a></li>
                            `);
                            pagination2.append(`
                                <li class="page-item ${activeClass}"><a class="page-link" href="#">${i}</a></li>
                            `);
                        }
                        $('.page-link').on('click', function(e) {
                            e.preventDefault();
                            let page = $(this).text();
                            loadProduct(page);
                        }); 
                    // }
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy danh sách người dùng:', error);
            }
        });
    }
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        loadProduct(1); // Gọi hàm loadUsers khi form được submit
    });
    $('#search').on('click', function(e) {
        e.preventDefault();
        $('#search-form').submit(); // Submit form khi nút tìm kiếm được click
    });
    $('#clear-search').on('click', function(e) {
        e.preventDefault();
        $('#product_name').val(''); 
        $('#is_sales').val(''); 
        $('#product_price_to').val('');
        $('#product_price_end').val('');
        loadProduct(1); // Gọi lại hàm loadUsers để load lại danh sách người dùng ban đầu
    });
    loadProduct(1);
});