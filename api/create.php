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
$item->name = $data->name;
$item->email = $data->email;
$item->age = $data->age;
$item->designation = $data->designation;
$item->created = date('Y-m-d H:i:s');

if ($item->createEmployee()) {
    http_response_code(200);
    echo json_encode(['STATUS' => 'SUCCESS', 'MESSAGE' => "Thêm Mới Thành Công !"]);
} else {
    http_response_code(404);
    echo json_encode(['STATUS' => 'ERROR', 'MESSAGE' => "Thêm Mới Thất Bại !"]);
}
