<?php

# [MODEL]
model('public','prize');
model('public','guest');

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
    elseif(guest_get_sum_prize($id_prize)) {
        toast_create('failed','Giải này đã quay rồi !');
        route('result/'.$id_prize);
    }
}else view_error(400);

//Case : Quay thưởng
if(get_action_uri(2) == 'craft_spin') {
    // check spin
    if(!guest_get_sum_prize($id_prize)) prize_spin($get_prize['id_prize'],$get_prize['quantity_prize']);
    // query
    $list = guest_has_prize($id_prize);
    // return
    view_json(200,[
        'first' => (int)$list[0]['name_guest'],
        'list' => $list
    ]);
}

# [DATA
$data = [
    'id_prize' => $id_prize,
    'info_prize' => $get_prize,
];

# [RENDER]
view('public','spin','Quay Giải : '.$get_prize['name_prize'],$data);