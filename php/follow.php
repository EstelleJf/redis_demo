<?php
/**
 * Created by PhpStorm.
 * User: jfa
 * Date: 2019/8/22
 * Time: 16:00
 */
include './lib.php';
include './header.php';
$user = islogin();
if($user == false){
    header('Location:./index.php');
    exit;
}

$uid = G('uid');
$f = G("f");
if(!$uid ){
    error(' 参数错误');
}
$r = rescont();
$username = $r->get('user:userid:'.$uid.':username');
if(!$username){
    error('用户不存在');
}
if($user['userid'] == $uid){
    error("自己不能关注自己");
}
if($f ==1){
    //关注
    $r->sadd('following:'.$user['userid'],$uid);  //关注集合
    $r->sadd('follower:'.$uid,$user['userid']); //粉丝集合
}else{
    //取消关注
    $r->sRem('following:'.$user['userid'],$uid);  //关注集合
    $r->sRem('follower:'.$uid,$user['userid']); //粉丝集合
}


header('Location: ./profile.php?u='.$username);