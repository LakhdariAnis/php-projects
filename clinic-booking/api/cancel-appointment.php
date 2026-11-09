<?php
header('Content-Type: application/json');
require_once('../doctor/includes/dbconnection.php');

$data = json_decode(file_get_contents('php://input'), true);
$appointmentNumber = $data['appointmentNumber'] ?? '';

if (!$appointmentNumber) {
    echo json_encode(['success' => false, 'error' => 'Missing appointment number']);
    exit;
}

try {
    $sql = "UPDATE tblappointment SET Status = 'Cancelled' WHERE AppointmentNumber = ?";
    $stmt = $dbh->prepare($sql);
    $result = $stmt->execute([$appointmentNumber]);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Appointment cancelled successfully.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}