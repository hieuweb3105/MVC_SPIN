<?php

# [MODEL]
model('public','guest');

# [HANDLE]

// Case: Xoá danh sách
if(get_action_uri(1) == 'delete') {
    guest_delete_all();
    toast_create('success','Xoá thành công');
    route('list-guest');
}


# [DATA
$data = [
    'list_guest' => guest_get_all(),
];


# [RENDER]
view('public','list-guest','Danh sách tham dự',$data);