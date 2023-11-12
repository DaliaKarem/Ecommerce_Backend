<?php
include"../connect.php";

$userid=filterReq("userid");
$itemid=filterReq("itemid");
$stmt=$con->prepare("DELETE FROM `cart` WHERE`cart_user`=$userid And `cart_item`=$itemid ");
$stmt->execute();
$row=$stmt->rowCount();
if($row>0)
{
    echo json_encode(array("status"=>"success"));
}
else{
    echo json_encode(array("status"=>"fail"));
}