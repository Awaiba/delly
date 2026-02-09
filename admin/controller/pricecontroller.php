<?php
include 'model/dbmodel.php';
include 'view/navbar.php';

if(empty($_POST)){
    $price= price();
    include 'view/price.php';
    return;
}
try{

}
catch (Exception $ex){
    throwError();
}
?>