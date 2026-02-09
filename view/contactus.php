<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<link rel="stylesheet" href="css/contactus.css">









</head>
<body>
	
<form action="<?= $base_url ?>?r=contact" method="post">
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			  <div class="right">
				<h2>Contact Us</h2>
				<input type="text" name="name"class="field" placeholder="Name">
				<input type="email" name="email" class="field" placeholder="Email" >
				<input type="text" name="subject" class="field" placeholder="Subject" >
				<textarea name="message" placeholder="Message" class="field"></textarea>
                <input type="submit" class ="btn" name="send" value="Send" >
		    </div>
		</div>
	</div>
</form>







<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <?php
 if(isset($_SESSION['message'])&& $_SESSION['message'] !='')
 {
     ?>
       <script>
        swal({
  title: "<?php echo $_SESSION['message'];?>",
  //text: "You clicked the button!",
  icon: "<?php echo $_SESSION['status'];?>",
  button: "ok",
});
        </script>
     <?php
     unset($_SESSION['message']);
 } 
  ?>








</body>
</html>