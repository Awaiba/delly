<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<style>
/* ==== FONT & RESET ==== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    list-style: none;
    text-decoration: none;
}

/* ==== VARIABLES ==== */
:root {
    --main-color: #000000;
    --bg-color: #ffffff;
    --text-color: #222222;
    --muted-color: #777777;
    --accent-color: #000000;
}

/* ==== BODY ==== */
body {
    background-color: #111;
    color: #fff;
    min-height: 100vh;
    padding-top: 80px; /* space for navbar */
    display: flex;
    flex-direction: column;
}

/* ==== NAVBAR ==== */
.navbar {
    width: 100%;
    height: 72px;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(90deg, #0f1724, #0b1220);
    padding: 0 2rem;
    z-index: 1000;
    box-shadow: 0 4px 18px rgba(2,6,23,0.35);
}

.navbar-koseli h1 {
    font-size: 22px;
    color: #fff;
    font-weight: 600;
}

.navbar-menu ul {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.navbar-menu li a {
    color: #e6eef9;
    font-size: 0.95rem;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.03);
    transition: background-color 0.2s, transform 0.12s;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.navbar-menu li a:hover {
    background-color: rgba(255,255,255,0.08);
    color: #fff;
    transform: translateY(-1px);
}

.navbar-menu li a span {
    font-size: 1.4rem;
    color: var(--bg-color);
    transition: color 0.3s;
}

.navbar-menu li a:hover span {
    color: var(--main-color);
}

/* ==== CONTAINER ==== */
.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 1.25rem;
}

/* ==== CARDS ==== */
.content-card {
    background: #222;
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 6px 18px rgba(11,20,34,0.3);
}

/* ==== FOOTER ==== */
.footer {
    width: 100%;
    text-align: center;
    padding: 1rem 0;
    color: var(--muted-color);
    background: #0b1220;
    position: fixed;
    bottom: 0;
    left: 0;
}

/* ==== RESPONSIVE ==== */
@media(max-width: 900px) {
    .navbar { padding: 0 1rem; }
    .navbar-menu ul { gap: 0.6rem; }
}

@media(max-width: 600px) {
    .navbar {
        flex-direction: column;
        height: auto;
        padding: 0.75rem 1rem;
        align-items: flex-start;
    }

    .navbar-menu {
        width: 100%;
        margin-top: 0.5rem;
    }

    .navbar-menu ul {
        flex-wrap: wrap;
        gap: 0.5rem;
    }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="navbar-koseli">
        <h1>Delly</h1>
    </div>
    <div class="navbar-menu">
        <ul>
            <li><a href="#"><span>🏠</span>Home</a></li>
            <li><a href="#"><span>📦</span>Orders</a></li>
            <li><a href="#"><span>⚙️</span>Settings</a></li>
        </ul>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="container">
    <div class="content-card">
        <h2>Welcome to Delly Dashboard</h2>
        <p>This is your main panel. All content will appear here inside a card.</p>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    &copy; 2026 Delly Courier Services
</div>

</body>
</html>
