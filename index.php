<?php
session_start();
include 'connection/database.php';

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
$date = $_REQUEST['date'];
$device_name = $_REQUEST['device'];

$old_date = explode('/', $date);
$new_date = str_replace('"', '', $old_date[2]) . '-' . str_replace('"', '', $old_date[1]) . '-' . str_replace('"', '', $old_date[0]);

switch ($method) {
    case 'GET':
        $stmt = $pdo->query("SELECT employee_id,
        min(auth_date_3) as original_arrival_time,
        max(auth_date_3) as original_departure_time,
        min(auth_date_3) as arrival_time,
        max(auth_date_3) as departure_time
        FROM raw_attendances WHERE auth_date_2 = '$new_date' AND device_name = '$device_name' GROUP BY employee_id");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}