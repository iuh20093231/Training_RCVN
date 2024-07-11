$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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
                        userTable.append(`<tr id="custormer_${custormer.id}">
                        <td>${index + 1 + (page - 1) * 20}</td>
                        <td>${custormer.customer_name}</td>
                        <td>${custormer.email}</td>
                        <td>${custormer.address}</td>
                        <td>${custormer.tel_num}</td>
                        <td>
                            <button type="button" name="update" id="update" class="btn update edit-customer" data-id="${custormer.id}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </td>
                      </tr>`);
                    });
                    // if(custormer.length >= 20){
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
                            loadCustomer(page);
                        });
                    // }
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
    $(document).on('click','.edit-customer',function(){
        var customerID = $(this).data('id');
        var row = $('#custormer_'+customerID);
        // lấy thông tin người dùng để hiển thị lên form update
        var stt = row.find('td:eq(0)').text();
        var customer_name = row.find('td:eq(1)').text();
        var email = row.find('td:eq(2)').text();
        var address = row.find('td:eq(3)').text();
        var tel_num = row.find('td:eq(4)').text();
        // Tạo form update ngay trên hàng dữ liệu
        var editForm = `
            <td>${stt}</td>
            <td><input type="text" class="form-control" name="customer_name" id="customer_name" value="${customer_name}"></td>
            <td><input type="email" class="form-control" name="email" id="email" value="${email}"></td>
            <td><input type="text" class="form-control" name="address" id="address" value="${address}"></td>
            <td><input type="text" class="form-control" name="tel_num" id="tel_num" value="${tel_num}"></td>
            <td>
                <button class="btn btn-success btn-sm save-user" data-id="${customerID}">Save</button>
                <button class="btn btn-secondary btn-sm cancel-edit" data-id="${customerID}">Cancel</button>
            </td>
        `;
        row.html(editForm); // Thay thế nội dung của hàng dữ liệu bằng form chỉnh sửa
    });
    // Xử lý dữ liệu khi click vào nút Save
    $(document).on('click','.save-user',function(){
        var customerID = $(this).data('id');
        var row = $('#custormer_'+customerID);
        // Lấy dữ liệu từ form chỉnh sửa
        var customer_name = row.find('input[name="customer_name"]').val();
        var email = row.find('input[name="email"]').val();
        var tel_num = row.find('input[name="tel_num"]').val();
        var address = row.find('input[name="address"]').val();
        $.ajax({
            url: '/custormer/'+ customerID,
            method: 'PUT',
            data: {
                customer_name: customer_name,
                email: email,
                address: address,
                tel_num: tel_num
                
            },
            success: function(response){
                // console.log('Response from server:', response);
                // $customer = response.data;
                // if(response.message === 'Customer updated successfully'){
                var updateRow = `
                <td>${row.find('td:eq(0)').text()}</td>
                <td>${customer_name}</td>
                <td>${email}</td>
                <td>${address}</td>
                <td>${tel_num}</td>
                <td>
                    <button type="button" name="update" id="update" class="btn update edit-customer" data-id="${customerID}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                </td>
                `;
                row.html(updateRow);
                alert('Update thành công');
                // } else {
                //     alert('Update thất bại!');
                // }
            },
            error: function(error) {
                console.error('Error updating user:', error);
            }
        });
    });
    // Xử lý sự kiện hủy
    $(document).on('click','.cancel-edit', function(){
        var customerID = $(this).data('id');
        var row = $('#custormer_'+customerID);
        $.ajax({
            url: '/custormer/'+customerID,
            type: 'GET',
            success: function(customer){
                var originalRow = `
                <td>${row.find('td:eq(0)').text()}</td>
                <td>${customer.customer_name}</td>
                <td>${customer.email}</td>
                <td>${customer.address}</td>
                <td>${customer.tel_num}</td>
                <td>
                    <button type="button" name="update" id="update" class="btn update edit-customer" data-id="${customerID}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                </td>
            `;
                row.html(originalRow);
            },
            error: function(error) {
                console.error('Error fetching user:', error);
            }
        });
    });
});