<link rel="stylesheet" href="<?= URL_P_V ?>css/btc_home.css">

<div style="margin-top:20vh" class="row justify-content-center align-items-center">
    <div class="col-12 col-md-8 mt-lg-5">
        <table class="table table-dark table-hover">
        <thead>
            <tr class="align-middle">
                <th class="bg-dark-80 blur-6">Tên giải</th>
                <th class="text-start bg-dark-80 blur-6">Tên quà</th>
                <th class="text-center bg-dark-80 blur-6">Số lượng giải</th>
                <th class="text-end bg-dark-80 blur-6">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_prize as $prize): 
            extract($prize);
            ?>
                <tr class="align-middle fw-light small">
                    <th class="fw-light bg-dark-80 blur-6">
                        <?= $name_prize ?>
                    </th>
                    <td class="text-start bg-dark-80 blur-6">
                        <?= $name_gift_prize ?>
                    </td>
                    <td class="text-center bg-dark-80 blur-6">
                        <?= $quantity_prize ?>
                    </td>
                    <td class="text-end bg-dark-80 blur-6">
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <?= $state_prize == 'default' ? 'Chưa Quay Thưởng' : 'Đã Quay Thưởng' ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>
</div>

