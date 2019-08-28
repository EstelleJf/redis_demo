<?php
/**
 * Created by PhpStorm.
 * User: jfa
 * Date: 2019/8/22
 * Time: 9:51
 */
function P ($key){
    return $_POST[$key];
}

function G ($key){
    return $_GET[$key];
}

function error($msg){
    echo $msg;
    include ('./footer.php');
    exit;
}

function rescont(){
    static $redis = null;
    if($redis != null){
        return $redis;
    }
    $redis = new Redis();
    $redis ->connect('127.0.0.1',6379);
    return $redis;
}

function islogin(){
    if(!$_COOKIE['ud'] || !$_COOKIE['un']){
        return false;
    }

    if(!$_COOKIE['salt']){
        return false;
    }
    $r = rescont();
    $salt = $r->get('user:userid:'.$_COOKIE['ud'].':salt');
    if($salt != $_COOKIE['salt']){
        return false;
    }
    return array(
        'userid'=>$_COOKIE['ud'],
        'username'=>$_COOKIE['un'],
    );

}

function redom_str($num = 8){
    $chars = "";
    $str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for($i=1;$i<=8; $i++){
        $chars .= $str[mt_rand(0,61)];
    }
    return $chars;
}

function format_time($time ){
    $msg = "";
    $min = time() - $time;
    if(($h = floor($min/86400)) >0){
        $msg = $h."天前";
    }else if(($h = floor($min/3600)) >0){
        $msg = $h."小时前";
    }elseif(($h = floor($min/60)) >0){
        $msg = $h."分钟前";
    }else{
        $msg = '刚刚';
    }
    return $msg;
}

