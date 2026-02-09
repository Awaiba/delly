<?php

include "model/dbmodel.php";
include "view/navbar.php";
include "view/footer.php";
$id = "";
if(isset($_GET["sid"]))
{
	$id = $_GET["sid"];
}

if(empty($_POST))
{
$accept=acceptstaff($id);
include "view/accept.php";
return;
}

?>

