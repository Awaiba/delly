<html>
    <head><title>hello</title>
    


    
    <?php
    
include "model/dbmodel.php";

$id = "";
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
}

$del = deletestaff($id);
if($del)
{
    $_SESSION['message']="Data deleted successfully";
    $_SESSION['status']="success";
    redirect("staff");
}
else
{
    $_SESSION['message']="Data not deleted successfully";
    $_SESSION['status']="error";
    redirect("staff");
}




?>


</head>
<body>
</body>
</html>