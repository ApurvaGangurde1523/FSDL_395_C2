<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkyLine — Manage Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --navy:#0a1628;--navy2:#112240;--gold:#c9a84c;--gold2:#e8c97a;
  --cream:#f5f0e8;--cream2:#ede8df;--white:#ffffff;
  --text:#1a2332;--muted:#6b7a8d;--error:#e05252;--success:#2d9e6b;
}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--navy);min-height:100vh;color:var(--text);}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse 80% 50% at 50% -10%,rgba(74,158,255,0.18) 0%,transparent 60%),linear-gradient(180deg,#0a1628 0%,#0d1e35 60%,#112240 100%);pointer-events:none;z-index:0;}
.wrap{position:relative;z-index:1;max-width:860px;margin:0 auto;padding:0 20px 60px;}
nav{display:flex;align-items:center;justify-content:space-between;padding:28px 0 36px;}
.brand{display:flex;align-items:center;gap:12px;text-decoration:none;}
.brand-icon{width:42px;height:42px;background:linear-gradient(135deg,var(--gold),var(--gold2));border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;}
.brand-text .name{font-family:'Playfair Display',serif;font-size:22px;font-weight:700;color:var(--white);letter-spacing:-0.3px;}
.brand-text .sub{font-size:11px;color:rgba(255,255,255,0.45);letter-spacing:0.08em;text-transform:uppercase;}
.nav-links{display:flex;gap:4px;}
.nav-links a{font-size:13px;font-weight:500;color:rgba(255,255,255,0.65);text-decoration:none;padding:8px 16px;border-radius:8px;border:1px solid transparent;transition:all 0.2s;}
.nav-links a:hover{color:var(--white);background:rgba(255,255,255,0.07);}
.nav-links a.active{color:var(--gold2);border-color:rgba(201,168,76,0.3);background:rgba(201,168,76,0.08);}
.hero{text-align:center;margin-bottom:44px;}
.hero h1{font-family:'Playfair Display',serif;font-size:clamp(28px,4vw,42px);font-weight:700;color:var(--white);margin-bottom:10px;}
.hero h1 span{color:var(--gold2);}
.hero p{font-size:15px;color:rgba(255,255,255,0.5);font-weight:300;}
.grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;}

/* Cards */
.mcard{background:rgba(255,255,255,0.97);border-radius:24px;overflow:hidden;box-shadow:0 30px 60px rgba(0,0,0,0.4),0 0 0 1px rgba(201,168,76,0.15);}
.mcard-header{padding:24px 28px 0;}
.mcard-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:14px;}
.delete .mcard-icon{background:rgba(224,82,82,0.1);}
.update .mcard-icon{background:rgba(201,168,76,0.12);}
.mcard h2{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--navy);margin-bottom:4px;}
.mcard .sub{font-size:13px;color:var(--muted);margin-bottom:0;}
.mcard-body{padding:24px 28px 28px;}
.divider-line{border:none;border-top:1px solid var(--cream2);margin:20px 0;}

.field{margin-bottom:16px;}
.field label{display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:var(--muted);margin-bottom:7px;}
.field input{width:100%;padding:12px 14px;border-radius:10px;border:1.5px solid var(--cream2);font-family:'DM Sans',sans-serif;font-size:14px;color:var(--text);background:var(--cream);outline:none;transition:border-color 0.2s,box-shadow 0.2s;}
.field input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,0.15);background:var(--white);}
.field input.error{border-color:var(--error);box-shadow:0 0 0 3px rgba(224,82,82,0.12);}
.err-msg{font-size:11px;color:var(--error);margin-top:5px;display:none;}
.err-msg.show{display:block;}

/* Search result preview */
.preview{background:var(--cream);border-radius:12px;padding:16px;margin-bottom:16px;display:none;}
.preview.show{display:block;}
.preview-title{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:var(--muted);margin-bottom:10px;}
.preview-row{display:flex;justify-content:space-between;font-size:13px;margin-bottom:5px;}
.preview-row .k{color:var(--muted);}
.preview-row .v{font-weight:600;color:var(--navy);}

.btn-search{width:100%;padding:12px;background:var(--cream2);color:var(--navy);border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:600;cursor:pointer;transition:background 0.2s;margin-bottom:12px;}
.btn-search:hover{background:#d8d0c4;}

.btn-delete{width:100%;padding:14px;background:linear-gradient(135deg,#c0392b,#e05252);color:#fff;border:none;border-radius:12px;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:600;cursor:pointer;transition:opacity 0.2s;display:flex;align-items:center;justify-content:center;gap:8px;}
.btn-delete:hover{opacity:0.9;}

.btn-update{width:100%;padding:14px;background:linear-gradient(135deg,var(--navy),#1a3a6b);color:var(--gold2);border:none;border-radius:12px;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:600;cursor:pointer;transition:opacity 0.2s;display:flex;align-items:center;justify-content:center;gap:8px;}
.btn-update:hover{opacity:0.9;}

.warn-box{background:rgba(224,82,82,0.06);border:1px solid rgba(224,82,82,0.2);border-radius:10px;padding:12px 14px;font-size:12px;color:#9b2a2a;margin-top:12px;display:flex;gap:8px;align-items:flex-start;}

/* Toast / message */
.toast{position:fixed;top:28px;right:28px;padding:16px 22px;border-radius:12px;font-size:14px;font-weight:600;z-index:999;display:none;box-shadow:0 8px 32px rgba(0,0,0,0.3);}
.toast.success{background:#2d9e6b;color:#fff;}
.toast.error{background:#e05252;color:#fff;}
.toast.show{display:block;}

@keyframes fadeIn{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
.mcard{animation:fadeIn 0.4s ease both;}
.mcard:nth-child(2){animation-delay:0.1s;}
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
      <a href="view.php">My Bookings</a>
      <a href="manage.php" class="active">Manage</a>
    </div>
  </nav>

  <div class="hero">
    <h1>Manage Your <span>Booking</span></h1>
    <p>Update contact details or cancel your reservation</p>
  </div>

  <?php
  $msg = ''; $msgType = '';
  // Handle delete
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $phone = $conn->real_escape_string(trim($_POST['phone'] ?? ''));
    if (!preg_match('/^\d{10}$/', $phone)) {
      $msg = 'Please enter a valid 10-digit phone number.'; $msgType = 'error';
    } else {
      $check = $conn->query("SELECT id FROM passengers WHERE phone='$phone'");
      if ($check->num_rows === 0) {
        $msg = 'No booking found with that phone number.'; $msgType = 'error';
      } else {
        $conn->query("DELETE FROM passengers WHERE phone='$phone'");
        $msg = 'Booking deleted successfully.'; $msgType = 'success';
      }
    }
  }
  // Handle update
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $phone = $conn->real_escape_string(trim($_POST['phone'] ?? ''));
    $email = $conn->real_escape_string(trim($_POST['email'] ?? ''));
    if (!preg_match('/^\d{10}$/', $phone)) {
      $msg = 'Please enter a valid 10-digit phone number.'; $msgType = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $msg = 'Please enter a valid email address.'; $msgType = 'error';
    } else {
      $check = $conn->query("SELECT id FROM passengers WHERE phone='$phone'");
      if ($check->num_rows === 0) {
        $msg = 'No booking found with that phone number.'; $msgType = 'error';
      } else {
        $conn->query("UPDATE passengers SET email='$email' WHERE phone='$phone'");
        $msg = 'Email updated successfully.'; $msgType = 'success';
      }
    }
  }
  if ($msg): ?>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      var t = document.getElementById('toast');
      t.textContent = '<?= addslashes($msg) ?>';
      t.className = 'toast <?= $msgType ?> show';
      setTimeout(function(){ t.classList.remove('show'); }, 4000);
    });
  </script>
  <?php endif; ?>

  <div class="grid">
    <!-- DELETE CARD -->
    <div class="mcard delete">
      <div class="mcard-header">
        <div class="mcard-icon">🗑️</div>
        <h2>Cancel Booking</h2>
        <p class="sub">Remove a reservation by phone number</p>
      </div>
      <div class="mcard-body">
        <!-- Search first -->
        <div class="field" id="df-phone">
          <label>Phone Number</label>
          <input type="text" id="del-phone-search" placeholder="Enter 10-digit number" maxlength="10">
          <div class="err-msg" id="del-err">Please enter a valid 10-digit phone number</div>
        </div>
        <button type="button" class="btn-search" onclick="lookupRecord('del')">🔍 Find Booking</button>

        <div class="preview" id="del-preview">
          <div class="preview-title">Booking Found</div>
          <div class="preview-row"><span class="k">Name</span><span class="v" id="dp-name">—</span></div>
          <div class="preview-row"><span class="k">Route</span><span class="v" id="dp-route">—</span></div>
          <div class="preview-row"><span class="k">Departure</span><span class="v" id="dp-dep">—</span></div>
          <div class="preview-row"><span class="k">Class</span><span class="v" id="dp-class">—</span></div>
        </div>

        <form method="POST" id="del-form" style="display:none" onsubmit="return confirmDelete()">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="phone" id="del-phone-hidden">
          <button type="submit" class="btn-delete">🗑 Cancel This Booking</button>
        </form>
        <div class="warn-box">⚠ This action permanently removes the booking and cannot be undone.</div>
      </div>
    </div>

    <!-- UPDATE CARD -->
    <div class="mcard update">
      <div class="mcard-header">
        <div class="mcard-icon">✏️</div>
        <h2>Update Contact</h2>
        <p class="sub">Change the email for a booking</p>
      </div>
      <div class="mcard-body">
        <div class="field" id="uf-phone">
          <label>Phone Number</label>
          <input type="text" id="upd-phone-search" placeholder="Enter 10-digit number" maxlength="10">
          <div class="err-msg" id="upd-err">Please enter a valid 10-digit phone number</div>
        </div>
        <button type="button" class="btn-search" onclick="lookupRecord('upd')">🔍 Find Booking</button>

        <div class="preview" id="upd-preview">
          <div class="preview-title">Booking Found</div>
          <div class="preview-row"><span class="k">Name</span><span class="v" id="up-name">—</span></div>
          <div class="preview-row"><span class="k">Route</span><span class="v" id="up-route">—</span></div>
          <div class="preview-row"><span class="k">Current Email</span><span class="v" id="up-email">—</span></div>
        </div>

        <form method="POST" id="upd-form" style="display:none">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="phone" id="upd-phone-hidden">
          <hr class="divider-line">
          <div class="field" id="uf-email">
            <label>New Email Address</label>
            <input type="email" name="email" id="upd-email-input" placeholder="new@example.com">
            <div class="err-msg" id="upd-email-err">Enter a valid email address</div>
          </div>
          <button type="submit" class="btn-update" onclick="return validateUpdate()">✓ Update Email</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="toast" id="toast"></div>

<script>
function lookupRecord(type) {
  const phoneEl = document.getElementById(type === 'del' ? 'del-phone-search' : 'upd-phone-search');
  const phone = phoneEl.value.trim();
  const errEl = document.getElementById(type === 'del' ? 'del-err' : 'upd-err');

  if (!/^\d{10}$/.test(phone)) {
    phoneEl.classList.add('error');
    errEl.classList.add('show');
    return;
  }
  phoneEl.classList.remove('error');
  errEl.classList.remove('show');

  fetch('lookup.php?phone=' + encodeURIComponent(phone))
    .then(r => r.json())
    .then(data => {
      if (!data.found) {
        phoneEl.classList.add('error');
        errEl.textContent = 'No booking found with this phone number';
        errEl.classList.add('show');
        document.getElementById(type + '-preview').classList.remove('show');
        document.getElementById(type + '-form').style.display = 'none';
        return;
      }
      if (type === 'del') {
        document.getElementById('dp-name').textContent = data.name;
        document.getElementById('dp-route').textContent = data.from + ' → ' + data.to;
        document.getElementById('dp-dep').textContent = data.departure;
        document.getElementById('dp-class').textContent = data.seat_class || 'Economy';
        document.getElementById('del-phone-hidden').value = phone;
        document.getElementById('del-preview').classList.add('show');
        document.getElementById('del-form').style.display = 'block';
      } else {
        document.getElementById('up-name').textContent = data.name;
        document.getElementById('up-route').textContent = data.from + ' → ' + data.to;
        document.getElementById('up-email').textContent = data.email;
        document.getElementById('upd-phone-hidden').value = phone;
        document.getElementById('upd-preview').classList.add('show');
        document.getElementById('upd-form').style.display = 'block';
      }
    })
    .catch(() => {
      errEl.textContent = 'Could not connect. Please try again.';
      errEl.classList.add('show');
    });
}

function confirmDelete() {
  return confirm('Are you sure you want to permanently cancel this booking?');
}

function validateUpdate() {
  const email = document.getElementById('upd-email-input').value.trim();
  const errEl = document.getElementById('upd-email-err');
  const inp = document.getElementById('upd-email-input');
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    inp.classList.add('error');
    errEl.classList.add('show');
    return false;
  }
  inp.classList.remove('error');
  errEl.classList.remove('show');
  return true;
}
</script>
</body>
</html>