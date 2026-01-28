<?php

# [HANDLE]
// Case : Xác thực quyền BTC
if(isset($_POST['admin_verify']) && $_POST['admin_verify']) {
    $input_verify = $_POST['admin_verify'];
    if(password_verify($input_verify,'$2y$10$3q4JO0xnkM1rQk/TnwLj/etaTfB7UWIPJElvqWqCQK0TsdUvDh99O')) {
        $_SESSION['btc'] = 'verify';
        toast_create('success','Xác thực thành công !');
        route();
    }else {
        toast_create('failed','Xác thực thất bại !');
        route('verify');
    }
}

# [RENDER]
view('public','verify','Xác thực BTC',null);
