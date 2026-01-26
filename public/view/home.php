<link rel="stylesheet" href="<?= URL_P_V ?>css/btc_home.css">

<div style="margin-top:20vh" class="row justify-content-center align-items-center">
    <div class="col-12 col-md-8 mt-lg-5">
        <table class="table table-dark table-hover">
        <thead>
            <tr class="align-middle">
                <th class="bg-dark-80 blur-6">Tên giải</th>
                <th class="text-start bg-dark-80 blur-6">Tên quà</th>
                <th class="text-center bg-dark-80 blur-6">Số lượng giải</th>
                <th class="text-center bg-dark-80 blur-6">Số giải đã quay</th>
                <th class="text-end bg-dark-80 blur-6">Hành động</th>
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
                    <td class="text-center bg-dark-80 blur-6">
                        <?= $total_turn ?>
                    </td>
                    <td class="bg-dark-80 blur-6 d-flex justify-content-end gap-1">
                        <a href="/result/<?=$id_prize ?>" class="btn btn-sm btn-dark text-warning border-warning <?= $total_turn ? '' : 'disabled' ?>">
                            <small><i class="bi bi-eye me-1"></i> Xem DS trúng</small>
                        </a>
                        <a href="/spin/<?=$id_prize ?>" class="btn btn-sm btn-danger text-warning border-warning <?= $total_turn !== $quantity_prize ? '' : 'disabled' ?>">
                            <small><i class="bi bi-gift me-1"></i> Quay thưởng</small>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </div>
</div>

