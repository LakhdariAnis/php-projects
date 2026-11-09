<?php
header('Content-Type: application/json');
require_once('../doctor/includes/dbconnection.php');

$appointmentNumber = $_GET['appointmentNumber'] ?? '';

if (!$appointmentNumber) {
    echo json_encode(['success' => false, 'error' => 'Missing appointment number']);
    exit;
}

try {
    $sql = "SELECT * FROM tblappointment WHERE AppointmentNumber = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$appointmentNumber]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($appointment) {
        echo json_encode(['success' => true, 'appointment' => $appointment]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Appointment not found']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}