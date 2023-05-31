<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/employees.php';

$database = new Database();
$db = $database->Connection();
$item = new Employee($db);
$data = json_decode(file_get_contents("php://input"));
$item->id = $data->id;
if (empty($data->id)) {
    http_response_code(404);
    echo json_encode(['STATUS' => 'ERROR', 'MESSAGE' => "Vui Lòng Truyền Đúng Tham Số !"]);
} elseif ($item->deleteEmployee()) {
    http_response_code(200);
    echo json_encode(['STATUS' => 'SUCCESS', 'MESSAGE' => "Xóa Thành Công !"]);
} else {
    http_response_code(404);
    echo json_encode(['STATUS' => 'ERROR', 'MESSAGE' => "Xóa Thất Bại !"]);
}
