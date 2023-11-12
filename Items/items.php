<?php
include"../connect.php";
$cateId=filterReq("Cateid");
$userId=filterReq("id");
//$items=getAllData("items1view","item_category=$cateId");

$sql=$con->prepare("SELECT itemsview.*, 1 as favorites
FROM itemsview
INNER JOIN favorites
ON favorites.Favorites_item = itemsview.item_id
AND favorites.Favorites_user = $userId
WHERE item_category = $cateId

UNION ALL

SELECT itemsview.*, 0 as favorites
FROM itemsview
WHERE item_category = $cateId
AND itemsview.item_id NOT IN (
    SELECT itemsview.item_id
    FROM itemsview
    INNER JOIN favorites
    ON favorites.Favorites_item = itemsview.item_id
    AND favorites.Favorites_user = $userId
);

");
$sql-> execute();
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