<link rel="stylesheet" href="<?= URL_P_V ?>css/list-guest.css?v=1.0.1">

<div style="margin-top:20vh" class="row justify-content-center align-items-center">
    <div class="col-12 col-md-8 mt-lg-5">
        <div class="col-12 mb-2 d-flex gap-1">
            <button type="button" id="btn_import" class="btn btn-sm btn-danger text-warning border-warning px-3">
                <i class="bi bi-file-earmark-plus"></i>Nhập danh sách
            </button>
            <a href="/list-guest/delete" class="btn btn-sm btn-danger text-warning border-warning px-3 <?= $list_guest ?: 'disabled' ?>">
                <i class="bi bi-file-earmark-x"></i>Xoá danh sách
            </a>
            <input type="file" id="file_excel" accept=".xlsx, .xls" class="d-none">
        </div>
        <table class="table table-dark table-hover">
        <thead>
            <tr class="align-middle">
                <th class="text-center bg-dark-80 blur-6">Mã dự thưởng</th>
                <th class="text-end bg-dark-80 blur-6">Giải trúng</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($list_guest) :
                foreach ($list_guest as $guest): 
                extract($guest);
            ?>
                <tr class="align-middle fw-light small">
                    <th class="text-center fw-light bg-dark-80 blur-6">
                        <?= str_pad($name_guest, 4, "0", STR_PAD_LEFT) ?>
                    </th>
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


<script src="<?= URL_P_V ?>js/import.js"></script>