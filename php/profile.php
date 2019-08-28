<?php
include './lib.php';
include './header.php';
$user = islogin();
if($user == false){
    header('Location:./index.php');
    exit;
}
$uname = G('u');
$r = rescont();
$cur_uid = $r->get("user:username:$uname:userid");
if(!$cur_uid){
    error("非法用户");
}
$isself = 0;
if($uname == $user['username']){
    $isself = 1;
}
$ism = $r->sIsMember("following:".$user['userid'],$cur_uid);
$isf = ($ism?0:1);


?>
    <h2 class="username"><?=$uname ?></h2>
    <?php if(!$isself){ ?>
        <a href="follow.php?uid=<?=$cur_uid?>&f=<?=$isf?>" class="button"><?=($ism==false?"关注ta":"取消关注")?></a>
    <?php } ?>
    <div class="post">
        <a class="username" href="profile.php?u=test">test</a>
        world<br>
        <i>11 分钟前 通过 web发布</i>
    </div>

    <div class="post">
        <a class="username" href="profile.php?u=test">test</a>
        hello<br>
        <i>22 分钟前 通过 web发布</i>
    </div>

    <?php
    include './footer.php';
    ?>
