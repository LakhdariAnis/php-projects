<?php
header('Content-Type: application/json');
require_once('../doctor/includes/dbconnection.php');

$specialization = $_GET['specialization'] ?? '';

if (!$specialization) {
    echo json_encode(['success' => false, 'error' => 'Missing specialization']);
    exit;
}

try {
    $sql = "SELECT ID, FullName FROM tbldoctor WHERE Specialization = ? ORDER BY FullName";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$specialization]);
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'doctors' => $doctors]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}