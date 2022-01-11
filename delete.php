<?php
require './CRUD.php';
require './db.php';
$id = $_GET['id'];
$qry = "Select * from blog where id ='$id'";
$data = mysqli_query($con,$qry);

if (mysqli_num_rows($data) >0) {
    $_SESSION['msg'] = deleteData("delete from blog where id='$id'");
}else
{
    $_SESSION['msg']='No Rows affect , Id invalid';
}


header("Location: task6.php");

?>