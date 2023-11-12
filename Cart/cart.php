<?php
include"../connect.php";
$user_id=filterReq("id");
$sql=$con->prepare("SELECT * FROM `cart`
LEFT JOIN `itemsview` ON `cart`.`cart_item` = `itemsview`.`item_id`
WHERE `cart`.`cart_user` = $user_id
UNION
SELECT * FROM `cart`
RIGHT JOIN `itemsview` ON `cart`.`cart_item` = `itemsview`.`item_id`
WHERE `cart`.`cart_user` = $user_id;
");

$sql->execute();

$data=$sql->fetchAll(PDO::FETCH_ASSOC);
$row=$sql->rowCount();
if($row>0)
{
    echo json_encode(array("status"=>"success", "data"=>$data));
    #sendemail($email,"Verification Code ",$veriycode);
}
else{
    echo json_encode(array("status"=>"Faill"));
}