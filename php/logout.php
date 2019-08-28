<?php
/**
 * Created by PhpStorm.
 * User: jfa
 * Date: 2019/8/22
 * Time: 11:20
 */
include ('./lib.php');
$userid = $_COOKIE['ud'];
setcookie('ud','',-1);
setcookie('un','',-1);
setcookie('salt','',-1);

$r = rescont();
$r->set("user:userid:".$userid.":salt",'');
header('Location: ./index.php');