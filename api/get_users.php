<?php
require_once '../config.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

// Get all users
$result = $conn->query("SELECT id, username, email, created_at FROM users ORDER BY created_at DESC");

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit();
}

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode(['success' => true, 'users' => $users]);
?>
