<?php
/**
 * Created by PhpStorm.
 * User: jfa
 * Date: 2019/8/22
 * Time: 9:51
 */
include ("lib.php");
include ('./header.php');
if(islogin() != false){
    header('Location:./home.php');
    exit;
}

$username = P('username');
$password = P('password');
$password2 = P('password2');

if(!$username || !$password || !$password2){
    error("请输入完成注册信息");
}

if($password !== $password2){
    error("两次密码输入不一致");
}

$r = rescont();
if($r->get('user:username:'.$username.':userid')){
    error('该用户已存在，请重新输入用户名');
}
$userid = $r->incr("global:userid");
$r->set('user:userid:'.$userid.':username',$username);
$r->set('user:userid:'.$userid.':password',$password);
$r->set('user:username:'.$username.':userid',$userid);

//用链表保存50个最新的用户
$r->lpush('newuserlink',$userid);
$r->lTrim('newuserlink',0,49);

echo "注册成功";
include ('./footer.php');