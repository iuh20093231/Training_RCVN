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
                console.log(response); 
                let custormer = response.data;
                let userTable = $('#user-table');
                userTable.empty();
                let pagination1 = $('#pagination1');
                let pagination2 = $('#pagination2');
                pagination1.empty();
                pagination2.empty();
                $('#pagination-info').empty();
                if (custormer.length === 0) {
                    userTable.append('<tr><td colspan="6" id="no-data">Không có dữ liệu</td></tr>');
                } else {
                    let from = (response.current_page - 1) * response.per_page + 1;
                    let to = from + custormer.length - 1;
                    let total = response.total;
                    $('#pagination-info').html(`Hiển thị từ ${from} đến ${to} trong tổng số <strong>${total}</strong> khách hàng`);
                    custormer.forEach(function(custormer,index){
                        userTable.append(`<tr id="custormer_${custormer.id}">
                        <td>${index + 1 + (page - 1) * 20}</td>
                        <td>${custormer.customer_name}</td>
                        <td>${custormer.email}</td>
                        <td>${custormer.address}</td>
                        <td>${custormer.tel_num}</td>
                        <td>
                            <button type="button" name="update" id="update" class="btn update edit-customer" data-id="${custormer.id}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            <button  class="btn delete mr-1 deleteCustomer" data-id="${custormer.id}" data-name="${custormer.customer_name}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
                            loadCustomer(page);
                        });
                        $('.next-page').on('click', function (e) {
                            e.preventDefault();
                            const currentPage = response.current_page;
                            if (currentPage < response.last_page) {
                                loadCustomer(currentPage + 1);
                            }
                        });
    
                        $('.prev-page').on('click', function (e) {
                            e.preventDefault();
                            const currentPage = response.current_page;
                            if (currentPage > 1) {
                                loadCustomer(currentPage - 1);
                            }
                        });
                    } else {
                        $('#pagination-wrapper').hide();
                        $('#pagination-wrapper2').hide();
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
        loadCustomer(1);
    });
    $('#search').on('click', function(e) {
        e.preventDefault();
        $('#search-form').submit(); 
    });
    $('#clear-search').on('click', function(e) {
        e.preventDefault();
        $('#customer_name').val(''); 
        $('#email').val(''); 
        $('#is_active').val('');
        $('#address').val('');
        loadCustomer(1); 
    });
    $('#addCustomer').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.form-control').removeClass('is-invalid'); 
        $(this).find('.invalid-feedback').text(''); 
        $('#add_customer_name').val('');
        $('#add_email').val('');
        $('#add_tel_num').val('');
        $('#add_address').val('');
        $('#add_is_active').prop('checked', false);
    });
    $('#export').on('click', function(e) {
        e.preventDefault();
        const data = {
            customer_name: $('#customer_name').val(),
            email: $('#email').val(),
            is_active: $('#is_active').val(),
            address: $('#address').val()
        };
        const queryString = $.param(data);
        const url = `/export?${queryString}`;
        window.location.href = url; 
    });
    loadCustomer(1);
    $(document).on('click','.edit-customer',function(){
        var customerID = $(this).data('id');
        var row = $('#custormer_'+customerID);
        var stt = row.find('td:eq(0)').text();
        var customer_name = row.find('td:eq(1)').text();
        var email = row.find('td:eq(2)').text();
        var address = row.find('td:eq(3)').text();
        var tel_num = row.find('td:eq(4)').text();
        var editForm = `
            <td>${stt}</td>
            <td><input type="text" class="form-control" name="customer_name" id="customer_name" value="${customer_name}">
            <div class="error-message"></div></td>
            <td><input type="email" class="form-control" name="email" id="email" value="${email}">
            <div class="error-message"></div></td>
            <td><input type="text" class="form-control" name="address" id="address" value="${address}">
            <div class="error-message"></div></td>
            <td><input type="text" class="form-control" name="tel_num" id="tel_num" value="${tel_num}">
            <div class="error-message"></div></td>
            <td>
                <button type="submit" class="btn btn-success btn-sm save-user" data-id="${customerID}">Save</button>
                <button class="btn btn-secondary btn-sm cancel-edit" data-id="${customerID}">Cancel</button>
            </td>
        `;
        row.html(editForm); 
    });
    $(document).on('click','.save-user',function(){
        var customerID = $(this).data('id');
        var row = $('#custormer_'+customerID);
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
                var updateRow = `
                <td>${row.find('td:eq(0)').text()}</td>
                <td>${customer_name}</td>
                <td>${email}</td>
                <td>${address}</td>
                <td>${tel_num}</td>
                <td>
                    <button type="button" name="update" id="update" class="btn update edit-customer" data-id="${customerID}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <button  class="btn delete mr-1 deleteProduct" data-id="${customerID}" data-name="${customer_name}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
                `;
                row.html(updateRow);
            },
            error: function(xhr) {
                console.log('Error:', xhr); 
                row.find('.error-message').remove();
    
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    for (var key in errors) {
                        var errorMessages = errors[key];
                        var errorMessageHtml = `<div class="error-message text-danger">${errorMessages.join(', ')}</div>`;
                        row.find('input[name="' + key + '"]').after(errorMessageHtml);
                    }
                } else {
                    console.error('Error updating user:', xhr);
                }
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
                    <button  class="btn delete mr-1 deleteProduct" data-id="${customerID}" data-name="${customer.customer_name}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
            `;
                row.html(originalRow);
            },
            error: function(error) {
                console.error('Error fetching user:', error);
            }
        });
    });
    $('#file').change(function() {
        var filename = $(this).val().split('\\').pop(); // Lấy tên file từ đường dẫn tập tin
        $('#tenfile').val(filename); // Hiển thị tên file trong input
    });
    // Delete Customer
    $(document).on('click', '.deleteCustomer', function() {
        var id = $(this).data('id');
        var customer_name = $(this).data('name');
        $('#customer-id').text(id);
        $('#customer-name').text(customer_name);
        $('#myModal').modal('show');
    });
    $(document).on('click','#btn-delete',function(){
        var id = $('#customer-id').text();
        $.ajax({
            url: '/custormer/'+id,
            method: 'DELETE',
            success: function(response){
                if(response.message === 'Customer deleted successfully'){
                    // xóa 
                    $(this).closest('tr').remove();
                    $('#myModal').modal('hide');
                    loadCustomer(1);
                }else{
                    alert('Xóa thất bại!');
                }
            },
            error: function(error) {
                console.error(error);
                alert('Error deleting product');
            }
        });
    });
});