<?php
include"../connect.php";

$userid=filterReq("userid");
$itemid=filterReq("itemid");
$stmt=$con->prepare("INSERT INTO `favorites`(`Favorites_user`, `Favorites_item`) VALUES (?,?)");
$stmt->execute(array($userid,$itemid));
$row=$stmt->rowCount();
if($row>0)
{
    echo json_encode(array("status"=>"success"));
}
else{
    echo json_encode(array("status"=>"fail"));
}