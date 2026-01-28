<?php

# [AUTHOR]
if($_SESSION['btc'] !== 'verify') route('verify');


# [MODEL]
model('public','prize');
model('public','guest');

# [HANDLE
// Case : Xuất tất cả
if(get_action_uri(1) === 'all') {
    // return
    view_json(200,[
        'data' => guest_get_all(),
    ]);
}
//Case : Truy cập giải
if(get_action_uri(1)) {
    // input
    $id_prize = get_action_uri(1);
    // query
    $get_prize = prize_get_one($id_prize);
    // validate
    if(!$get_prize) {
        toast_create('failed','Không tìm thấy giải !');
        route();
    }
}else view_error(400);

//Case : Quay thưởng
if(get_action_uri(2) == 'api') {
    // query
    $get_prize = prize_get_one($id_prize);
    $list = guest_has_prize($id_prize);
    // return
    view_json(200,[
        'name_prize' => $get_prize['name_prize'],
        'data' => guest_has_prize($id_prize)
    ]);
}

# [RENDER]
view_error(400);