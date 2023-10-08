<?php
include"../connect.php";
$email=filterReq("email");
$verifCode=filterReq("verifyCode");
$sql=$con->prepare("SELECT * FROM `users` WHERE user_email='$email' AND user_verifycode='$verifCode' ");

$sql->execute();
$count=$sql->rowCount();

if($count>0)
{
    
        echo json_encode(array("status"=>"success"));

    
}
else{
    printFail("Verification Code not correct");

}
