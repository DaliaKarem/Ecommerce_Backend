<?php
include"connect.php";
$allData=array();//put in this array any cate(most sold..) 
$allData['status']='success';
$Cate=getAllData("categories",null,null,false);
$allData['categories']=$Cate;


$items=getAllData("itemsview","item_discount<>0",null,false);
$allData['items']=$items;
echo json_encode($allData);