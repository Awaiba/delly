<html>
    <head><title>hello</title>
    


    
    <?php
  
include "model/dbmodel.php";


$id = "";
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
}

$del = delete($id);
if($del)
{
    $_SESSION['message']="Data deleted successfully";
    $_SESSION['status']="success";
    redirect('order');
}
else
{
    $_SESSION['message']="Data not deleted successfully";
    $_SESSION['status']="error";
    redirect('order');
}




?>


</head>
<body>
</body>
</html>