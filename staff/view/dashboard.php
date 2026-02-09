<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
    /* ===== RESET ===== */
    * { margin: 0; padding: 0; box-sizing: border-box; }

    /* ===== BODY ===== */
    body {
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        color: #fff;
        overflow: hidden;
        background: #000;
    }

    /* ===== FULLSCREEN VIDEO ===== */
    video {
        position: fixed;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -2;
    }

    /* ===== DARK OVERLAY ===== */
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5); /* semi-dark overlay */
        z-index: -1;
    }

    /* ===== HERO SECTION ===== */
    .hero {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center; /* vertical centering */
        align-items: center;     /* horizontal centering */
        text-align: center;
        padding: 1rem;
    }

    .hero h1 {
        font-size: 6rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.7);
    }

    .hero p {
        font-size: 2rem;
        margin-bottom: 2rem;
        opacity: 0.85;
    }

    /* ===== DIGITAL CLOCK ===== */
    .clock {
        font-size: 3rem;
        letter-spacing: 2px;
        font-weight: 500;
        display: flex;
        gap: 0.5rem;
        color: #fff;
        text-shadow: 1px 1px 8px rgba(0,0,0,0.7);
    }

    /* RESPONSIVE */
    @media(max-width: 768px){
        .hero h1 { font-size: 2.2rem; }
        .hero p { font-size: 1.6rem; }
        .clock { font-size: 2rem; }
    }
</style>
</head>
<body>

<!-- BACKGROUND VIDEO -->
<video src="video/222.mp4" muted loop autoplay playsinline></video>

<!-- HERO SECTION -->
<div class="hero">
    <h1>Namaste, Welcome to Dashboard</h1>
<h3 style="font-style: italic; font-weight: 300;">Have a great day at work!</h3>
    <!-- DIGITAL CLOCK -->
    <div class="clock">
        <span id="hours">00</span>
        <span>:</span>
        <span id="minutes">00</span>
        <span>:</span>
        <span id="seconds">00</span>
        <span id="session">AM</span>
    </div>
</div>

<script>
function updateClock() {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();
    let session = "AM";

    if(hours >= 12){
        session = "PM";
        if(hours > 12) hours -= 12;
    }
    if(hours === 0) hours = 12;

    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

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
