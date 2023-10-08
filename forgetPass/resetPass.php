<?php
include"../connect.php";
$email=filterReq("email");
$pass=md5($_POST['pass']);
$stmt=$con->prepare("UPDATE `users` SET `user_pass`=:pass WHERE `user_email`=:email ");
$stmt->bindParam(':email', $email);
$stmt->bindParam(':pass', $pass);
$stmt->execute();
$c=$stmt->rowCount();
if($c>0)
{
    echo json_encode(array("status"=>"success"));

}
else{
    echo json_encode(array("status"=>"fail"));

}