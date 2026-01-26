<?php

# [MODEL]
model('public','prize');

# [HANDLE
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

# [DATA
$data = [
    'id_prize' => $id_prize,
    'info_prize' => $get_prize,
];

# [RENDER]
view('public','spin','Quay Giải : '.$get_prize['name_prize'],$data);