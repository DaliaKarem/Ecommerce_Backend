<?php
include"../connect.php";
$name=filterReq("name");
$email=filterReq("email");
$pass=sha1("pass");
$phone=filterReq("phone");
$veriycode=rand(10000,99999);

#to ensure email or phone doesot sign up before 
$stmt = $con->prepare("SELECT * FROM `users` WHERE user_email=? OR user_pass=?");
$stmt->execute(array($email,$phone));
$count =$stmt->rowCount();
if($count>0)
{
    printFail("phoe or email exists");
}
else{
    $stmt=$con->prepare("INSERT INTO `users`( `user_name`, `user_email`, `user_pass`, `user_verifycode`, `user_phone`) VALUES (?,?,?,?,?)");
    $stmt->execute(array($name,$email,$pass,$veriycode,$phone));
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
    $count=$stmt->rowCount();
    if($count>0)
    {
        echo json_encode(array("status"=>"success"));
        #sendemail($email,"Verification Code ",$veriycode);
    }
    else{
        printFail("can't insert");
}
    
    }

