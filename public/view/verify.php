<style>
    body {
        height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
</style>
<div class="d-flex flex-column align-items-center justify-content-center w-100">
    <div class="d-flex flex-column gap-3 col-12 col-md-6 col-lg-4">
        <form action="/verify" method="post" class="d-flex flex-column align-items-center">
            <label for="admin_verify" class="text-dark fw-bold mb-2">Mật khẩu BTC</label>
            <input id="admin_verify" type="password" name="admin_verify" class="form-control text-center">
            <button id="btn_verify" disabled type="submit" class="btn btn-danger text-warning border-warning px-3 mt-2">Xác nhận</button>
        </form>
    </div>
</div>

<script>
    const adminInput = document.getElementById('admin_verify');
    const submitBtn = document.getElementById('btn_verify');

    adminInput.addEventListener('input', function () {
        // Kiểm tra nếu giá trị input sau khi xóa khoảng trắng (trim) không trống
        if (adminInput.value.trim().length > 0) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    });
</script>