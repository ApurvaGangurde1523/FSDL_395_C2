<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SkyLine — Book Your Flight</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --navy: #0a1628;
  --navy2: #112240;
  --gold: #c9a84c;
  --gold2: #e8c97a;
  --sky: #4a9eff;
  --cream: #f5f0e8;
  --cream2: #ede8df;
  --white: #ffffff;
  --text: #1a2332;
  --muted: #6b7a8d;
  --error: #e05252;
  --success: #2d9e6b;
  --border: rgba(201,168,76,0.25);
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--navy);
  min-height: 100vh;
  color: var(--text);
  overflow-x: hidden;
}

/* Sky background */
body::before {
  content: '';
  position: fixed;
  inset: 0;
  background:
    radial-gradient(ellipse 80% 50% at 50% -10%, rgba(74,158,255,0.18) 0%, transparent 60%),
    radial-gradient(ellipse 40% 30% at 80% 20%, rgba(201,168,76,0.1) 0%, transparent 50%),
    linear-gradient(180deg, #0a1628 0%, #0d1e35 60%, #112240 100%);
  pointer-events: none;
  z-index: 0;
}

/* Stars */
body::after {
  content: '';
  position: fixed;
  inset: 0;
  background-image:
    radial-gradient(1px 1px at 15% 12%, rgba(255,255,255,0.7) 0%, transparent 100%),
    radial-gradient(1px 1px at 35% 8%, rgba(255,255,255,0.5) 0%, transparent 100%),
    radial-gradient(1px 1px at 65% 5%, rgba(255,255,255,0.6) 0%, transparent 100%),
    radial-gradient(1.5px 1.5px at 80% 15%, rgba(255,255,255,0.4) 0%, transparent 100%),
    radial-gradient(1px 1px at 92% 22%, rgba(255,255,255,0.7) 0%, transparent 100%),
    radial-gradient(1px 1px at 22% 30%, rgba(255,255,255,0.3) 0%, transparent 100%),
    radial-gradient(1px 1px at 55% 18%, rgba(255,255,255,0.5) 0%, transparent 100%),
    radial-gradient(1px 1px at 75% 35%, rgba(255,255,255,0.4) 0%, transparent 100%);
  pointer-events: none;
  z-index: 0;
}

.wrap { position: relative; z-index: 1; max-width: 860px; margin: 0 auto; padding: 0 20px 60px; }

/* NAV */
nav {
  display: flex; align-items: center; justify-content: space-between;
  padding: 28px 0 36px;
}
.brand { display: flex; align-items: center; gap: 12px; text-decoration: none; }
.brand-icon {
  width: 42px; height: 42px;
  background: linear-gradient(135deg, var(--gold), var(--gold2));
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
}
.brand-text .name {
  font-family: 'Playfair Display', serif;
  font-size: 22px; font-weight: 700;
  color: var(--white); letter-spacing: -0.3px;
}
.brand-text .sub { font-size: 11px; color: rgba(255,255,255,0.45); letter-spacing: 0.08em; text-transform: uppercase; }
.nav-links { display: flex; gap: 4px; }
.nav-links a {
  font-size: 13px; font-weight: 500;
  color: rgba(255,255,255,0.65);
  text-decoration: none;
  padding: 8px 16px; border-radius: 8px;
  border: 1px solid transparent;
  transition: all 0.2s;
}
.nav-links a:hover { color: var(--white); background: rgba(255,255,255,0.07); }
.nav-links a.active {
  color: var(--gold2);
  border-color: rgba(201,168,76,0.3);
  background: rgba(201,168,76,0.08);
}

/* HERO */
.hero { text-align: center; margin-bottom: 44px; }
.hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: clamp(32px, 5vw, 48px);
  font-weight: 700; color: var(--white); line-height: 1.15;
  margin-bottom: 12px;
}
.hero h1 span { color: var(--gold2); }
.hero p { font-size: 15px; color: rgba(255,255,255,0.5); font-weight: 300; }

/* CARD */
.card {
  background: rgba(255,255,255,0.97);
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 40px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(201,168,76,0.2);
}

/* CLASS SELECTOR */
.class-selector {
  display: grid; grid-template-columns: 1fr 1fr 1fr;
  gap: 0; border-bottom: 1px solid var(--cream2);
}
.class-opt { position: relative; }
.class-opt input { position: absolute; opacity: 0; width: 0; height: 0; }
.class-opt label {
  display: flex; flex-direction: column; align-items: center;
  gap: 4px; padding: 20px 12px;
  cursor: pointer; border-right: 1px solid var(--cream2);
  transition: all 0.2s; background: var(--cream);
}
.class-opt:last-child label { border-right: none; }
.class-opt label .cl-icon { font-size: 22px; }
.class-opt label .cl-name { font-size: 13px; font-weight: 600; color: var(--muted); transition: color 0.2s; }
.class-opt label .cl-price { font-size: 11px; color: #aaa; }
.class-opt input:checked + label {
  background: var(--navy);
}
.class-opt input:checked + label .cl-name { color: var(--gold2); }
.class-opt input:checked + label .cl-price { color: rgba(255,255,255,0.5); }

.form-body { padding: 36px; }

/* SECTION */
.sec-head {
  display: flex; align-items: center; gap: 10px;
  margin-bottom: 22px;
}
.sec-dot {
  width: 8px; height: 8px; border-radius: 50%;
  background: linear-gradient(135deg, var(--gold), var(--gold2));
  flex-shrink: 0;
}
.sec-head h3 {
  font-size: 11px; font-weight: 600; text-transform: uppercase;
  letter-spacing: 0.1em; color: var(--muted);
}
hr.divider { border: none; border-top: 1px solid var(--cream2); margin: 30px 0; }

/* FIELDS */
.row { display: grid; gap: 18px; margin-bottom: 18px; }
.row-2 { grid-template-columns: 1fr 1fr; }
.row-3 { grid-template-columns: 1fr 1fr 1fr; }

.field { display: flex; flex-direction: column; }
.field label {
  font-size: 12px; font-weight: 600; text-transform: uppercase;
  letter-spacing: 0.06em; color: var(--muted); margin-bottom: 7px;
}
.field input, .field select {
  padding: 12px 14px; border-radius: 10px;
  border: 1.5px solid var(--cream2);
  font-family: 'DM Sans', sans-serif;
  font-size: 14px; color: var(--text);
  background: var(--cream); outline: none;
  transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  -webkit-appearance: none; appearance: none;
}
.field input:focus, .field select:focus {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px rgba(201,168,76,0.15);
  background: var(--white);
}
.field input.error, .field select.error {
  border-color: var(--error);
  box-shadow: 0 0 0 3px rgba(224,82,82,0.12);
}
.field .err-msg {
  font-size: 11px; color: var(--error); margin-top: 5px;
  display: none; align-items: center; gap: 4px;
}
.field .err-msg.show { display: flex; }
.field .err-msg::before { content: '⚠'; font-size: 10px; }

/* ROUTE ARROW */
.route-row { display: grid; grid-template-columns: 1fr 44px 1fr; gap: 10px; align-items: end; margin-bottom: 18px; }
.route-arrow {
  height: 44px; display: flex; align-items: center; justify-content: center;
  color: var(--gold); font-size: 18px; padding-bottom: 2px;
}

/* FARE DISPLAY */
.fare-card {
  background: linear-gradient(135deg, var(--navy), var(--navy2));
  border-radius: 14px; padding: 20px 24px;
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 28px;
  border: 1px solid rgba(201,168,76,0.2);
}
.fare-left .label { font-size: 11px; color: rgba(255,255,255,0.45); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 4px; }
.fare-left .amount { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: var(--gold2); }
.fare-right { text-align: right; }
.fare-right .class-name { font-size: 12px; color: rgba(255,255,255,0.55); margin-bottom: 4px; }
.fare-right .note { font-size: 11px; color: rgba(255,255,255,0.3); }

/* SUBMIT */
.btn-submit {
  width: 100%; padding: 16px;
  background: linear-gradient(135deg, var(--navy) 0%, #1a3a6b 100%);
  color: var(--white); border: none; border-radius: 12px;
  font-family: 'DM Sans', sans-serif;
  font-size: 15px; font-weight: 600;
  cursor: pointer; letter-spacing: 0.02em;
  transition: all 0.2s;
  display: flex; align-items: center; justify-content: center; gap: 10px;
  position: relative; overflow: hidden;
}
.btn-submit::before {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold2) 100%);
  opacity: 0; transition: opacity 0.2s;
}
.btn-submit:hover::before { opacity: 1; }
.btn-submit span { position: relative; z-index: 1; }

@keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
.card { animation: fadeIn 0.5s ease both; }
</style>
</head>
<body>
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
      <a href="index.php" class="active">Book Flight</a>
      <a href="view.php">My Bookings</a>
      <a href="manage.php">Manage</a>
    </div>
  </nav>

  <div class="hero">
    <h1>Where would you like<br>to <span>fly today?</span></h1>
    <p>Book your next journey in just a few steps</p>
  </div>

  <div class="card">
    <!-- Cabin Class Selector -->
    <div class="class-selector">
      <div class="class-opt">
        <input type="radio" name="seat_class_top" id="eco" value="Economy" checked onchange="syncClass(this)">
        <label for="eco">
          <span class="cl-icon">💺</span>
          <span class="cl-name">Economy</span>
          <span class="cl-price">Best value</span>
        </label>
      </div>
      <div class="class-opt">
        <input type="radio" name="seat_class_top" id="biz" value="Business" onchange="syncClass(this)">
        <label for="biz">
          <span class="cl-icon">🛋️</span>
          <span class="cl-name">Business</span>
          <span class="cl-price">Premium comfort</span>
        </label>
      </div>
      <div class="class-opt">
        <input type="radio" name="seat_class_top" id="first" value="First Class" onchange="syncClass(this)">
        <label for="first">
          <span class="cl-icon">👑</span>
          <span class="cl-name">First Class</span>
          <span class="cl-price">Luxury experience</span>
        </label>
      </div>
    </div>

    <div class="form-body">
      <form id="bookingForm" action="insert.php" method="POST" onsubmit="return validateForm()">
        <input type="hidden" name="seat_class" id="seatClassInput" value="Economy">

        <!-- Passenger -->
        <div class="sec-head"><div class="sec-dot"></div><h3>Passenger Details</h3></div>
        <div class="row row-2">
          <div class="field" id="f-name">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="e.g. Rahul Sharma" autocomplete="name">
            <span class="err-msg" id="e-name">Please enter passenger name</span>
          </div>
          <div class="field" id="f-phone">
            <label>Phone Number</label>
            <input type="text" name="phone" placeholder="10-digit mobile number" maxlength="10" autocomplete="tel">
            <span class="err-msg" id="e-phone">Enter a valid 10-digit phone number</span>
          </div>
        </div>
        <div class="row row-2">
          <div class="field" id="f-email">
            <label>Email Address</label>
            <input type="text" name="email" placeholder="you@example.com" autocomplete="email">
            <span class="err-msg" id="e-email">Enter a valid email address</span>
          </div>
          <div class="field" id="f-date">
            <label>Travel Date</label>
            <input type="date" name="date">
            <span class="err-msg" id="e-date">Please select travel date</span>
          </div>
        </div>

        <hr class="divider">

        <!-- Flight -->
        <div class="sec-head"><div class="sec-dot"></div><h3>Flight Details</h3></div>
        <div class="route-row">
          <div class="field" id="f-from">
            <label>From</label>
            <select name="from" id="from" onchange="calculateFare()">
              <option value="">Select city</option>
              <option>Pune</option><option>Delhi</option>
              <option>Mumbai</option><option>Bangalore</option>
              <option>Chennai</option><option>Hyderabad</option>
            </select>
            <span class="err-msg" id="e-from">Select departure city</span>
          </div>
          <div class="route-arrow">→</div>
          <div class="field" id="f-to">
            <label>To</label>
            <select name="to" id="to" onchange="calculateFare()">
              <option value="">Select city</option>
              <option>Pune</option><option>Delhi</option>
              <option>Mumbai</option><option>Bangalore</option>
              <option>Chennai</option><option>Hyderabad</option>
            </select>
            <span class="err-msg" id="e-to">Select arrival city</span>
          </div>
        </div>
        <div class="row row-2">
          <div class="field" id="f-dep">
            <label>Departure Date</label>
            <input type="date" name="departure" id="departure" onchange="validateDates()">
            <span class="err-msg" id="e-dep">Select departure date</span>
          </div>
          <div class="field" id="f-arr">
            <label>Arrival Date</label>
            <input type="date" name="arrival" id="arrival" onchange="validateDates()">
            <span class="err-msg" id="e-arr">Arrival must be on or after departure</span>
          </div>
        </div>

        <!-- Fare Display -->
        <div class="fare-card">
          <div class="fare-left">
            <div class="label">Estimated Fare</div>
            <div class="amount" id="fareDisplay">₹ —</div>
          </div>
          <div class="fare-right">
            <div class="class-name" id="classDisplay">Economy Class</div>
            <div class="note">Taxes & fees included</div>
          </div>
        </div>
        <input type="hidden" name="fare" id="fareInput">

        <button type="submit" class="btn-submit">
          <span>✈ &nbsp;Confirm Booking</span>
        </button>
      </form>
    </div>
  </div>
</div>

<script>
const fareBase = {
  "Pune-Delhi":8500,"Pune-Mumbai":3500,"Pune-Bangalore":6000,"Pune-Chennai":7000,"Pune-Hyderabad":5500,
  "Delhi-Mumbai":7500,"Delhi-Bangalore":9000,"Delhi-Chennai":9500,"Delhi-Hyderabad":8000,
  "Mumbai-Bangalore":6500,"Mumbai-Chennai":5500,"Mumbai-Hyderabad":5000,
  "Bangalore-Chennai":3000,"Bangalore-Hyderabad":4000,"Chennai-Hyderabad":3500
};
const classMul = {"Economy":1,"Business":2.4,"First Class":3.8};
let currentClass = "Economy";

function syncClass(el) {
  currentClass = el.value;
  document.getElementById('seatClassInput').value = currentClass;
  document.getElementById('classDisplay').textContent = currentClass + ' Class';
  calculateFare();
}

function getBaseFare(from, to) {
  return fareBase[from+"-"+to] || fareBase[to+"-"+from] || 4500;
}

function calculateFare() {
  const from = document.getElementById('from').value;
  const to = document.getElementById('to').value;
  if (!from || !to || from === to) {
    document.getElementById('fareDisplay').textContent = '₹ —';
    document.getElementById('fareInput').value = '';
    return;
  }
  const base = getBaseFare(from, to);
  const fare = Math.round(base * classMul[currentClass]);
  document.getElementById('fareDisplay').textContent = '₹ ' + fare.toLocaleString('en-IN');
  document.getElementById('fareInput').value = fare;
}

function setErr(id, show) {
  const field = document.getElementById('f-' + id);
  const msg = document.getElementById('e-' + id);
  if (!field || !msg) return;
  const inp = field.querySelector('input,select');
  if (show) { inp && inp.classList.add('error'); msg.classList.add('show'); }
  else { inp && inp.classList.remove('error'); msg.classList.remove('show'); }
  return show;
}

function validateDates() {
  const dep = document.getElementById('departure').value;
  const arr = document.getElementById('arrival').value;
  if (dep && arr && arr < dep) {
    setErr('arr', true);
    return false;
  }
  setErr('arr', false);
  return true;
}

function validateForm() {
  let ok = true;
  const form = document.getElementById('bookingForm');
  const name = form.name.value.trim();
  const phone = form.phone.value.trim();
  const email = form.email.value.trim();
  const date = form.date.value;
  const from = form.from.value;
  const to = form.to.value;
  const dep = form.departure.value;
  const arr = form.arrival.value;
  const today = new Date().toISOString().split('T')[0];

  if (!name || name.length < 2) { setErr('name', true); ok = false; } else setErr('name', false);
  if (!/^\d{10}$/.test(phone)) { setErr('phone', true); ok = false; } else setErr('phone', false);
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { setErr('email', true); ok = false; } else setErr('email', false);
  if (!date || date < today) { setErr('date', true); document.getElementById('e-date').textContent = date ? 'Travel date cannot be in the past' : 'Please select travel date'; ok = false; } else setErr('date', false);
  if (!from) { setErr('from', true); ok = false; } else setErr('from', false);
  if (!to) { setErr('to', true); ok = false; } else { if (to === from) { setErr('to', true); document.getElementById('e-to').textContent = 'Origin and destination cannot be same'; ok = false; } else setErr('to', false); }
  if (!dep) { setErr('dep', true); ok = false; } else setErr('dep', false);
  if (!arr) { setErr('arr', true); document.getElementById('e-arr').textContent = 'Select arrival date'; ok = false; } else if (arr < dep) { setErr('arr', true); document.getElementById('e-arr').textContent = 'Arrival must be on or after departure'; ok = false; } else setErr('arr', false);

  if (!ok) {
    const firstErr = document.querySelector('.error');
    if (firstErr) firstErr.scrollIntoView({ behavior:'smooth', block:'center' });
  }
  return ok;
}

// Set today as min date
const today = new Date().toISOString().split('T')[0];
document.querySelectorAll('input[type=date]').forEach(i => i.min = today);
</script>
</body>
</html>

//http://localhost/flight_booking/index.php