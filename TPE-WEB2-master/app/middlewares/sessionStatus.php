<?php

function sessionStatus($res){
    session_start();
    if(isset($_SESSION['ID_USER'])){
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->name = $_SESSION['NAME_USER'];
        return $res;
    } else {
        header('location: ' . 'login');
    }
}