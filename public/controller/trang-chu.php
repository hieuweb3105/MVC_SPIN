<?php

# [MODEL]
model('public','prize');

# [HANDLE]
if(isset($_POST['choose_prize']) && $_POST['choose_prize']) {
    // input
    $input_choose_prize = $_POST['choose_prize'];
    // route
    route('spin/'.$input_choose_prize);
}

# [DATA]
$data = [
    'list_prize' => prize_get_all(),
];

# [RENDER]
view('public','home','Quay Trúng Thưởng',$data);