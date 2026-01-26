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