<link rel="stylesheet" href="<?= URL_P_V ?>css/list-guest.css?v=1.0.1">

<div style="margin-top:20vh" class="row justify-content-center align-items-center">
    <div class="col-12 d-flex align-items-center justify-content-center mt-4">
        <div class="text-gold h5">
            <?= $info_prize['name_prize'] ?> -
            <?= $info_prize['quantity_prize'] > 10 ? $info_prize['quantity_prize'] : '0' . $info_prize['quantity_prize'] ?>
            giải <?= $info_prize['name_gift_prize'] ?>
        </div>
    </div>
    <div class="col-12 col-md-8 mt-lg-5">
        <div class="col-12 mb-2 d-flex justify-content-between gap-1">
            <button type="button" id="btn_export"
                class="btn btn-sm btn-danger text-warning border-warning px-3 shadow <?= $list_guest ?: 'disabled' ?>">
                <i class="bi bi-file-earmark-text"></i>Xuất danh sách
            </button>
            <button type="button" class="btn btn-sm btn-danger text-warning border-warning px-3 shadow <?= $list_guest ?: 'disabled' ?>" data-bs-toggle="modal" data-bs-target="#modalReset">
                <i class="bi bi-arrow-repeat"></i>Reset giải
            </button>
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
                if ($list_guest):
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
                            <td class="text-end text-light-60 bg-dark-80 blur-6">
                                <?= $name_gift_prize ?? '<span class="text-light-40">không</span>' ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                else:
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

<!-- Modal -->
<div class="modal fade" id="modalReset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark-60 blur-6 text-light">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        Bạn có chắc chắn reset giải này ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm px-3 btn-secondary" data-bs-dismiss="modal">Huỷ</button>
        <a href="/result/<?= $info_prize['id_prize'] ?>/reset" class="btn btn-sm px-3 btn-danger text-warning border-warning">Reset ngay</a>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $('#btn_export').on('click', function () {
            const $btn = $(this);

            if ($btn.hasClass('disabled')) return;
            $btn.addClass('disabled').html('<span class="spinner-border spinner-border-sm"></span> Đang xử lý...');

            $.ajax({
                url: `/export/<?= $id_prize ?>/api`,
                method: 'GET',
                success: function (response) {
                    // Kiểm tra status và mảng data
                    if (response.status === "200 - OK" && response.data && response.data.length > 0) {

                        // LẤY name_prize Ở CẤP NGOÀI CÙNG
                        const prizeNameForFile = response.name_prize || "danh_sach";

                        exportToExcel(response.data, prizeNameForFile);
                    } else {
                        alert("Không có dữ liệu để xuất!");
                    }
                },
                error: function () {
                    location.reload();
                },
                complete: function () {
                    $btn.removeClass('disabled').html('<i class="bi bi-file-earmark-text"></i> Xuất danh sách');
                }
            });
        });

        function exportToExcel(apiData, prizeName) {
            if (typeof XLSX === 'undefined') {
                alert("Thư viện XLSX chưa được tải!");
                return;
            }

            // 1. Định dạng dữ liệu bảng
            const formattedData = apiData.map((item, index) => {
                return {
                    "STT": index + 1,
                    "Mã số": String(item.name_guest).padStart(4, '0'),
                    "Tên quà tặng": item.name_gift_prize // Lấy đúng key name_gift_prize trong mảng data
                };
            });

            const worksheet = XLSX.utils.json_to_sheet(formattedData);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, "Kết quả");

            // Cấu hình độ rộng cột
            worksheet['!cols'] = [{ wch: 10 }, { wch: 15 }, { wch: 45 }];

            // 2. Xử lý thời gian cho tên file: dd-mm-yyyy-hh-mm-ss
            const now = new Date();
            const timePart = [
                String(now.getDate()).padStart(2, '0'),
                String(now.getMonth() + 1).padStart(2, '0'),
                now.getFullYear(),
                String(now.getHours()).padStart(2, '0'),
                String(now.getMinutes()).padStart(2, '0'),
                String(now.getSeconds()).padStart(2, '0')
            ].join('-');

            // 3. Tạo tên file sạch (không ký tự đặc biệt)
            const safePrizeName = prizeName.replace(/[/\\?%*:|"<>]/g, '-');
            const fileName = `${safePrizeName}-${timePart}.xlsx`;

            XLSX.writeFile(workbook, fileName);
        }
    });
</script>