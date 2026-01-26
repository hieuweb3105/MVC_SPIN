<div style="margin-top: 25vh" class="d-flex w-100 align-items-center justify-content-center px-3">
    <div class=" col-12">
        <form action="/spin/<?= $id_prize ?>" method="post" class="d-flex flex-column align-items-center gap-3">
            <div class="h2 text-light">
                <span><?= $info_prize['quantity_prize'] > 10 ?: '0' . $info_prize['quantity_prize'] ?> Giải</span>
                <span><?= $info_prize['name_gift_prize'] ?></span>
            </div>
            <button type="submit" class="btn btn-danger border-2 border-warning text-warning shadow px-3">
                Quay Thưởng
            </button>
        </form>
    </div>
</div>