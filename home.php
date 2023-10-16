<?php
include"connect.php";
$allData=array();//put in this array any cate(most sold..) 
$Cate=getAllData("categories",null,null,false);
$allData['categories']=$Cate;
$allData['status']='success';
echo json_encode($allData);