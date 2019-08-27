<?php
/**
 * Created by PhpStorm.
 * User: jfa
 * Date: 2019/8/22
 * Time: 11:03
 */
include ("lib.php");
include ('./header.php');
if(islogin() != false){
   header('Location:./home.php');
   exit;
}

$username = P('username');
$password = P('password');
if(!$username || !$password){
    error("用户名和密码不能为空！");
}
$r = rescont();
if(!$r->exists("user:username:".$username.":userid")){
    error("用户不存在");
}
$userid = $r->get("user:username:".$username.":userid");
$realpass = $r->get("user:userid:".$userid.":password");

if($realpass != $password){
    error('密码错误');
}
setcookie("un",$username);
setcookie('ud',$userid);
header('Location:./home.php');
include ('./footer.php');