<?php
header('Content-Type: application/json');
session_start();

// patient data: doctors only
if (empty($_SESSION['damsid'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}
require_once('../doctor/includes/dbconnection.php');

// Optional: filter by date, doctor, status, etc.
$date = $_GET['date'] ?? '';
$doctor = $_GET['doctor'] ?? '';
$status = $_GET['status'] ?? '';

$where = [];
$params = [];

if ($date) {
    $where[] = "AppointmentDate = ?";
    $params[] = $date;
}
if ($doctor) {
    $where[] = "Doctor = ?";
    $params[] = $doctor;
}
if ($status) {
    $where[] = "Status = ?";
    $params[] = $status;
}

$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

try {
    $sql = "SELECT * FROM tblappointment $whereSql ORDER BY AppointmentDate DESC, AppointmentTime ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'appointments' => $appointments]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}