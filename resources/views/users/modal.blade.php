{{-- Modal Xóa thành viên --}}
<div class='modal fade' id='myModal' role='dialog' aria-label='resultModalLabel'  aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content min-h-65'>
            <div class='modal-body text-center'>
                <div class='icon-status mt-2 p-5'>     
                    <i class="fa fa-exclamation-triangle text-warning " aria-hidden="true" style="font-size: 70px;"></i>
                    <h3 class='text-danger mt-2'>Nhắc nhở</h3>
                    <p class="p">Bạn có chắc muốn xóa người dùng <span id="user-name-to-delete"></span><span id="user-id-to-delete" style="display: none;"></span> này không?</p>
                </div>
                    <input type='button' class='btn btn-dark mb-3' data-dismiss='modal' value='Hủy'>
                    <input type='button' class='btn btn-danger mb-3' id="btn-delete" value='Okay'>
                </div>
         </div>
    </div>
</div>
{{-- Modal khóa người dùng --}}
<div class='modal fade' id='lockUser' role='dialog' aria-label='resultModalLabel'  aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content min-h-65'>
            <div class='modal-body text-center'>
                <div class='icon-status mt-2 p-5'>     
                    <i class="fa fa-lock text-warning" aria-hidden="true" style="font-size: 70px;"></i>
                    <h3 class='text-danger mt-2'>Nhắc nhở</h3>
                    <p class="p">Bạn có chắc muốn khóa/mở khóa người dùng <span id="user-name-to-lock"></span><span id="user-id-to-lock" style="display: none;"></span><span id="status" style="display: none;"></span>  này không?</p>
                </div>
                    <input type='button' class='btn btn-dark mb-3' data-dismiss='modal' value='Hủy'>
                    <input type='button' class='btn btn-danger mb-3' id="btn-lock" value='Okay'>
                </div>
         </div>
    </div>
</div>