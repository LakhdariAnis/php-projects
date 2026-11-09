<?php
header('Content-Type: application/json');
require_once('../doctor/includes/dbconnection.php');

try {
    $sql = "SELECT ID, Specialization FROM tblspecialization ORDER BY Specialization";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $specializations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'specializations' => $specializations]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}