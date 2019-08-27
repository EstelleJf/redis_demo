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
    }else{
        return array(
            'userid'=>$_COOKIE['ud'],
            'username'=>$_COOKIE['un']
        );
    }
}

