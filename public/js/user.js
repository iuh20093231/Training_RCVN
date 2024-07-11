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
                if (users.length === 0) {
                    userTable.append('<tr><td colspan="6" id="no-data">Không có dữ liệu</td></tr>');
                } else {
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
                            <a href="/users/${user.id}/edit" class="update mr-1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <button  class="btn delete mr-1 deleteUser" data-id="${user.id}" data-name="${user.name}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <button  class="btn deloy  mr-1 lockUpUser" data-id="${user.id}" data-name="${user.name}" data-status="${user.is_active}"><i class="fa fa-user-times" aria-hidden="true"></i></button>
                            </td></tr>`);
                    });
                    // if(response.pagination == true){
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
                            loadUser(page);
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
                    loadUser(1);
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
                    loadUser(1);
                }else{
                    alert('Thất bại');
                }
            }
        });
    });

});