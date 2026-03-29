<?php
include 'db.php';

// Sanitize inputs
function clean($conn, $val) {
    return $conn->real_escape_string(trim($val));
}

$name      = clean($conn, $_POST['name'] ?? '');
$from      = clean($conn, $_POST['from'] ?? '');
$to        = clean($conn, $_POST['to'] ?? '');
$date      = clean($conn, $_POST['date'] ?? '');
$departure = clean($conn, $_POST['departure'] ?? '');
$arrival   = clean($conn, $_POST['arrival'] ?? '');
$phone     = clean($conn, $_POST['phone'] ?? '');
$email     = clean($conn, $_POST['email'] ?? '');
$seat_class= clean($conn, $_POST['seat_class'] ?? 'Economy');
$fare      = clean($conn, $_POST['fare'] ?? '0');

// Basic server-side validation
$errors = [];
if (empty($name))      $errors[] = "Name is required.";
if (!preg_match('/^\d{10}$/', $phone)) $errors[] = "Phone must be 10 digits.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email address.";
if (empty($from))      $errors[] = "From city is required.";
if (empty($to))        $errors[] = "To city is required.";
if ($from === $to)     $errors[] = "Origin and destination cannot be same.";
if (empty($date))      $errors[] = "Travel date is required.";
if (empty($departure)) $errors[] = "Departure date is required.";
if (empty($arrival))   $errors[] = "Arrival date is required.";
if (!empty($departure) && !empty($arrival) && $arrival < $departure)
    $errors[] = "Arrival date cannot be before departure date.";

if (!empty($errors)) {
    echo "<!DOCTYPE html><html><head><title>Error</title>
    <link href='https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600&display=swap' rel='stylesheet'>
    <style>
    body{font-family:'DM Sans',sans-serif;background:#0a1628;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;}
    .box{background:#fff;border-radius:20px;padding:40px;max-width:420px;width:90%;text-align:center;}
    h2{color:#e05252;margin-bottom:16px;font-size:20px;}
    ul{text-align:left;color:#555;margin-bottom:24px;padding-left:20px;}
    li{margin-bottom:6px;font-size:14px;}
    a{display:inline-block;padding:12px 28px;background:#0a1628;color:#e8c97a;border-radius:10px;text-decoration:none;font-weight:600;font-size:14px;}
    </style></head><body>
    <div class='box'>
    <h2>⚠ Validation Error</h2>
    <ul>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul><a href='javascript:history.back()'>← Go Back & Fix</a></div></body></html>";
    exit;
}

// Check if seat_class column exists; if not, add it (first run helper)
$colCheck = $conn->query("SHOW COLUMNS FROM passengers LIKE 'seat_class'");
if ($colCheck->num_rows === 0) {
    $conn->query("ALTER TABLE passengers ADD COLUMN seat_class VARCHAR(20) DEFAULT 'Economy'");
}
$colCheck2 = $conn->query("SHOW COLUMNS FROM passengers LIKE 'fare'");
if ($colCheck2->num_rows === 0) {
    $conn->query("ALTER TABLE passengers ADD COLUMN fare INT DEFAULT 0");
}

$sql = "INSERT INTO passengers
(passenger_name, from_city, to_city, travel_date, departure_date, arrival_date, phone, email, seat_class, fare)
VALUES
('$name','$from','$to','$date','$departure','$arrival','$phone','$email','$seat_class','$fare')";

if ($conn->query($sql) === TRUE) {
?>
<!DOCTYPE html>
<html><head><title>Booking Confirmed</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;600&display=swap" rel="stylesheet">
<style>
body{font-family:'DM Sans',sans-serif;background:#0a1628;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;}
.box{background:#fff;border-radius:24px;padding:48px 44px;max-width:460px;width:90%;text-align:center;box-shadow:0 40px 80px rgba(0,0,0,0.5);}
.check{width:64px;height:64px;background:linear-gradient(135deg,#2d9e6b,#34c47a);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;margin:0 auto 20px;}
h2{font-family:'Playfair Display',serif;font-size:26px;color:#0a1628;margin-bottom:8px;}
p{color:#6b7a8d;font-size:14px;margin-bottom:28px;}
.detail{background:#f5f0e8;border-radius:12px;padding:16px 20px;margin-bottom:24px;text-align:left;}
.detail-row{display:flex;justify-content:space-between;font-size:13px;margin-bottom:6px;}
.detail-row:last-child{margin-bottom:0;}
.detail-row .k{color:#6b7a8d;}
.detail-row .v{font-weight:600;color:#0a1628;}
.btns{display:flex;gap:12px;}
a.btn-p{flex:1;padding:13px;background:#0a1628;color:#e8c97a;border-radius:10px;text-decoration:none;font-weight:600;font-size:13px;text-align:center;}
a.btn-s{flex:1;padding:13px;background:#f5f0e8;color:#0a1628;border-radius:10px;text-decoration:none;font-weight:600;font-size:13px;text-align:center;}
</style>
</head><body>
<div class="box">
  <div class="check">✓</div>
  <h2>Booking Confirmed!</h2>
  <p>Your flight has been successfully booked.</p>
  <div class="detail">
    <div class="detail-row"><span class="k">Passenger</span><span class="v"><?= htmlspecialchars($name) ?></span></div>
    <div class="detail-row"><span class="k">Route</span><span class="v"><?= htmlspecialchars($from) ?> → <?= htmlspecialchars($to) ?></span></div>
    <div class="detail-row"><span class="k">Departure</span><span class="v"><?= $departure ?></span></div>
    <div class="detail-row"><span class="k">Class</span><span class="v"><?= htmlspecialchars($seat_class) ?></span></div>
    <div class="detail-row"><span class="k">Fare</span><span class="v">₹ <?= number_format($fare) ?></span></div>
  </div>
  <div class="btns">
    <a href="view.php" class="btn-p">View All Bookings</a>
    <a href="index.php" class="btn-s">Book Another</a>
  </div>
</div>
</body></html>
<?php
} else {
    echo "<!DOCTYPE html><html><head><title>Error</title>
    <style>body{font-family:sans-serif;background:#0a1628;display:flex;align-items:center;justify-content:center;min-height:100vh;}
    .b{background:#fff;padding:40px;border-radius:20px;text-align:center;max-width:400px;}
    h2{color:#e05252;}p{color:#555;margin:12px 0 20px;}
    a{padding:12px 24px;background:#0a1628;color:#e8c97a;border-radius:10px;text-decoration:none;font-weight:600;}
    </style></head><body><div class='b'>
    <h2>Database Error</h2>
    <p>" . htmlspecialchars($conn->error) . "</p>
    <a href='javascript:history.back()'>← Go Back</a>
    </div></body></html>";
}
?>