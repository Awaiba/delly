<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Price List</title>
    <style>
      /* ===== FONT & RESET ===== */
* {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ===== BODY ===== */
body {
    background-color: #111; /* dark background */
    color: #fff;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center; /* center vertically */
    align-items: center;     /* center horizontally */
}

/* ===== MAIN CONTAINER ===== */
.container {
    width: 90%;
    max-width: 700px;
    text-align: center;
}

/* ===== HEADING ===== */
h2 {
    font-size: 2rem;
    margin-bottom: 2rem;
}

/* ===== TABLE ===== */
.content-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    font-size: 1rem;
}

/* TABLE HEAD */
.content-table thead tr {
    background-color: #000;
    color: #fff;
    font-weight: bold;
}

/* TABLE CELLS */
.content-table th,
.content-table td {
    padding: 12px 15px;
    text-align: center;
}

/* TABLE BODY ROWS */
.content-table tbody tr {
    border-bottom: 1px solid #444;
    background-color: #222;
    color: #fff;
}

/* ALTERNATE ROWS */
.content-table tbody tr:nth-of-type(even) {
    background-color: #333;
}

/* HOVER EFFECT */
.content-table tbody tr:hover {
    background-color: #555;
    cursor: pointer;
}

/* ACTIVE ROW */
.content-table tbody tr.active-row {
    background-color: #000;
    font-weight: bold;
}

/* ===== FOOTER ===== */
footer {
    width: 100%;
    text-align: center;
    padding: 1rem 0;
    margin-top: 2rem;
    background-color: #111;
    color: #fff;
}

/* ===== RESPONSIVE ===== */
@media screen and (max-width: 480px) {
    h2 {
        font-size: 1.5rem;
    }
    .content-table th,
    .content-table td {
        padding: 8px 10px;
        font-size: 0.9rem;
    }
}

    </style>
</head>
<body>

<div class="container">
    <h2>As per your courier's weight, the price is listed below:</h2>

    <table class="content-table">
        <thead>
            <tr>
                <th>S.n</th>
                <th>Weight in Kg</th>
                <th>Price Rs.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>upto 1kg</td>
                <td>Rs.120</td>
            </tr>
            <tr class="active-row">
                <td>2</td>
                <td>1kg to 2kg</td>
                <td>Rs.200</td>
            </tr>
            <tr>
                <td>3</td>
                <td>2kg to 4kg</td>
                <td>Rs.250</td>
            </tr>
            <tr>
                <td>4</td>
                <td>4kg to 5kg</td>
                <td>Rs.300</td>
            </tr>
            <tr>
                <td>5</td>
                <td>5kg to 7kg</td>
                <td>Rs.400</td>
            </tr>
            <tr>
                <td>6</td>
                <td>7kg and above</td>
                <td>Rs.500</td>
            </tr>
        </tbody>
    </table>
</div>

<footer>
    &copy; 2026 Delly Courier Service
</footer>

</body>
</html>
