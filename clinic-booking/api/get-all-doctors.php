<?php
header('Content-Type: application/json');
require_once('../doctor/includes/dbconnection.php');

try {
    $sql = "SELECT ID, FullName, Specialization, Email, MobileNumber FROM tbldoctor ORDER BY FullName";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'doctors' => $doctors]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}