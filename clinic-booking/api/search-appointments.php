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

$query = trim($_GET['query'] ?? '');

if (!$query) {
    echo json_encode(['success' => false, 'error' => 'Missing search query']);
    exit;
}

try {
    $sql = "SELECT a.*, 
                   d.ID AS doctor_id, d.FullName AS doctor_name, 
                   s.ID AS specialization_id, s.Specialization AS specialization_name
            FROM tblappointment a
            LEFT JOIN tbldoctor d ON a.Doctor = d.ID
            LEFT JOIN tblspecialization s ON a.Specialization = s.ID
            WHERE a.AppointmentNumber LIKE ? 
               OR a.Name LIKE ? 
               OR a.MobileNumber LIKE ?";
    $stmt = $dbh->prepare($sql);
    $like = "%$query%";
    $stmt->execute([$like, $like, $like]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format results to include doctor and specialization objects
    $formatted = array_map(function($row) {
        return [
            "ID" => $row["ID"],
            "AppointmentNumber" => $row["AppointmentNumber"],
            "Name" => $row["Name"],
            "MobileNumber" => $row["MobileNumber"],
            "Email" => $row["Email"],
            "AppointmentDate" => $row["AppointmentDate"],
            "ApplyDate" => $row["ApplyDate"],
            "AppointmentTime" => $row["AppointmentTime"],
            "Status" => $row["Status"],
            "Remark" => $row["Remark"],
            "doctor" => [
                "id" => $row["doctor_id"],
                "name" => $row["doctor_name"]
            ],
            "specialization" => [
                "id" => $row["specialization_id"],
                "name" => $row["specialization_name"]
            ]
        ];
    }, $results);

    echo json_encode(['success' => true, 'results' => $formatted]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}