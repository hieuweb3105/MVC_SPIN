
$(document).ready(function() {
    // 1. Khi nhấn nút, kích hoạt chọn file
    $('#btn_import').click(function() {
        $('#file_excel').click();
    });

    // 2. Khi người dùng chọn file xong
    $('#file_excel').change(function() {
        var file_data = $('#file_excel').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);

        $.ajax({
            url: 'import',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function() {
                $('#btn_import').text('Đang xử lý...').prop('disabled', true);
            },
            success: function(res) {
                location.reload();
            },
            error: function() {
                alert("Có lỗi xảy ra trong quá trình upload.");
                $('#btn_import').text('Nhập danh sách').prop('disabled', false);
            }
        });
    });
});