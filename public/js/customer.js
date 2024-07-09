$(document).ready(function(){
    function loadCustomer(page){
        const data = {
            customer_name: $('#customer_name').val(),
            email: $('#email').val(),
            is_active: $('#is_active').val(),
            address: $('#address').val(),
            page: page
        };
        console.log('Sending data:', data);
        $.ajax({
            url: '/custormer/list',
            type: 'GET',
            data: data,
            success: function(response){
                console.log(response); // Kiểm tra dữ liệu trả về
                let custormer = response.data;
                let userTable = $('#user-table');
                let pagination1 = $('#pagination1');
                let pagination2 = $('#pagination2');
                userTable.empty();// Xóa nội dung hiện tại của bảng
                pagination1.empty();// Xóa nội dung hiện tại của phân trang
                pagination2.empty();
                if (custormer.length === 0) {
                    userTable.append('<tr><td colspan="6" id="no-data">Không có dữ liệu</td></tr>');
                } else {
                    custormer.forEach(function(custormer,index){
                        let statusText;
                        switch(custormer.is_active) {
                            case 0:
                                statusText = '<td class="text-danger">Không hoạt động</td>';
        
                                break;
                            case 1:
                                statusText = '<td class="text-success">Đang hoạt động</td>';
                                break;
                        }
                        userTable.append(`<tr>
                        <td>${index + 1 + (page - 1) * 20}</td>
                        <td>${custormer.customer_name}</td>
                        <td>${custormer.email}</td>
                        <td>${custormer.address}</td>
                        <td>${custormer.tel_num}</td>
                        <td>
                            <button type="submit" name="update" id="update" class="btn"><a href="#" class="update"><i class="fa fa-pencil" aria-hidden="true"></i></a></button>
                        </td>
                      </tr>`);
                    });
                    if(custormer.length >= 20){
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
                            loadUsers(page);
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy danh sách người dùng:', error);
            }
        })
    }
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        loadCustomer(1); // Gọi hàm loadUsers khi form được submit
    });
    $('#search').on('click', function(e) {
        e.preventDefault();
        $('#search-form').submit(); // Submit form khi nút tìm kiếm được click
    });
    $('#clear-search').on('click', function(e) {
        e.preventDefault();
        $('#customer_name').val(''); 
        $('#email').val(''); 
        $('#is_active').val('');
        $('#address').val('');
        loadCustomer(1); // Gọi lại hàm loadUsers để load lại danh sách người dùng ban đầu
    });
    loadCustomer(1);
});