<?php
include"../connect.php";
$email=filterReq("email");
$pass=md5($_POST['pass']);

#to ensure email or phone doesot sign up before 
$stmt = $con->prepare("SELECT * FROM `users` WHERE user_email='$email' AND user_pass='$pass' AND user_approve=1 ");
$stmt->execute();
$data=$stmt->fetch(PDO::FETCH_ASSOC);
$count =$stmt->rowCount();
if($count>0)
{
    echo json_encode(array("status"=>"success","data"=>$data));
}
else{
    echo json_encode(array("status"=>"fail"));
}
