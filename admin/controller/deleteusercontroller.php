<html>
    <head><title>delete</title>
    


    
    <?php
   
include "model/dbmodel.php";

$id = "";
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
}

$del = deleteuser($id);
if($del)
{
    $_SESSION['message']="Data deleted successfully";
    $_SESSION['status']="success";
    redirect("user");
}
else
{
    $_SESSION['message']="Data not deleted successfully";
    $_SESSION['status']="error";
    redirect("user");
}




?>


</head>
<body>
</body>
</html>