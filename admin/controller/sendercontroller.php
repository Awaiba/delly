<?php

include "model/dbmodel.php";
include "view/navbar.php";
include "view/footer.php";
$id = "";
if(isset($_GET["uid"]))
{
	$id = $_GET["uid"];
}

if(empty($_POST))
{
$sender=sender($id);
include "view/sender.php";
return;
}

?>

