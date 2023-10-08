<?php
include'../connect.php';
$email=filterReq("email");
$veriycode=rand(10000,99999);

$stmt=$con->prepare("SELECT * FROM `users` WHERE user_email='$email' ");
$stmt->execute();

    //UPDATE `users` SET `user_approve`='1' WHERE `user_email`='$email'
    $update=$con->prepare("UPDATE `users` SET user_verifycode=$veriycode WHERE `user_email`='$email'");
    $update->execute();
    $data=$update->fetch(PDO::FETCH_ASSOC);
    $row=$stmt->rowCount();
    if($row>0)
    {
        echo json_encode(array("status"=>"success"));
        #sendemail($email,"Verification Code ",$veriycode);
    }
    else{
        printFail("can't send Code");
    }

  