$(document).ready(function(){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
    function loadUser(page){
        const data = {
            name: $('#name').val(),
            email: $('#email').val(),
            group_role: $('#group_role').val(),
            is_active: $('#is_active').val(),
            page: page
        };
        console.log('Sending data:', data);
        $.ajax({
            url: '/users/list',
            type: 'GET',
            data: data,
            success: function(response){
                console.log(response); // Kiểm tra dữ liệu trả về
                let users = response.data;
                let userTable = $('#user-table');
                let pagination1 = $('#pagination1');
                let pagination2 = $('#pagination2');
                userTable.empty();// Xóa nội dung hiện tại của bảng
                pagination1.empty();// Xóa nội dung hiện tại của phân trang
                pagination2.empty();
                // Thêm nút phân trang ngược lại
                pagination1.append('<a href="#" class="prev-page">&laquo;</a>');
                pagination2.append('<a href="#" class="prev-page">&laquo;</a>');
                if (users.length === 0) {
                    userTable.append('<tr><td colspan="6" id="no-data">Không có dữ liệu</td></tr>');
                } else {
                    let from = (response.current_page - 1) * response.per_page + 1;
                    let to = from + users.length - 1;
                    let total = response.total;
                    $('#pagination-info').html(`Hiển thị từ ${from} đến ${to} trong tổng số <strong>${total}</strong> người dùng`);
                    users.forEach(function(user,index){
                        let statusText;
                        switch(user.is_active) {
                            case 0:
                                statusText = '<td class="text-danger">Tạm khóa</td>';
        
                                break;
                            case 1:
                                statusText = '<td class="text-success">Đang hoạt động</td>';
                                break;
                            default:
                                statusText = 'Không xác định';
                                break;
                        }                               // Index phân trang 10
                        userTable.append(`<tr><td>${index + 1 + (page - 1) * 20}</td><td>${user.name}</td><td>${user.email}</td><td>${user.group_role}</td>${statusText}<td>
                            <button class="btn update mr-1 edit-user"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            <button  class="btn delete mr-1 deleteUser" data-id="${user.id}" data-name="${user.name}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button  class="btn deloy  mr-1 lockUpUser" data-id="${user.id}" data-name="${user.name}" data-status="${user.is_active}"><i class="fa fa-user-times" aria-hidden="true"></i></button>
                            </td></tr>`);
                    });
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
                            loadUser(page);
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
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy danh sách người dùng:', error);
            }
            
        });
    }
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        loadUser(1); // Gọi hàm loadUsers khi form được submit
    });
    // Gắn sự kiện click cho nút tìm kiếm
    $('#search').on('click', function(e) {
        e.preventDefault();
        $('#search-form').submit(); // Submit form khi nút tìm kiếm được click
    });
    $('#clear-search').on('click', function(e) {
        e.preventDefault();
        $('#name').val(''); // Xóa dữ liệu trên input Tên
        $('#email').val(''); // Xóa dữ liệu trên input Email
        $('#group_role').val(''); // Xóa dữ liệu trên dropdown Nhóm
        $('#is_active').val(''); // Xóa dữ liệu trên dropdown Trạng thái
        loadUser(1); // Gọi lại hàm loadUsers để load lại danh sách người dùng ban đầu
    });
    loadUser(1);
    // Update
    $(document).on('click', '.edit-user', function(e) {
        e.preventDefault();
        var userId = $(this).closest('tr').find('.deleteUser').data('id');

        // Gọi Ajax để lấy thông tin user
        $.ajax({
            url: '/users/' + userId,
            method: 'GET',
            success: function(response) {
                // Điền thông tin vào form
                $('#user_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_email').val(response.email);
                $('#edit_group').val(response.group_role);

                // Kiểm tra giá trị của is_active và cập nhật trạng thái của checkbox
                $('#edit_is_active').prop('checked', response.is_active == 1);

                // Hiện modal
                $('#updateUser').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy thông tin người dùng:', error);
            }
        });
    });

    // Xử lý submit form chỉnh sửa
    $('#editUserForm').submit(function(e) {
        e.preventDefault();

        var userId = $('#user_id').val();
        var formData = $(this).serializeArray();
        formData.push({ name: 'is_active', value: $('#edit_is_active').is(':checked') ? 1 : 0 });
        $.ajax({
            url: '/users/' + userId,
            method: 'PUT',
            data: formData,
            success: function(response) {
                // Cập nhật thông tin user trong bảng (nếu cần)
                loadUser(1);

                // Đóng modal
                $('#updateUser').modal('hide');
            },
            error: function(xhr, status, error) {
                var response = xhr.responseJSON;
                if (response.errors) {
                    if (response.errors.name) {
                        $('#edit_name').after('<span class="error text-danger">' + response.errors.name[0] + '</span>');
                    }
                    if (response.errors.email) {
                        $('#edit_email').after('<span class="error text-danger">' + response.errors.email[0] + '</span>');
                    }
                    if (response.errors.password) {
                        $('#edit_password').after('<span class="error text-danger">' + response.errors.password[0] + '</span>');
                    }
                    if (response.errors.reset_password) {
                        $('#edit_reset_password').after('<span class="error text-danger">' + response.errors.reset_password[0] + '</span>');
                    }
                    if (response.errors.group_role) {
                        $('#edit_group_role').after('<span class="error text-danger">' + response.errors.group_role[0] + '</span>');
                    }
                    if (response.errors.is_active) {
                        $('#edit_is_active').after('<span class="error text-danger">' + response.errors.is_active[0] + '</span>');
                    }
                } else {
                    console.error('Lỗi khi cập nhật người dùng:', error);
                }
            }
        });
    });
    $('#addUsers').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.form-control').removeClass('is-invalid'); // Xoá lớp lỗi
        $(this).find('.invalid-feedback').text(''); // Xoá thông báo lỗi
        $('#add_name').val('');
        $('#add_email').val('');
        $('#add_password').val('');
        $('#add_reset_password').val('');
        $('#add_is_active').prop('checked', false);   
    });
    $('#updateUser').on('hidden.bs.modal', function() {
        $('#editUserForm')[0].reset();
        $('.error').remove();
    });
    // Delete Người dùng
    $(document).on('click', '.deleteUser', function() {
        var userID = $(this).data('id');
        var userName = $(this).data('name');
        $('#user-name-to-delete').text(userName);
        $('#user-id-to-delete').text(userID);
        $('#myModal').modal('show');
    });
    $(document).on('click','#btn-delete',function(){
        var userId = $('#user-id-to-delete').text();
        $.ajax({
            url: '/users/'+userId,
            method: 'DELETE',
            success: function(response){
                if(response.message === 'User deleted successfully'){
                    // xóa 
                    $(this).closest('tr').remove();
                    // Hiển thị thông báo thành công
                    alert('Xóa thành công');
                    $('#myModal').modal('hide');
                    location.reload();
                }else{
                    alert('Xóa thất bại!');
                }
            },
            error: function(error) {
                console.error(error);
                alert('Error deleting user');
            }
        });
    });
    // Khóa/ Mở người dùng
    $(document).on('click','.lockUpUser',function(){
        var userID = $(this).data('id');
        var userName = $(this).data('name');
        var isActive = $(this).data('status');
        $('#user-name-to-lock').text(userName);
        $('#user-id-to-lock').text(userID);
        $('#status').text(isActive);
        $('#lockUser').modal('show');
    });
    $(document).on('click','#btn-lock',function(){
        var userId = $('#user-id-to-lock').text();
        var status = $('#status').text();
        $.ajax({
            url: '/users/'+userId+'/updatestatus',
            method: 'POST',
            data: {
                is_active: status
            },
            success: function(response){
                if(response.message === 'Thành viên đã được khóa/mở khóa thành công!'){
                    alert('Thành viên đã được khóa/mở khóa thành công!');
                    $('#lockUser').modal('hide');
                    location.reload();
                }else{
                    alert('Thất bại');
                }
            }
        });
    });

});