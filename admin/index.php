<?php
    require ('../lib/env.php');
    require ('../lib/admin.php');
    $env   = new Env('../');
    $admin = new Admin($env);
    $admin->run();
?>
