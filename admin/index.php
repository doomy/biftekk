<?php
    require ('../lib/env.php');
    require ('../lib/db_handler.php');
    require ('../lib/admin.php');
    require ('../lib/admin/plugins/table_edit.php');
    $env   = new Env('../');
    $dbh = new dbHandler($env);
    $admin = new Admin($env);
    $admin->add_modules(new TableEdit($dbh, 'events', array('filename')));
    $admin->run();
?>
