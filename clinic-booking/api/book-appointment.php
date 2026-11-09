<?php
header('Content-Type: application/json');
require_once('../doctor/includes/dbconnection.php');

$data = json_decode(file_get_contents('php://input'), true);

$name = trim($data['name'] ?? '');
$phone = trim($data['phone'] ?? '');
$email = trim($data['email'] ?? '');
$date = $data['date'] ?? '';
$specialization = $data['specialization'] ?? '';
$doctor = $data['doctor'] ?? '';
$user_type = $data['user_type'] ?? '';
$appointment_time = $data['appointment_time'] ?? '';

if (!$name || !$phone || !$email || !$date || !$specialization || !$doctor || !$user_type || !$appointment_time) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

try {
    // Check if slot is already booked
    $check_sql = "SELECT COUNT(*) as count FROM tblappointment 
                  WHERE Doctor = :doctor 
                  AND AppointmentDate = :appointmentdate 
                  AND AppointmentTime = :appointmenttime 
                  AND Status IS NULL";
    $check_query = $dbh->prepare($check_sql);
    $check_query->bindParam(':doctor', $doctor, PDO::PARAM_STR);
    $check_query->bindParam(':appointmentdate', $date, PDO::PARAM_STR);
    $check_query->bindParam(':appointmenttime', $appointment_time, PDO::PARAM_STR);
    $check_query->execute();
    $result = $check_query->fetch(PDO::FETCH_ASSOC);

    if($result['count'] >= 1) {
        echo json_encode(['success' => false, 'error' => 'Time slot fully booked']);
        exit;
    }

    $appointmentNumber = mt_rand(100000000, 999999999);

    $sql = "INSERT INTO tblappointment (AppointmentNumber, Name, MobileNumber, Email, AppointmentDate, Specialization, Doctor, ApplyDate, AppointmentTime) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = $dbh->prepare($sql);
    $result = $stmt->execute([
        $appointmentNumber,
        $name,
        $phone,
        $email,
        $date,
        $specialization,
        $doctor,
        $appointment_time
    ]);

    if ($result) {
        echo json_encode(['success' => true, 'appointmentNumber' => $appointmentNumber]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Database error']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}