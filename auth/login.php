<?php
include"../connect.php";
$email=filterReq("email");
$pass=sha1($_POST['pass']);

#to ensure email or phone doesot sign up before 
$stmt = $con->prepare("SELECT * FROM `users` WHERE user_email=? AND user_pass=? AND user_approve=1 ");
$stmt->execute(array($email,$pass));
$count =$stmt->rowCount();
if($count>0)
{
    echo json_encode(array("status"=>"success"));
}
else{
    echo json_encode(array("status"=>"fail"));
}
