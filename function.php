<?php
define('MB',1048576);

function filterReq($reqname)
{
    return htmlspecialchars(strip_tags($_POST[$reqname]));
}

function printFail($msg)
{
  echo json_encode(array("status"=> "fail","msg"=>$msg));

}

function imgupload($reqname)
{
  global $Error;
  $imgname=rand(1000,10000).$_FILES[$reqname]['name'];
  $imgtmp=$_FILES[$reqname]['tmp_name'];
  $imgsize=$_FILES[$reqname]['size'];
  $allowExt=array("jpg","png","gif","jpeg");
  $toarray=explode(".",$imgname);
  $ext=end($toarray);
  $ext=strtolower($ext);
  if(!empty($imgname)&&!in_array($ext,$allowExt))
  {
       $Error[]="Ext";
  }
  if($imgsize>2*MB)
  {
    $Error[]="size";
  }
  if(empty($Error))
  {
    move_uploaded_file($imgtmp , "../upload/ ". $imgname );
    return $imgname;
  }
  else{ 
    return "Fail";
  }
  
}
function deletefile($dir,$imgname)
{
  if(file_exists($dir ."/" .$imgname))
  {
      unlink($dir ."/" .$imgname);
  }
}

#for Secuity
function checkAuthenticate()
 {
     if (isset($_SERVER['PHP_AUTH_USER'])  && isset($_SERVER['PHP_AUTH_PW'])) {

        if ($_SERVER['PHP_AUTH_USER'] != "DODO" ||  $_SERVER['PHP_AUTH_PW'] != "DODO12"){
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Page Not Found';
            exit;
        }
    } else {
        exit;
    }
}
function sendemail($to_email,$subject,$verifycode)
{

  $header="From: Ecommerce App "."\n"."to:$to_email";
#$sendCode=
mail($to_email,$subject,$verifycode,$header);
#if($sendCode==true)
#{
 #   echo "Message sent successfully";
#}
#else{
 #   printFail("Message couldn't be sent");
#}

}
