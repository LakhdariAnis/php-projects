<?php
header('Content-Type: application/json');
require_once('../doctor/includes/dbconnection.php');

$doctor = $_GET['doctor'] ?? '';
$date = $_GET['date'] ?? '';

if (!$doctor || !$date) {
    echo json_encode(['success' => false, 'error' => 'Missing doctor or date']);
    exit;
}

// All possible time slots
$allSlots = [
    '09:00:00' => '09:00 AM',
    '09:30:00' => '09:30 AM',
    '10:00:00' => '10:00 AM',
    '10:30:00' => '10:30 AM',
    '11:00:00' => '11:00 AM',
    '11:30:00' => '11:30 AM',
    '12:00:00' => '12:00 PM',
    '14:00:00' => '02:00 PM',
    '14:30:00' => '02:30 PM',
    '15:00:00' => '03:00 PM',
    '15:30:00' => '03:30 PM',
    '16:00:00' => '04:00 PM',
    '16:30:00' => '04:30 PM',
    '17:00:00' => '05:00 PM'
];

try {
    $bookedSql = "SELECT AppointmentTime FROM tblappointment 
                  WHERE Doctor = :doctor 
                  AND AppointmentDate = :date";
    $bookedQuery = $dbh->prepare($bookedSql);
    $bookedQuery->bindParam(':doctor', $doctor, PDO::PARAM_STR);
    $bookedQuery->bindParam(':date', $date, PDO::PARAM_STR);
    $bookedQuery->execute();
    $bookedSlots = $bookedQuery->fetchAll(PDO::FETCH_COLUMN);

    foreach($bookedSlots as $bookedTime) {
        unset($allSlots[$bookedTime]);
    }

    echo json_encode($allSlots);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}