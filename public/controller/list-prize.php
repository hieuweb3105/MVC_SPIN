<?php

# [MODEL]
model('public','prize');
model('public','guest');

# [DATA]
$data = [
    'list_prize' => prize_get_all()
];

# [RENDER]
view('public','list-prize','Danh Sách Giải Thưởng',$data);