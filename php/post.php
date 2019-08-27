<?php
/**
 * Created by PhpStorm.
 * User: jfa
 * Date: 2019/8/22
 * Time: 11:34
 */
include ("lib.php");
include ('./header.php');
$user =islogin();
if($user == false){
    header('Location:./index.php');
    exit;
}
$content = P('content');
if(trim($content) =="" ){
    error('内容不能为空');
}

$r = rescont();
$postid = $r->incr("global:postid");
$r->set('post:postid:'.$postid.':userid',$user['userid']);
$r->set('post:postid:'.$postid.':time',time());
$r->set('post:postid:'.$postid.':content',$content);



//推给粉丝 和自己
$fans = $r->sMembers("follower:".$user['userid']);
$fans[] = $user['userid'];
foreach($fans as $fansid){
    $r->lpush('recivepost:'.$fansid,$postid);
}

header("Location: ./home.php");
include ('./footer.php');