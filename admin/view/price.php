


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Update Price</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
* {
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    height: 100vh;
    position: fixed;
    justify-content: center;
    align-items: center;
    padding: 60px;
    margin-left: 35%;
}

.container {
    position: relative;
    max-width: 700px;
    width: 100%;
    background-color: #fff;
    padding: 25px 30px;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.2), -1px -1px 8px rgba(0, 0, 0, 0.2);
}



.container .title {
    font-size: 25px;
    font-weight: 500;
    position: relative;
    text-align: center;
}

.content form .user-details {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 20px 0 12px 0;
}

form .user-details .input-box {
    margin-bottom: 15px;
    width: calc(100% / 2 - 20px);
}

form .input-box span.details {
    display: block;
    font-weight: 500;
    margin-bottom: 5px;
}

.user-details .input-box input {
    height: 45px;
    width: 100%;
    outline: none;
    font-size: 16px;
    border-radius: 5px;
    padding-left: 15px;
    border: 1px solid #ccc;
    border-bottom-width: 2px;
    transition: all 0.3s ease;
}

form .button {
    height: 45px;
    margin: 35px 0
}

form .button input {
    height: 100%;
    width: 100%;
    border-radius: 5px;
    border: none;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: rgb(212, 87, 38);
}

form .gen select {
    position: relative;
    top: 8px;
    width: 100px;
    height: 30px;
    text-align: center;
    border-radius: 5px;
    border: 1px solid #ccc;
    border-bottom-width: 2px;
}

form .button input:hover {
    transform: scale(0.99);
    background: rgb(206, 154, 154);
    color: black;
}

@media(max-width: 584px) {
    .container {
        max-width: 100%;
    }
    form .user-details .input-box {
        margin-bottom: 15px;
        width: 100%;
    }
    form .category {
        width: 100%;
    }
    .content form .user-details {
        max-height: 300px;
        overflow-y: scroll;
    }
    .user-details::-webkit-scrollbar {
        width: 5px;
    }
}

@media(max-width: 459px) {
    .container .content .category {
        flex-direction: column;
    }
}

        </style>

</head>

<body>

    <div class="container">


        <div class="title">Update Price</div>
        <div class="content">
            <?php
        if($price){
            while ($row = $price->fetch_assoc()) {
            
        ?>
           <form action="<?= $base_url ?>?r=price" method="post">
                <div class="user-details">
                
                        <span class="details">S.N</span>
                        <input type="text" name="name" value=<?php echo $row['sn'] ?>>
                        <span class="details">Weight</span>
                        <input type="text" name="name" value=<?php echo $row['weight'] ?>>
                   


                       
                    </div>


            </form>
       <?php }} ?> 
        </div>
    </div>

