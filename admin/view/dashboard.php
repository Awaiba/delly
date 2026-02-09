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
.navbar-koseli h1 {
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

/* ==== HERO SECTION ==== */
body > h1 {
    height: calc(100vh - 80px); /* full viewport below navbar */
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-size: 3rem;
    font-weight: 700;
    color: #fff;
    position: relative;
    margin: 0;

    /* Background image */
    background-image: url('resource/imgadmin/1.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* Dark overlay for readability */
body > h1::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    z-index: 0;
}

body > h1 span {
    position: relative;
    z-index: 1;
}

/* Responsive */
@media(max-width: 768px) {
    body > h1 { font-size: 2.2rem; }
}
@media(max-width: 480px) {
    body > h1 { font-size: 1.8rem; }
}
</style>
</head>
<body>

<h1><span>Welcome to Dashboard</span></h1>

</body>
</html>
