<link rel="stylesheet" href="<?= URL_P_V ?>css/home.css">

<div style="margin-top: 30vh" class="d-flex w-100 align-items-center justify-content-center px-3">
    <div class=" col-12 col-md-8 col-lg-4">
        <form action="/" method="post" class="d-flex flex-column align-items-center gap-3">
            <select name="choose_prize" class="form-select border-2 border-dark" aria-label="Default select example">
                <option disabled selected>- Chọn Giải Quay -</option>
                <?php foreach ($list_prize as $prize) : extract($prize) ?>
                <option value="<?= $id_prize ?>"><?= $name_prize ?></option>
                <?php endforeach ?>
            </select>
            <button type="submit" class="btn btn-danger text-warning border-warning shadow px-4">
                Xác nhận
            </button>
        </form>
    </div>
</div>