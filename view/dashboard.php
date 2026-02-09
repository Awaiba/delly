<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JavaScript Digital Clock</title>

<style>
    /* ===== RESET ===== */
    * { margin: 0; padding: 0; box-sizing: border-box; }

    /* ===== BODY ===== */
    body {
        min-height: 100vh;
        font-family: system-ui, sans-serif;
        color: #fff;
        overflow: hidden;
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
        background: rgba(0,0,0,0.55);
        z-index: -1;
    }

    /* ===== HERO ===== */
    .hero {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center; /* vertical centering of content */
        align-items: center;     /* horizontal centering */
        text-align: center;
    }

    .hero h1 {
        font-size: 3rem;
        margin-bottom: 0.5rem;
    }

    .hero p {
        font-size: 2.2rem;
        opacity: 0.85;
        margin-bottom: 2rem; /* adds space between text and clock */
    }

    /* ===== CLOCK ===== */
    .container {
        font-size: 3rem;
        letter-spacing: 2px;
        color: #fff; /* clock text white */
    }
</style>
</head>
<body>

<!-- BACKGROUND VIDEO -->
<video src="img/222.mp4" muted loop autoplay playsinline></video>

<!-- HERO CONTENT WITH CLOCK INSIDE -->
<div class="hero">
    <h1>Namaste, Welcome to Delly</h1>
    <p><?php echo $_SESSION['user']['username']; ?></p>

    <div class="container">
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
