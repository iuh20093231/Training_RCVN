document.addEventListener("DOMContentLoaded", function() {
    function uploadImage() {
        var input = document.getElementById('product_image');
        var file = input.files[0] ?? input.value;
        // console.log('file ne', file.name);
        if (file) {
            var allowedExtensions = /(\.png|\.jpg|\.jpeg)$/i;
            if (!allowedExtensions.exec(file.name)) {
                alert('Chỉ cho phép upload các file có định dạng: png, jpg, jpeg.');
                input.value = '';
                return false;
            }
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('imagePreview');
                let filename = file.name;
                preview.src = e.target.result;
                console.log(file);
                input.value = file;
            }
            reader.readAsDataURL(file);
        }
        // input.value = '';
    }
    function removeImage() {
        var input = document.getElementById('product_image');
        var preview = document.getElementById('imagePreview');
        
        input.value = '';  // Clear the input file
        preview.src = '';  // Clear the preview image
    }

    window.uploadImage = uploadImage;
    window.removeImage = removeImage;
});
$(document).ready(function() {
    $('#product_image').change(function() {
        var filename = $(this).val().split('\\').pop(); // Lấy tên file từ đường dẫn tập tin
        $('#tenfile').val(filename); // Hiển thị tên file trong input
    });
});