<?php
include  './lib.php';
include './header.php';
$user = islogin();
if($user == false){
    header('Location: ./index.php');
}
$r = rescont();
$newuserList = $r->sort('newuserlink',array('sort'=>'desc','get'=>'user:userid:*:username'));

?>
    <h2>热点</h2>
    <i>最新注册用户(redis中的sort用法)</i><br>
    <div>
        <?php  foreach($newuserList as $value){ ?>
        <a class="username" href="profile.php?u=<?=$value?>"><?=$value?></a>
        <?php } ?>
    </div>

    <br><i>最新的50条微博!</i><br>
    <div class="post">
        <a class="username" href="profile.php?u=test">test</a>
        world<br>
        <i>22 分钟前 通过 web发布</i>
    </div>

    <div class="post">
        <a class="username" href="profile.php?u=test">test</a>
        hello<br>
        <i>22 分钟前 通过 web发布</i>
    </div>

<?php
include './footer.php';
?>
