<link rel="stylesheet" href="<?= URL_P_V ?>css/spin.css?v=1.0.2">

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
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-dark-40 text-light blur-6 border-light">

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                    <div class="h4">
                        Xin chúc mừng
                    </div>
                    <div class="text-light-60">
                        Mã số trúng thưởng :
                    </div>
                    <div id="list-has-prize" class="d-flex gap-1 flex-wrap justify-content-between">
                        <span>Vui lòng chờ</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="/" class="btn btn-sm px-3 btn-dark text-light-60"><i class="bi bi-gift"></i> DS
                    giải</a>
                <a href="/result/<?= $id_prize ?>" class="btn btn-sm px-3 btn-danger border-warning text-warning"><i
                        class="bi bi-eye"></i> Chi tiết DS trúng</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#btn-spin').on('click', function () {
            const $btn = $(this);
            const prizeId = '<?= $id_prize ?>';

            // 1. Vô hiệu hóa nút và gọi API
            $btn.prop('disabled', true).addClass('d-none');

            $.ajax({
                url: `/spin/${prizeId}/craft_spin`,
                method: 'GET',
                success: function (response) {
                    if (response.status === "200 - OK") {
                        // Chuyển số first thành chuỗi 4 ký tự (ví dụ: "0506")
                        const firstWin = response.first.toString().padStart(4, '0');
                        const listWinners = response.list;

                        startSpinning(firstWin, listWinners);
                    } else {
                        alert("Có lỗi xảy ra từ máy chủ!");
                        $btn.removeClass('d-none').prop('disabled', false);
                    }
                },
                error: function () {
                    alert("Không thể kết nối tới API!");
                    $btn.removeClass('d-none').prop('disabled', false);
                }
            });
        });

        function startSpinning(finalTarget, list) {
            const $items = $('.count-item');
            let intervals = [];

            // Chạy hiệu ứng số nhảy ngẫu nhiên cho cả 4 ô
            $items.each(function (index) {
                intervals[index] = setInterval(() => {
                    $(this).text(Math.floor(Math.random() * 10));
                }, 50);
            });

            // Sau 5 giây, bắt đầu dừng lần lượt từng ô từ trái sang phải
            setTimeout(() => {
                $items.each(function (index) {
                    setTimeout(() => {
                        clearInterval(intervals[index]); // Dừng nhảy số
                        $(this).text(finalTarget[index]); // Gán số thực tế từ API
                        $(this).addClass('animate__animated animate__bounceIn'); // Thêm hiệu ứng dừng

                        // Nếu là ô cuối cùng thì đợi 1 chút rồi hiện Modal
                        if (index === $items.length - 1) {
                            setTimeout(() => {
                                showCongratulation(list);
                            }, 500);
                        }
                    }, index * 500); // Mỗi ô dừng cách nhau 0.5 giây
                });
            }, 2000); // 5000ms = 5 giây quay tổng cộng
        }

        function showCongratulation(list) {
            const $listContainer = $('#list-has-prize');
            $listContainer.empty();

            const count = list.length;
            // Nếu dưới 10 giải thì tổng thời gian hiện ra là 2s, ngược lại là 10s
            const totalTime = count <= 10 ? 2000 : 10000;
            const delayStep = totalTime / count; // Khoảng cách thời gian giữa mỗi dòng

            list.forEach((item, index) => {
                const formattedName = item.name_guest.toString().padStart(4, '0');

                // Tạo thẻ span với class prize-item
                const $span = $(`<span class="prize-item">${formattedName}</span>`);

                // Gán animation-delay bằng style inline để mỗi cái hiện sau cái trước
                const delay = (index * delayStep) / 1000; // Đổi sang giây
                $span.css('animation-delay', `${delay}s`);

                $listContainer.append($span);
            });

            // Hiển thị Modal
            const congratsModal = new bootstrap.Modal(document.getElementById('modalCongratulate'), {
                backdrop: 'static',
                keyboard: false
            });
            congratsModal.show();
        }
    });
</script>