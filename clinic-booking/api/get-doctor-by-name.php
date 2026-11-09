<?php
header('Content-Type: application/json');
require_once('../doctor/includes/dbconnection.php');

$name = trim($_GET['name'] ?? '');

if (!$name) {
    echo json_encode(['success' => false, 'error' => 'Missing doctor name']);
    exit;
}

try {
    $sql = "SELECT * FROM tbldoctor WHERE FullName = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$name]);
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($doctor) {
        echo json_encode(['success' => true, 'doctor' => $doctor]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Doctor not found']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}