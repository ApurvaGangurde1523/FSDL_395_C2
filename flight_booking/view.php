<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkyLine — All Bookings</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0a1628;--navy2:#112240;--gold:#c9a84c;--gold2:#e8c97a;--cream:#f5f0e8;--cream2:#ede8df;--white:#ffffff;--text:#1a2332;--muted:#6b7a8d;--error:#e05252;--success:#2d9e6b;}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--navy);min-height:100vh;color:var(--text);}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse 80% 50% at 50% -10%,rgba(74,158,255,0.18) 0%,transparent 60%),linear-gradient(180deg,#0a1628 0%,#0d1e35 60%,#112240 100%);pointer-events:none;z-index:0;}
.wrap{position:relative;z-index:1;max-width:1020px;margin:0 auto;padding:0 20px 60px;}
nav{display:flex;align-items:center;justify-content:space-between;padding:28px 0 36px;}
.brand{display:flex;align-items:center;gap:12px;text-decoration:none;}
.brand-icon{width:42px;height:42px;background:linear-gradient(135deg,var(--gold),var(--gold2));border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;}
.brand-text .name{font-family:'Playfair Display',serif;font-size:22px;font-weight:700;color:var(--white);letter-spacing:-0.3px;}
.brand-text .sub{font-size:11px;color:rgba(255,255,255,0.45);letter-spacing:0.08em;text-transform:uppercase;}
.nav-links{display:flex;gap:4px;}
.nav-links a{font-size:13px;font-weight:500;color:rgba(255,255,255,0.65);text-decoration:none;padding:8px 16px;border-radius:8px;border:1px solid transparent;transition:all 0.2s;}
.nav-links a:hover{color:var(--white);background:rgba(255,255,255,0.07);}
.nav-links a.active{color:var(--gold2);border-color:rgba(201,168,76,0.3);background:rgba(201,168,76,0.08);}
.hero{text-align:center;margin-bottom:36px;}
.hero h1{font-family:'Playfair Display',serif;font-size:clamp(28px,4vw,42px);font-weight:700;color:var(--white);margin-bottom:10px;}
.hero h1 span{color:var(--gold2);}
.hero p{font-size:15px;color:rgba(255,255,255,0.5);}
.card{background:rgba(255,255,255,0.97);border-radius:24px;overflow:hidden;box-shadow:0 40px 80px rgba(0,0,0,0.5),0 0 0 1px rgba(201,168,76,0.15);}
.card-top{padding:28px 32px;display:flex;align-items:center;gap:16px;border-bottom:1px solid var(--cream2);}
.card-top h2{font-family:'Playfair Display',serif;font-size:20px;color:var(--navy);flex:1;}
.search-form{display:flex;gap:10px;align-items:center;}
.search-form input{padding:10px 16px;border:1.5px solid var(--cream2);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13px;color:var(--text);background:var(--cream);outline:none;transition:border-color 0.2s;width:220px;}
.search-form input:focus{border-color:var(--gold);background:var(--white);}
.btn-go{padding:10px 20px;background:var(--navy);color:var(--gold2);border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:600;cursor:pointer;transition:opacity 0.2s;}
.btn-go:hover{opacity:0.85;}
.btn-clear{padding:10px 16px;background:var(--cream);color:var(--muted);border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;cursor:pointer;text-decoration:none;display:inline-block;}

/* Table */
.tbl-wrap{overflow-x:auto;}
table{width:100%;border-collapse:collapse;}
thead tr{background:var(--cream);}
thead th{padding:12px 20px;text-align:left;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.07em;color:var(--muted);border-bottom:1px solid var(--cream2);white-space:nowrap;}
tbody tr{border-bottom:1px solid #f5f5f5;transition:background 0.1s;}
tbody tr:hover{background:#fafaf8;}
tbody td{padding:14px 20px;font-size:13.5px;color:var(--text);vertical-align:middle;}
.route{display:flex;align-items:center;gap:6px;font-weight:600;}
.route-arr{color:var(--gold);font-size:12px;}
.class-badge{display:inline-block;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;white-space:nowrap;}
.badge-eco{background:rgba(45,158,107,0.1);color:#1a6b47;border:1px solid rgba(45,158,107,0.2);}
.badge-biz{background:rgba(201,168,76,0.12);color:#7a5b10;border:1px solid rgba(201,168,76,0.3);}
.badge-first{background:rgba(10,22,40,0.08);color:var(--navy);border:1px solid rgba(10,22,40,0.15);}
.fare-amt{font-weight:600;color:var(--navy);}
.empty-state{text-align:center;padding:72px 20px;}
.empty-state .icon{font-size:44px;margin-bottom:16px;}
.empty-state h3{font-family:'Playfair Display',serif;font-size:22px;color:var(--navy);margin-bottom:8px;}
.empty-state p{font-size:14px;color:var(--muted);margin-bottom:24px;}
.empty-state a{display:inline-block;padding:12px 28px;background:var(--navy);color:var(--gold2);border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;}
.stats-row{display:flex;gap:0;border-bottom:1px solid var(--cream2);}
.stat{flex:1;padding:18px 24px;text-align:center;border-right:1px solid var(--cream2);}
.stat:last-child{border-right:none;}
.stat .num{font-family:'Playfair Display',serif;font-size:26px;font-weight:700;color:var(--navy);}
.stat .lbl{font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em;margin-top:2px;}
@keyframes fadeIn{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.card{animation:fadeIn 0.4s ease both;}
</style>
</head>
<body>
<?php include 'db.php'; ?>
<div class="wrap">
  <nav>
    <a class="brand" href="index.php">
      <div class="brand-icon">✈</div>
      <div class="brand-text">
        <div class="name">SkyLine</div>
        <div class="sub">Air Travel</div>
      </div>
    </a>
    <div class="nav-links">
      <a href="index.php">Book Flight</a>
      <a href="view.php" class="active">My Bookings</a>
      <a href="manage.php">Manage</a>
    </div>
  </nav>

  <div class="hero">
    <h1>All <span>Bookings</span></h1>
    <p>Browse and search passenger reservations</p>
  </div>

  <?php
  $searching = isset($_GET['phone']) && $_GET['phone'] !== '';
  if ($searching) {
    $phone = $conn->real_escape_string($_GET['phone']);
    $result = $conn->query("SELECT * FROM passengers WHERE phone='$phone' ORDER BY id DESC");
  } else {
    $result = $conn->query("SELECT * FROM passengers ORDER BY id DESC");
  }
  $total = $conn->query("SELECT COUNT(*) as c FROM passengers")->fetch_assoc()['c'];
  $totalFare = $conn->query("SELECT COALESCE(SUM(fare),0) as s FROM passengers")->fetch_assoc()['s'];
  // Check if fare column exists
  $hasFare = $conn->query("SHOW COLUMNS FROM passengers LIKE 'fare'")->num_rows > 0;
  $hasClass = $conn->query("SHOW COLUMNS FROM passengers LIKE 'seat_class'")->num_rows > 0;
  ?>

  <div class="card">
    <?php if (!$searching): ?>
    <div class="stats-row">
      <div class="stat"><div class="num"><?= $total ?></div><div class="lbl">Total Bookings</div></div>
      <?php if ($hasFare): ?>
      <div class="stat"><div class="num">₹<?= number_format($totalFare) ?></div><div class="lbl">Total Revenue</div></div>
      <?php endif; ?>
      <div class="stat"><div class="num"><?= $conn->query("SELECT COUNT(DISTINCT from_city) as c FROM passengers")->fetch_assoc()['c'] ?></div><div class="lbl">Departure Cities</div></div>
    </div>
    <?php endif; ?>

    <div class="card-top">
      <h2>Passenger Records</h2>
      <form class="search-form" method="GET">
        <input type="text" name="phone" placeholder="Search by phone..." value="<?= isset($_GET['phone']) ? htmlspecialchars($_GET['phone']) : '' ?>">
        <button type="submit" class="btn-go">Search</button>
        <?php if ($searching): ?>
          <a href="view.php" class="btn-clear">Clear</a>
        <?php endif; ?>
      </form>
    </div>

    <div class="tbl-wrap">
      <?php if ($result && $result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Passenger</th>
            <th>Route</th>
            <th>Travel Date</th>
            <th>Departure</th>
            <th>Arrival</th>
            <?php if ($hasClass): ?><th>Class</th><?php endif; ?>
            <?php if ($hasFare): ?><th>Fare</th><?php endif; ?>
            <th>Phone</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
        <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td style="color:#bbb;font-size:12px"><?= $i++ ?></td>
            <td style="font-weight:600"><?= htmlspecialchars($row['passenger_name']) ?></td>
            <td>
              <div class="route">
                <?= htmlspecialchars($row['from_city']) ?>
                <span class="route-arr">→</span>
                <?= htmlspecialchars($row['to_city']) ?>
              </div>
            </td>
            <td><?= $row['travel_date'] ?></td>
            <td><?= $row['departure_date'] ?></td>
            <td><?= $row['arrival_date'] ?></td>
            <?php if ($hasClass):
              $cls = $row['seat_class'] ?? 'Economy';
              $badgeCls = $cls === 'First Class' ? 'badge-first' : ($cls === 'Business' ? 'badge-biz' : 'badge-eco');
            ?>
            <td><span class="class-badge <?= $badgeCls ?>"><?= htmlspecialchars($cls) ?></span></td>
            <?php endif; ?>
            <?php if ($hasFare): ?>
            <td class="fare-amt">₹<?= number_format($row['fare'] ?? 0) ?></td>
            <?php endif; ?>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td style="color:var(--muted);font-size:13px"><?= htmlspecialchars($row['email']) ?></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
      <?php else: ?>
      <div class="empty-state">
        <div class="icon">✈</div>
        <h3><?= $searching ? 'No booking found' : 'No bookings yet' ?></h3>
        <p><?= $searching ? 'No passenger found with phone number "' . htmlspecialchars($_GET['phone']) . '"' : 'Start by booking your first flight!' ?></p>
        <a href="index.php">Book a Flight</a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
</body>
</html>