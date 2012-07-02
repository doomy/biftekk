<?php
    require ('../lib/env.php');
    require ('../lib/admin.php');
    require ('../lib/admin/plugins/table_edit.php');
    $env   = new Env('../');

    $admin = new Admin($env);
    $admin->add_modules(new TableEdit());
    $admin->run();
?>
