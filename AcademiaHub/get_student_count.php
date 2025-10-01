<?php
require_once('conn.php');

header('Content-Type: application/json');

// Get actual student count from database
$sql = "SELECT COUNT(*) as total FROM student_info WHERE status='active'";
$result = $conn->query($sql);
$count = 0;

if ($result && $result->num_rows > 0) {
    $count = $result->fetch_assoc()['total'];
}

echo json_encode(['count' => $count]);
?>
