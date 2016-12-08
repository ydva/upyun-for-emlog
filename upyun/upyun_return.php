<?php
include('upyun_config.php');
if(!isset($_GET['code']) || !isset($_GET['message']) || !isset($_GET['url']) || !isset($_GET['time'])){
	header('HTTP/1.1 403 Not Access');
	echo "<script>parent.uError('地址有误')</script>";
	die();
}
if(isset($_GET['sign'])){ /// 正常签名
	if(md5("{$_GET['code']}&{$_GET['message']}&{$_GET['url']}&{$_GET['time']}&".$apikey) == $_GET['sign']){
    if($_GET['code'] == '200'){
    $returnres=$_GET['url'];
    echo "<script>parent.stopSend('http://".$url.$returnres."','".$picwidth."')</script>";
    die();
    }
   }else{
    echo "<script>parent.uError('API错误或者空间名错误')</script>";
    die();
   }
}else{
 	echo "<script>parent.uError('未知错误，错误代码{$_GET['code']}')</script>";
  die();
}
