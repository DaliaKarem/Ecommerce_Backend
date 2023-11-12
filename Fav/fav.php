<?php
include"../connect.php";
$user_id=filterReq("id");
$sql=$con->prepare("SELECT * FROM `favorites`
LEFT JOIN `itemsview` ON `favorites`.`Favorites_item` = `itemsview`.`item_id`
WHERE `favorites`.`Favorites_user` = $user_id
UNION
SELECT * FROM `favorites`
RIGHT JOIN `itemsview` ON `favorites`.`Favorites_item` = `itemsview`.`item_id`
WHERE `favorites`.`Favorites_user` = $user_id;
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