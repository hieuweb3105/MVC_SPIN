<link rel="stylesheet" href="<?= URL_P_V ?>css/spin.css?v=1.0.4">

<div style="margin-top: 25vh" class="d-flex w-100 align-items-center justify-content-center px-3">
    <div class="col-12 d-flex flex-column align-items-center gap-3">
        <div class="h2 text-light">
            <span><?= $info_prize['quantity_prize'] > 10 ? $info_prize['quantity_prize'] : '0' . $info_prize['quantity_prize'] ?>
                Giải - phần quà </span>
            <span><?= $info_prize['name_gift_prize'] ?></span>
        </div>
        <div id="count-list" class="d-flex gap-2 gap-md-3 my-4">
            <div class="count-item">0</div>
            <div class="count-item">0</div>
            <div class="count-item">0</div>
            <div class="count-item">0</div>
        </div>
        <button id="btn-spin" type="button"
            class="btn btn-danger border-2 border-warning text-warning shadow fw-bold px-4 animate__animated animate__heartBeat animate__infinite">
            Quay Thưởng
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCongratulate" tabindex="-1" aria-labelledby="modalCongratulateLabel"
    aria-hidden="true">
    <div style="min-width:90vw" class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark-40 text-light blur-6 border-light">

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                    <div class="h4">
                        Xin chúc mừng
                    </div>
                    <div class="h5">
                        <span><?= $info_prize['name_prize'].' - ' ?> <?= $info_prize['quantity_prize'] > 10 ? $info_prize['quantity_prize'] : '0' . $info_prize['quantity_prize'] ?>
                            Giải - phần quà </span>
                        <span><?= $info_prize['name_gift_prize'] ?></span>
                    </div>
                    <div class="text-light-60">
                        Mã số trúng thưởng :
                    </div>
                    <div id="list-has-prize" class="d-flex gap-1 flex-wrap">
                        <span>Vui lòng chờ</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="/result/<?= $id_prize ?>" class="btn btn-sm px-3 btn-dark border-warning text-warning"><i class="bi bi-gift"></i> Danh sách trúng</a>
                <a href="/" class="btn btn-sm px-3 btn-danger border-warning text-warning"><i class="bi bi-gift"></i> Danh sách giải thưởng</a>
                <a href="/spin/<?= $id_prize ?>" class="btn btn-sm px-3 btn-danger border-warning text-warning"><i class="bi bi-arrow-repeat"></i> Tiếp tục quay</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    $('#btn-spin').on('click', function () {
        const $btn = $(this);
        const prizeId = '<?= $id_prize ?>';

        $btn.prop('disabled', true).addClass('d-none');

        $.ajax({
            url: `/spin/${prizeId}/craft_spin`,
            method: 'GET',
            success: function (response) {
                if (response.status === "200 - OK") {
                    const listWinners = response.list;
                    startVisualSpinning(listWinners);
                } else {
                    location.reload();
                }
            },
            error: function () {
                alert("Không thể kết nối tới API!");
                $btn.removeClass('d-none').prop('disabled', false);
            }
        });
    });

    function startVisualSpinning(list) {
        const $items = $('.count-item');
        
        // 1. Chạy hiệu ứng số nhảy tượng trưng
        let interval = setInterval(() => {
            $items.each(function () {
                $(this).text(Math.floor(Math.random() * 10));
            });
        }, 80);

        // 2. Sau đúng 2 giây thì dừng hiệu ứng tượng trưng và mở Modal
        setTimeout(() => {
            clearInterval(interval);
            // Gán số cố định hoặc giữ nguyên số ngẫu nhiên cuối cùng đều được vì chỉ là tượng trưng
            showCongratulation(list);
        }, 3000);
    }

    function showCongratulation(list) {
        const $listContainer = $('#list-has-prize');
        $listContainer.empty(); // Xóa chữ "Vui lòng chờ"

        // Khởi tạo Modal trước
        const congratsModal = new bootstrap.Modal(document.getElementById('modalCongratulate'), {
            backdrop: 'static',
            keyboard: false
        });
        congratsModal.show();

        // Kiểm tra số lượng để quyết định class
        const itemClass = list.length < 10 ? 'prize-item-lg' : 'prize-item';

        // Hiệu ứng hiện từng mã số sau mỗi 0.1 giây (100ms)
        list.forEach((item, index) => {
            const formattedName = item.name_guest.toString().padStart(4, '0');
            
            // Sử dụng biến itemClass đã xác định ở trên
            const $span = $(`<span class="${itemClass}">${formattedName}</span>`);
            
            // Tính toán delay: cái sau cách cái trước 0.1s
            const delay = index * 0.1; 
            $span.css('animation-delay', `${delay}s`);

            $listContainer.append($span);
        });
    }
});
</script>