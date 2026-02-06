<?php

# [AUTHOR]
if($_SESSION['btc'] !== 'verify') route('verify');

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
    elseif(prize_check_spin($id_prize)) {
        if($id_prize > 5) {
            toast_create('failed','Giải này đã quay rồi !');
            route('result/'.$id_prize);
        }
    }
}else view_error(400);

//Case : Quay thưởng
if(get_action_uri(2) == 'craft_spin') {
    // Giải 1-2-3-4-5
    if($id_prize < 6) {
        // rand guest
        $id_guest = prize_spin_one($get_prize['id_prize']);
        // query
        $list = guest_has_prize_with_id($id_guest);
        // return
        view_json(200,[
            'list' => $list
        ]);
    }
    // Giải 5 trở lên
    else {
        // spin
        prize_spin($get_prize['id_prize'],$get_prize['quantity_prize']);
        // query
        $list = guest_has_prize($id_prize);
        // return
        view_json(200,[
            'list' => $list
        ]);
    }
}

# [DATA
$data = [
    'id_prize' => $id_prize,
    'info_prize' => $get_prize,
];

# [RENDER]
view('public','spin','Quay Giải : '.$get_prize['name_prize'].'<br>抽奖环节 : '.$get_prize['chn_name_prize'],$data);