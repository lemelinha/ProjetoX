<?php

    ini_set('session.gc_maxlifetime', 3600*24*7*2);
    ini_set("session.cookie_lifetime", 0);

    session_start();
    require '../vendor/autoload.php';

    new \App\Bootstrap;

?>

