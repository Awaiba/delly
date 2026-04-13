<?php

if (!isset($_SESSION['base_url'])) {
    $_SESSION['base_url'] = "http://localhost/college-project/admin/view";
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: " . $_SESSION['base_url'] . "?r=login");
    exit;
}


// ============================================================
//  DB CONNECTION — update these credentials
// ============================================================
$host = "localhost";
$db   = "delly";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ============================================================
//  METRIC CARDS
// ============================================================
$totalOrders   = $conn->query("SELECT COUNT(*) AS c FROM courier")->fetch_assoc()['c'];
$totalUsers    = $conn->query("SELECT COUNT(*) AS c FROM user")->fetch_assoc()['c'];
$totalStaff    = $conn->query("SELECT COUNT(*) AS c FROM staff")->fetch_assoc()['c'];
$deliveredToday = $conn->query("SELECT COUNT(*) AS c FROM courier WHERE status = 2 AND date = CURDATE()")->fetch_assoc()['c'];

// ============================================================
//  CHART 1 — Monthly orders (last 6 months)
// ============================================================
$monthlyOrders = $conn->query("
    SELECT 
        DATE_FORMAT(STR_TO_DATE(date, '%d/%m/%Y'), '%b') AS month,
        COUNT(*) AS total
    FROM courier
    WHERE STR_TO_DATE(date, '%d/%m/%Y') >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
    GROUP BY YEAR(STR_TO_DATE(date, '%d/%m/%Y')),
             MONTH(STR_TO_DATE(date, '%d/%m/%Y'))
    ORDER BY YEAR(STR_TO_DATE(date, '%d/%m/%Y')),
             MONTH(STR_TO_DATE(date, '%d/%m/%Y'))
");
$monthLabels = []; $monthData = [];
while ($row = $monthlyOrders->fetch_assoc()) {
    $monthLabels[] = $row['month'];
    $monthData[]   = (int)$row['total'];
}

// ============================================================
//  CHART 2 — Order status breakdown
//  status: 0=Pending, 1=In Transit, 2=Delivered, 3=Cancelled
// ============================================================
$statusResult = $conn->query("SELECT status, COUNT(*) AS total FROM courier GROUP BY status");
$statusMap = [0 => 'Pending', 1 => 'In Transit', 2 => 'Delivered', 3 => 'Cancelled'];
$statusData = [0 => 0, 1 => 0, 2 => 0, 3 => 0];
while ($row = $statusResult->fetch_assoc()) {
    $statusData[(int)$row['status']] = (int)$row['total'];
}

// ============================================================
//  CHART 3 — Gender distribution (users vs staff)
// ============================================================
$userGender  = $conn->query("SELECT gender, COUNT(*) AS c FROM user GROUP BY gender");
$staffGender = $conn->query("SELECT gender, COUNT(*) AS c FROM staff GROUP BY gender");
$uGender = ['Male' => 0, 'Female' => 0];
$sGender = ['Male' => 0, 'Female' => 0];
while ($r = $userGender->fetch_assoc())  $uGender[ucfirst(strtolower($r['gender']))] = (int)$r['c'];
while ($r = $staffGender->fetch_assoc()) $sGender[ucfirst(strtolower($r['gender']))] = (int)$r['c'];

// ============================================================
//  CHART 4 — Registrations over time (users & staff, last 6 months)
// ============================================================
// NOTE: user/staff tables don't have a created_at column by default.
// If you add one later, replace id with that column.
// For now we spread existing records evenly as a fallback.
$userCount  = (int)$totalUsers;
$staffCount = (int)$totalStaff;

// ============================================================
//  CHART 5 — Parcel weight distribution
// ============================================================
$weightResult = $conn->query("SELECT weight, COUNT(*) AS total FROM courier GROUP BY weight ORDER BY weight ASC");
$weightLabels = []; $weightData = [];
while ($row = $weightResult->fetch_assoc()) {
    $weightLabels[] = $row['weight'] . 'kg';
    $weightData[]   = (int)$row['total'];
}

// ============================================================
//  TOP 5 RECENT ORDERS (table)
// ============================================================
$recentOrders = $conn->query("
    SELECT c.oid, c.ordername, c.rname, c.weight, c.date, c.status,
           u.name AS sender
    FROM courier c
    JOIN user u ON c.uid = u.id
    ORDER BY c.oid DESC
    LIMIT 5
");

$conn->close();

// ============================================================
//  Encode PHP arrays → JSON for Chart.js
// ============================================================
$j_monthLabels  = json_encode($monthLabels ?: []);
$j_monthData    = json_encode($monthData ?: []);
$j_statusData   = json_encode(array_values($statusData));
$j_uMale        = $uGender['Male'];
$j_uFemale      = $uGender['Female'];
$j_sMale        = $sGender['Male'];
$j_sFemale      = $sGender['Female'];
$j_weightLabels = json_encode($weightLabels);
$j_weightData   = json_encode($weightData);

$statusLabel = ['Pending','In Transit','Delivered','Cancelled'];
$statusColor = [0=>'#378ADD', 1=>'#EF9F27', 2=>'#1D9E75', 3=>'#E24B4A'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delly — Admin Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;list-style:none;text-decoration:none;}
body{background:#f6f7fb;color:#222;min-height:100vh;padding-top:72px;}

/* NAVBAR */
.navbar{width:100%;height:72px;position:fixed;top:0;left:0;display:flex;justify-content:space-between;align-items:center;background:linear-gradient(90deg,#0f1724,#0b1220);padding:0 2rem;z-index:1000;box-shadow:0 4px 18px rgba(2,6,23,.35);}
.navbar h1{font-size:20px;color:#fff;font-weight:600;}
.navbar .nav-time{font-size:13px;color:rgba(255,255,255,.55);}
.navbar ul{display:flex;gap:.8rem;align-items:center;}
.navbar ul a{color:rgba(255,255,255,.8);font-size:.88rem;padding:.45rem .7rem;border-radius:8px;display:flex;align-items:center;gap:.4rem;transition:background .2s;}
.navbar ul a:hover{background:rgba(255,255,255,.1);color:#fff;}

/* LAYOUT */
.wrapper{max-width:1200px;margin:0 auto;padding:24px 20px;}

/* METRIC CARDS */
.metric-row{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:22px;}
.metric-card{background:#fff;border-radius:12px;padding:18px 20px;border:0.5px solid rgba(0,0,0,.07);position:relative;overflow:hidden;}
.metric-card .icon{position:absolute;right:16px;top:16px;width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;}
.metric-card .label{font-size:12px;color:#777;margin-bottom:6px;}
.metric-card .value{font-size:28px;font-weight:600;color:#0f1724;line-height:1;}
.metric-card .sub{font-size:11px;color:#aaa;margin-top:6px;}

/* CHART CARDS */
.charts-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin-bottom:16px;}
.chart-card{background:#fff;border:0.5px solid rgba(0,0,0,.07);border-radius:14px;padding:18px;}
.chart-title{font-size:13px;font-weight:500;color:#0f1724;margin-bottom:2px;}
.chart-sub{font-size:11px;color:#aaa;margin-bottom:12px;}
.legend-row{display:flex;flex-wrap:wrap;gap:10px;margin-bottom:10px;}
.legend-row span{display:flex;align-items:center;gap:4px;font-size:11px;color:#555;}
.legend-dot{width:10px;height:10px;border-radius:2px;flex-shrink:0;}

/* FULL WIDTH CARD */
.chart-full{background:#fff;border:0.5px solid rgba(0,0,0,.07);border-radius:14px;padding:18px;margin-bottom:16px;}

/* RECENT ORDERS TABLE */
.table-card{background:#fff;border:0.5px solid rgba(0,0,0,.07);border-radius:14px;padding:18px;margin-bottom:16px;overflow-x:auto;}
table{width:100%;border-collapse:collapse;}
thead th{font-size:11px;font-weight:500;color:#777;text-align:left;padding:8px 10px;border-bottom:1px solid #f0f0f0;white-space:nowrap;}
tbody td{font-size:12px;color:#333;padding:9px 10px;border-bottom:0.5px solid #f5f5f5;white-space:nowrap;}
tbody tr:last-child td{border-bottom:none;}
.badge{display:inline-block;padding:3px 10px;border-radius:20px;font-size:10px;font-weight:500;}

/* RESPONSIVE */
@media(max-width:768px){
  .metric-row{grid-template-columns:repeat(2,minmax(0,1fr));}
  .charts-grid{grid-template-columns:1fr;}
}
@media(max-width:480px){
  .metric-row{grid-template-columns:1fr;}
}
</style>
</head>
<body>

<div class="navbar">
    <div class="navbar-delly">
        <h1><ion-icon name="bicycle"></ion-icon> Delly</h1>
        <button id="mobile-nav-toggle" aria-label="Toggle menu">☰</button>
    </div>

    <div class="navbar-menu">
        <ul>
            <li><a href="<?= $base_url ?>?r=home"><span><ion-icon name="home-sharp"></ion-icon></span>Home</a></li>
            <li>
            <a href="<?= $base_url ?>?r=admindashboard">s                <span></span>Dashboard
             </a>
            </li>
            <li><a href="<?= $base_url ?>?r=request"><span><ion-icon name="git-pull-request-sharp"></ion-icon></span>User Request</a></li>
            <li><a href="<?= $base_url ?>?r=addperson"><span><ion-icon name="person-add-sharp"></ion-icon></span>Add Delivery Person</a></li>
            <li><a href="<?= $base_url ?>?r=staff"><span><ion-icon name="people-sharp"></ion-icon></span>Staff</a></li>
            <li><a href="<?= $base_url ?>?r=user"><span><ion-icon name="people-sharp"></ion-icon></span>Users</a></li>
            <li><a href="<?= $base_url ?>?r=completeorder"><span><ion-icon name="document-text-sharp"></ion-icon></span>All Orders</a></li>
            <li><a href="<?= $base_url ?>?r=logout"><span><ion-icon name="log-out-sharp"></ion-icon></span>Logout</a></li>
        </ul>
    </div>
</div>

<div class="wrapper">

  <!-- METRIC CARDS -->
  <div class="metric-row">
    <div class="metric-card">
      <div class="icon" style="background:#e8f0fb;">
        <svg width="18" height="18" fill="none" stroke="#185FA5" stroke-width="2" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
      </div>
      <div class="label">Total Orders</div>
      <div class="value"><?= $totalOrders ?></div>
      <div class="sub">All time courier orders</div>
    </div>
    <div class="metric-card">
      <div class="icon" style="background:#eaf5f0;">
        <svg width="18" height="18" fill="none" stroke="#0F6E56" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <div class="label">Registered Users</div>
      <div class="value"><?= $totalUsers ?></div>
      <div class="sub">Active customer accounts</div>
    </div>
    <div class="metric-card">
      <div class="icon" style="background:#f3f0fe;">
        <svg width="18" height="18" fill="none" stroke="#534AB7" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </div>
      <div class="label">Total Staff</div>
      <div class="value"><?= $totalStaff ?></div>
      <div class="sub">Registered staff members</div>
    </div>
    <div class="metric-card">
      <div class="icon" style="background:#e8faf4;">
        <svg width="18" height="18" fill="none" stroke="#1D9E75" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <div class="label">Delivered Today</div>
      <div class="value"><?= $deliveredToday ?></div>
      <div class="sub">Orders completed today</div>
    </div>
  </div>

  <!-- CHARTS ROW -->
  <div class="charts-grid">

    <!-- Chart 1: Monthly Orders -->
    <div class="chart-card">
      <div class="chart-title">Monthly courier orders</div>
      <div class="chart-sub">Last 6 months order volume</div>
      <div class="legend-row">
        <span><span class="legend-dot" style="background:#185FA5;"></span>Orders</span>
      </div>
      <div style="position:relative;height:230px;">
        <canvas id="ordersBar" role="img" aria-label="Bar chart showing monthly courier order counts">No data.</canvas>
      </div>
    </div>

    <!-- Chart 2: Status Doughnut -->
    <div class="chart-card">
      <div class="chart-title">Order status breakdown</div>
      <div class="chart-sub">Distribution by current order status</div>
      <div class="legend-row">
        <span><span class="legend-dot" style="background:#378ADD;"></span>Pending</span>
        <span><span class="legend-dot" style="background:#EF9F27;"></span>In Transit</span>
        <span><span class="legend-dot" style="background:#1D9E75;"></span>Delivered</span>
        <span><span class="legend-dot" style="background:#E24B4A;"></span>Cancelled</span>
      </div>
      <div style="position:relative;height:230px;">
        <canvas id="statusDoughnut" role="img" aria-label="Doughnut chart of order statuses">No data.</canvas>
      </div>
    </div>

    <!-- Chart 3: Gender -->
    <div class="chart-card">
      <div class="chart-title">Gender distribution</div>
      <div class="chart-sub">Users vs staff by gender</div>
      <div class="legend-row">
        <span><span class="legend-dot" style="background:#7F77DD;"></span>Male</span>
        <span><span class="legend-dot" style="background:#D4537E;"></span>Female</span>
      </div>
      <div style="position:relative;height:230px;">
        <canvas id="genderBar" role="img" aria-label="Grouped bar chart of gender by user type">No data.</canvas>
      </div>
    </div>

    <!-- Chart 4: User vs Staff count (polar) -->
    <div class="chart-card">
      <div class="chart-title">Users vs staff ratio</div>
      <div class="chart-sub">Total registered users compared to staff</div>
      <div class="legend-row">
        <span><span class="legend-dot" style="background:#185FA5;"></span>Users</span>
        <span><span class="legend-dot" style="background:#D85A30;border-radius:50%;"></span>Staff</span>
      </div>
      <div style="position:relative;height:230px;">
        <canvas id="userStaffPolar" role="img" aria-label="Polar area chart comparing total users to staff">No data.</canvas>
      </div>
    </div>

  </div>

  <!-- Chart 5: Weight Distribution (full width) -->
  <div class="chart-full">
    <div class="chart-title">Parcel weight distribution</div>
    <div class="chart-sub">Number of orders by parcel weight (kg)</div>
    <div class="legend-row">
      <span><span class="legend-dot" style="background:#185FA5;"></span>Orders</span>
    </div>
    <div style="position:relative;height:200px;">
      <canvas id="weightBar" role="img" aria-label="Bar chart showing order counts per parcel weight">No data.</canvas>
    </div>
  </div>

  <!-- Recent Orders Table -->
  <div class="table-card">
    <div class="chart-title" style="margin-bottom:14px;">Recent orders</div>
    <table>
      <thead>
        <tr>
          <th>#ID</th>
          <th>Item</th>
          <th>Sender</th>
          <th>Recipient</th>
          <th>Weight</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $badgeStyle = [
            0 => 'background:#dbeeff;color:#185FA5;',
            1 => 'background:#fff3da;color:#BA7517;',
            2 => 'background:#d6f5ea;color:#0F6E56;',
            3 => 'background:#fde8e8;color:#A32D2D;',
        ];
        if ($recentOrders && $recentOrders->num_rows > 0):
            while ($row = $recentOrders->fetch_assoc()):
                $s = (int)$row['status'];
        ?>
        <tr>
          <td>#<?= $row['oid'] ?></td>
          <td><?= htmlspecialchars($row['ordername']) ?></td>
          <td><?= htmlspecialchars($row['sender']) ?></td>
          <td><?= htmlspecialchars($row['rname']) ?></td>
          <td><?= $row['weight'] ?>kg</td>
          <td><?= htmlspecialchars($row['date']) ?></td>
          <td><span class="badge" style="<?= $badgeStyle[$s] ?? '' ?>"><?= $statusLabel[$s] ?? 'Pending' ?></span></td>
        </tr>
        <?php endwhile; else: ?>
        <tr><td colspan="7" style="text-align:center;color:#aaa;padding:20px;">No orders found</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div><!-- /wrapper -->

<!-- CLOCK -->
<script>
function tick(){
  const n=new Date();let h=n.getHours(),m=n.getMinutes(),s=n.getSeconds(),p=h>=12?'PM':'AM';
  h=h%12||12;
  const el=document.getElementById('nav-time');
  if(el) el.textContent=(h<10?'0'+h:h)+':'+(m<10?'0'+m:m)+':'+(s<10?'0'+s:s)+' '+p;
}
setInterval(tick,1000);tick();
</script>

<!-- CHART.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
const monthLabels  = <?= $j_monthLabels ?>;
const monthData    = <?= $j_monthData ?>;
const statusData   = <?= $j_statusData ?>;
const weightLabels = <?= $j_weightLabels ?>;
const weightData   = <?= $j_weightData ?>;
const uMale=<?= $j_uMale ?>, uFemale=<?= $j_uFemale ?>;
const sMale=<?= $j_sMale ?>, sFemale=<?= $j_sFemale ?>;
const totalUsers=<?= $totalUsers ?>, totalStaff=<?= $totalStaff ?>;

// Chart 1 — Monthly orders bar
new Chart(document.getElementById('ordersBar'),{
  type:'bar',
  data:{labels:monthLabels,datasets:[{label:'Orders',data:monthData,
    backgroundColor:'#185FA5',borderRadius:6,borderSkipped:false}]},
  options:{responsive:true,maintainAspectRatio:false,
    plugins:{legend:{display:false}},
    scales:{x:{ticks:{autoSkip:false,color:'#888',font:{size:11}},grid:{display:false}},
            y:{ticks:{color:'#888',font:{size:11}},grid:{color:'rgba(0,0,0,0.05)'}}}}
});

// Chart 2 — Status doughnut
new Chart(document.getElementById('statusDoughnut'),{
  type:'doughnut',
  data:{labels:['Pending','In Transit','Delivered','Cancelled'],
    datasets:[{data:statusData,
      backgroundColor:['#378ADD','#EF9F27','#1D9E75','#E24B4A'],
      hoverOffset:6,borderWidth:2,borderColor:'#fff'}]},
  options:{responsive:true,maintainAspectRatio:false,cutout:'65%',
    plugins:{legend:{display:false},
      tooltip:{callbacks:{label:function(c){
        const total=c.dataset.data.reduce((a,b)=>a+b,0);
        return ' '+c.label+': '+c.raw+' ('+Math.round(c.raw/total*100)+'%)';
      }}}}}
});

// Chart 3 — Gender grouped bar
new Chart(document.getElementById('genderBar'),{
  type:'bar',
  data:{labels:['Users','Staff'],
    datasets:[
      {label:'Male',data:[uMale,sMale],backgroundColor:'#7F77DD',borderRadius:5,borderSkipped:false},
      {label:'Female',data:[uFemale,sFemale],backgroundColor:'#D4537E',borderRadius:5,borderSkipped:false}
    ]},
  options:{responsive:true,maintainAspectRatio:false,
    plugins:{legend:{display:false}},
    scales:{x:{ticks:{autoSkip:false,color:'#888',font:{size:11}},grid:{display:false}},
            y:{ticks:{color:'#888',font:{size:11}},grid:{color:'rgba(0,0,0,0.05)'}}}}
});

// Chart 4 — Users vs Staff polar
new Chart(document.getElementById('userStaffPolar'),{
  type:'polarArea',
  data:{labels:['Users','Staff'],
    datasets:[{data:[totalUsers,totalStaff],
      backgroundColor:['rgba(24,95,165,0.7)','rgba(216,90,48,0.7)'],
      borderColor:['#185FA5','#D85A30'],borderWidth:1.5}]},
  options:{responsive:true,maintainAspectRatio:false,
    plugins:{legend:{display:false}},
    scales:{r:{ticks:{color:'#888',font:{size:10}},grid:{color:'rgba(0,0,0,0.05)'}}}}
});

// Chart 5 — Weight distribution bar
new Chart(document.getElementById('weightBar'),{
  type:'bar',
  data:{labels:weightLabels,datasets:[{label:'Orders',data:weightData,
    backgroundColor:'#185FA5',borderRadius:5,borderSkipped:false}]},
  options:{responsive:true,maintainAspectRatio:false,
    plugins:{legend:{display:false}},
    scales:{x:{ticks:{autoSkip:false,color:'#888',font:{size:11}},grid:{display:false}},
            y:{ticks:{color:'#888',font:{size:11}},grid:{color:'rgba(0,0,0,0.05)'}}}}
});
</script>

</body>
</html>