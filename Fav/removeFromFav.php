<?php
include"../connect.php";
$user_id=filterReq("user_id");
$item_id=filterReq("item_id");

$stmt1=$con->prepare("DELETE FROM `favorites` WHERE `Favorites_user`=$user_id AND`Favorites_item`=$item_id ");

$stmt1->execute();

/* $stmt2=$con->prepare("SELECT * FROM `favorites`
LEFT JOIN `itemsview` ON `favorites`.`Favorites_item` = `itemsview`.`item_id`
WHERE `favorites`.`Favorites_user` = $user_id
UNION
SELECT * FROM `favorites`
RIGHT JOIN `itemsview` ON `favorites`.`Favorites_item` = `itemsview`.`item_id`
WHERE `favorites`.`Favorites_user` = $user_id;
"); */

//$stmt2->execute();

//$data=$stmt2->fetchAll(PDO::FETCH_ASSOC);

$row=$stmt1->rowCount();

if($row>0)

{
    echo json_encode(array("status"=>"success"));
}
else{
    echo json_encode(array("status"=>"Faill"));
}