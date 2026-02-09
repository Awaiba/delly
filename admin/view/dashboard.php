<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');

/* ==== VARIABLES ==== */
:root {
    --main-color: #000000;
    --bg-color: #ffffff;
    --text-color: #222222;
    --muted-color: #777777; 
    --accent-color: #000000;
}

/* ==== RESET ==== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    list-style: none;
    text-decoration: none;
}

/* ==== BODY ==== */
body {
    min-height: 100vh;
    padding-top: 80px; /* space for navbar */
    margin: 0;
    color: var(--text-color);
}

/* ==== NAVBAR ==== */
/* ==== VARIABLES ==== */
:root {
    --main-color: #000000;
    --bg-color: #ffffff;
    --text-color: #e6eef9;
    --muted-color: #777777;
    --accent-color: #0f1724;
}

/* ==== RESET ==== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    list-style: none;
    text-decoration: none;
}

/* ==== BODY ==== */
body {
    background: #f6f7fb;
    color: var(--text-color);
    min-height: 100vh;
    padding-top: 80px;
}

/* ==== NAVBAR ==== */
.navbar {
    width: 100%;
    height: 72px;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(90deg, #0f1724, #0b1220);
    padding: 0 2rem;
    z-index: 1000;
    box-shadow: 0 4px 18px rgba(2,6,23,0.35);
}

/* LOGO */
.navbar-delly h1 {
    font-size: 22px;
    color: #fff;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* MENU */
.navbar-menu {
    display: flex;
    flex: 1;
    justify-content: flex-end; /* push menu right */
}

.navbar-menu ul {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.navbar-menu li {
    list-style: none;
}

.navbar-menu a {
    color: var(--text-color);
    font-size: 0.95rem;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    border: 1px solid rgba(255,255,255,0.03);
    transition: background-color 0.2s, transform 0.12s;
}

.navbar-menu a:hover {
    background-color: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    transform: translateY(-1px);
}

.navbar-menu a span {
    font-size: 1.4rem;
    color: var(--bg-color);
    transition: color 0.3s;
}

.navbar-menu a:hover span {
    color: var(--accent-color);
}

/* MOBILE NAV TOGGLE */
#mobile-nav-toggle {
    display: none;
    background: transparent;
    border: none;
    font-size: 1.5rem;
    color: #fff;
    cursor: pointer;
}

/* RESPONSIVE */
@media(max-width: 900px) {
    .navbar { padding: 0 1rem; }
    .navbar-menu ul { gap: 0.6rem; }
}

@media(max-width: 600px) {
    .navbar {
        flex-direction: row;
        height: auto;
        padding: 0.75rem 1rem;
        align-items: center;
    }

    .navbar-menu {
        flex: 1;
        justify-content: flex-end;
        margin-top: 0;
    }

    .navbar-menu ul {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    #mobile-nav-toggle {
        display: block;
    }
}

/* ==== BACKGROUND VIDEO ==== */
video {
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -2;
}

/* ==== DARK OVERLAY ==== */
body::before {
    content:"";
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: -1;
}

/* ==== HERO SECTION ==== */
.hero {
    position: relative;
    height: calc(100vh - 72px); /* full viewport minus navbar */
    display: flex;
    flex-direction: column;
    justify-content: center; /* vertical centering */
    align-items: center;     /* horizontal centering */
    text-align: center;
    z-index: 1;
}

.hero h1 {
    font-size: 6rem;
    margin-bottom: 1rem;
    color: #fff;
}

.hero p {
    font-size: 2rem;
    opacity: 0.85;
    margin-bottom: 2rem;
    color: #fff;
}

.clock-container {
    font-size: 3rem;
    letter-spacing: 2px;
    color: #fff;
}

/* ==== RESPONSIVE ==== */
@media(max-width:768px){
    .hero h1{ font-size:2.2rem; }
    .hero p{ font-size:1.6rem; }
}
@media(max-width:480px){
    .hero h1{ font-size:1.8rem; }
    .hero p{ font-size:1.2rem; }
    .clock-container{ font-size:2rem; }
}
</style>
</head>
<body>

<!-- BACKGROUND VIDEO -->
<video src="resources/imgadmin/12.mp4" muted loop autoplay playsinline></video>

<!-- HERO WITH CLOCK -->
<div class="hero">
    <h1>Namaste Admin, Welcome to Delly</h1>
    <h3 style="font-style: italic; font-weight: 600;">Have a great day at work!</h3>
    <div class="clock-container">
        <span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span> <span id="session">AM</span>
    </div>
</div>

<!-- CLOCK SCRIPT -->
<script>
function updateClock() {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();
    let session = "AM";

    if(hours >= 12){ session="PM"; if(hours>12) hours-=12; }
    if(hours===0) hours=12;

    hours = hours<10?"0"+hours:hours;
    minutes = minutes<10?"0"+minutes:minutes;
    seconds = seconds<10?"0"+seconds:seconds;

    document.getElementById("hours").textContent = hours;
    document.getElementById("minutes").textContent = minutes;
    document.getElementById("seconds").textContent = seconds;
    document.getElementById("session").textContent = session;
}
setInterval(updateClock, 1000);
updateClock();
</script>

</body>
</html>
