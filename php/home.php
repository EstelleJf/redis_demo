<?php
include './lib.php';
include './header.php';
$user = islogin();
if($user == false){
    header('Location:./index.php');
    exit;
}

$r = rescont();
$following = $r->sCard("following:".$user['userid']);
$follower = $r->sCard("follower:".$user['userid']);

$r->lTrim('recivepost:'.$user['userid'],0,99);
//$all_posts_content = $r->sort('recivepost:'.$user['userid'],array('sort'=>'desc','get'=>'post:postid:*:content'));
$all_posts = $r->sort('recivepost:'.$user['userid'],array('sort'=>'desc'));
foreach($all_posts as $k=>$p){
    $info = $r->hmget('post:postid:'.$p,array('userid','username','time','content'));
    $post_arr[$k] = $info;
    $post_arr[$k]['h'] = format_time($info['time']);
}

?>
    <div id="postform">
        <form method="POST" action="post.php">
            <?=$user['username']?>, 有啥感想?
            <br>
            <table>
                <tr><td><textarea cols="70" rows="3" name="content"></textarea></td></tr>
                <tr><td align="right"><input type="submit" name="doit" value="Update"></td></tr>
            </table>
        </form>
        <div id="homeinfobox">
            <?=$follower ?> 粉丝<br>
            <?=$following ?> 关注<br>
        </div>
    </div>
<?php  foreach($post_arr as $post){ ?>
    <div class="post">
        <a class="username" href="profile.php?u=test"><?=$post['username']?></a> <?=$post['content'] ?><br>
        <i><?=$post['h'] ?>  通过 web发布</i>
    </div>
<?php } ?>
<?php
include './footer.php';
?>
