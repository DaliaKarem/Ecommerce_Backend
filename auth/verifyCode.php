<?php
include"../connect.php";
$email=filterReq("email");
$verifCode=filterReq("verifyCode");
$email_verifyCode="1";
$email_approveAdmn="2";
$sql=$con->prepare("SELECT * FROM `users` WHERE user_email='$email' AND user_verifycode='$verifCode' ");

$sql->execute();
$count=$sql->rowCount();

if($count>0)
{
    #$data=array("user_approve"=>"$email_verifyCode");
    $update=$con->prepare("UPDATE `users` SET `user_approve`='1' WHERE `user_email`='$email' ");
    $update->execute();
    $c=$update->rowCount();
    if($c>0)
    {
        echo json_encode(array("status"=>"success"));

    }
    else{
        echo json_encode(array("status"=>"fail"));

    }
}
else{
    printFail("Verification Code not correct");

}
