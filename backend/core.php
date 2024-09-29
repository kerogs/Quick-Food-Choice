<?php

    session_start();

    // ? Import functions
    require_once __DIR__."/func/functions.php";

    if(!isset($_SESSION["loginType"])) {
        header('Location: /');
        exit();
    }