<?php

# [MODEL]
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
model('public','guest');

# [VARIABLE]
$value_import = '';

# [HANDLE]
// Case : Nhập file excel
if (isset($_FILES['file']['name'])) {
    $path = $_FILES['file']['tmp_name'];
    try {
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // Lấy số dòng cuối cùng

        $count = 0;
        // Chạy vòng lặp từ dòng 2 đến dòng cuối
        for ($row = 2; $row <= $highestRow; $row++) {
            // get
            $get_vaue_cell = $worksheet->getCell('A' . $row)->getValue();
            // merge value
            $value_import .='("'.$get_vaue_cell.'"),';
        }
        // save
        guest_import(rtrim($value_import,','));
        // responsive
        view_json(200,[
            'message' => $value_import
        ]);

    } catch (Exception $e) {
        // toast
        toast_create('failed','Lỗi : '.$e->getMessage());
    }
}

# [RENDER]
route('list_guest');
