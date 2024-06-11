<?php

    $time = 3600 * 24 * 7 * 2;
    ini_set('session.gc_maxlifetime', $time);
    ini_set('session.cookie_lifetime', $time);
    session_set_cookie_params($time);

    session_start();
    require '../vendor/autoload.php';

    new \App\Bootstrap;

?>

