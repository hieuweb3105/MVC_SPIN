<link rel="stylesheet" href="<?= URL_P_V ?>css/list-guest.css?v=1.0.1">

<div style="margin-top:20vh" class="row justify-content-center align-items-center">
    <div class="col-12 d-flex align-items-center justify-content-center mt-4">
        <div class="text-gold h5">
            <?= $info_prize['name_prize'] ?> - <?= $info_prize['quantity_prize'] > 10 ? $info_prize['quantity_prize'] : '0' . $info_prize['quantity_prize'] ?> giải <?= $info_prize['name_gift_prize'] ?>
        </div>
    </div>
    <div class="col-12 col-md-8 mt-lg-5">
        <div class="col-12 mb-2 d-flex gap-1">
            <button type="button" id="btn_export" class="btn btn-sm btn-danger text-warning border-warning px-3 <?= $list_guest ?: 'disabled' ?>">
                <i class="bi bi-file-earmark-text"></i>Xuất danh sách
            </button>
            <a href="/result/<?=$info_prize['id_prize']?>/reset" class="btn btn-sm btn-danger text-warning border-warning px-3 <?= $list_guest ?: 'disabled' ?>">
                <i class="bi bi-arrow-repeat"></i>Reset giải
            </a>
            <input type="file" id="file_excel" accept=".xlsx, .xls" class="d-none">
        </div>
        <table class="table table-dark table-hover">
        <thead>
            <tr class="align-middle">
                <th class="bg-dark-80 blur-6">STT</th>
                <th class="text-center bg-dark-80 blur-6">Mã số</th>
                <th class="text-end bg-dark-80 blur-6">Giải trúng</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($list_guest) :
                $i = 0;
                foreach ($list_guest as $guest): 
                extract($guest);
                $i++;
            ?>
                <tr class="align-middle fw-light small">
                    <th class="fw-light bg-dark-80 blur-6">
                        <?= $i ?>
                    </th>
                    <td class="text-center bg-dark-80 blur-6">
                        <?= str_pad($name_guest, 4, "0", STR_PAD_LEFT) ?>
                    </td>
                    <td class="text-end bg-dark-80 blur-6">
                        <?= $name_prize ?? '<span class="text-light-40">không</span>' ?>
                    </td>
                </tr>
            <?php 
                endforeach;
            else : 
            ?>
            <tr class="align-middle fw-light small">
                <td colspan="3" class="fw-light bg-dark-80 blur-6 text-center text-light-40 small py-3">
                    <i>(Danh sách trống)</i>
                </td>
            </tr>
            <?php endif ?>
        </tbody>
    </table>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('#btn_export').on('click', function() {
        const $btn = $(this);

        // Tránh nhấn nhiều lần khi đang xử lý
        if ($btn.hasClass('disabled')) return;
        $btn.addClass('disabled').html('<span class="spinner-border spinner-border-sm"></span> Đang xử lý...');

        $.ajax({
            url: `/export/<?= $id_prize ?>/api`,
            method: 'GET',
            success: function(response) {
                if (response.status === "200 - OK" && response.data.length > 0) {
                    exportToExcel(response.data);
                } else {
                    alert("Không có dữ liệu để xuất!");
                }
            },
            error: function() {
                alert("Lỗi kết nối máy chủ!");
            },
            complete: function() {
                // Khôi phục trạng thái nút
                $btn.removeClass('disabled').html('<i class="bi bi-file-earmark-text"></i> Xuất danh sách');
            }
        });
    });

    function exportToExcel(apiData) {
        // 1. Định dạng lại dữ liệu cho đúng cột yêu cầu
        const formattedData = apiData.map((item, index) => {
            return {
                "STT": index + 1,
                "Mã số": item.name_guest.toString().padStart(4, '0'), // Định dạng 000x
                "Tên giải": item.name_prize
            };
        });

        // 2. Tạo Workbook và Worksheet
        const worksheet = XLSX.utils.json_to_sheet(formattedData);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Danh sách trúng thưởng");

        // 3. Cấu hình độ rộng cột (tùy chọn cho đẹp)
        worksheet['!cols'] = [
            { wch: 10 }, // STT
            { wch: 15 }, // Mã số
            { wch: 40 }  // Tên giải
        ];

        // 4. Tạo tên file theo định dạng export_prize_dd_mm_yyyy
        const now = new Date();
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const year = now.getFullYear();
        const fileName = `export_prize_${day}_${month}_${year}.xlsx`;

        // 5. Xuất file
        XLSX.writeFile(workbook, fileName);
    }
});
</script>