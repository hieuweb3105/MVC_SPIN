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
}else view_error(400);

//Case : Reset giải
if(get_action_uri(2) == 'reset') {
    prize_reset_by_id($id_prize);
    toast_create('success','Reset thành công !');
    route('result/'.$id_prize);
}

# [DATA]
$data = [
    'info_prize' => $get_prize,
    'list_guest' => guest_has_prize($id_prize),
];


# [RENDER]
view('public','result','Danh sách trúng thưởng',$data);