<?php
# [CORE]
require_once 'config.php';
require_once 'core/autoload.php';
require_once 'core/database.php';
require_once 'core/function.php';

# [AUTO LOGIN]
// auto_login();

# [TOKEN GUEST]
// Khởi tạo cookie token guest
if (!isset($_COOKIE['token_guest']) || empty($_COOKIE['token_guest'])) {
    // Tạo token và time
    $token = create_token(20);
    $expiry = time() + 86400 * 30;
    // Gửi cookie về trình duyệt
    setcookie('token_guest', $token, $expiry, "/", "", true, true);
    // Tạo value thủ công trường hợp không cần F5 - Load lại trang
    $_COOKIE['token_guest'] = $token;
}

# [UPGRADE PAGE]
if(BOOL_UPGRADE) view_error(503);

# [ACTION]
$_case = get_action_uri(0);
// Nếu có case cụ thể
if($_case) {
    // Nếu vào system admin
    if($_case === 'admin') {
        // Kiểm tra có phải là admin hay không
        author('admin');
        // Nếu có case cụ thể
        $_admin_case = get_action_uri(1);
        if($_admin_case) {
            if(file_exists('admin/controller/'.$_admin_case.'.php')) require_once 'admin/controller/'.$_admin_case.'.php'; // Vào case
            else return view_error(404); // Nếu không tìm thấy action
        }
        else require_once 'admin/controller/'.DEFAULT_ADMIN_CASE.'.php'; // Chuyển đến case mặc định
    }
    // Trả về action bên user
    else{
        if(file_exists('public/controller/'.$_case.'.php')) require_once 'public/controller/'.$_case.'.php';
        else return view_error(404);
    }
}
// Trường hợp không có action
else require_once 'public/controller/'.DEFAULT_USER_CASE.'.php';