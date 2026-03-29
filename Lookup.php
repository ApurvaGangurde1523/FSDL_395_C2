<?php
include 'db.php';
header('Content-Type: application/json');

$phone = $conn->real_escape_string(trim($_GET['phone'] ?? ''));

if (!preg_match('/^\d{10}$/', $phone)) {
    echo json_encode(['found' => false]);
    exit;
}

$result = $conn->query("SELECT * FROM passengers WHERE phone='$phone' LIMIT 1");

if ($result->num_rows === 0) {
    echo json_encode(['found' => false]);
} else {
    $row = $result->fetch_assoc();
    echo json_encode([
        'found'      => true,
        'name'       => $row['passenger_name'],
        'from'       => $row['from_city'],
        'to'         => $row['to_city'],
        'departure'  => $row['departure_date'],
        'arrival'    => $row['arrival_date'],
        'email'      => $row['email'],
        'seat_class' => $row['seat_class'] ?? 'Economy',
        'fare'       => $row['fare'] ?? 0
    ]);
}
?>