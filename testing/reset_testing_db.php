<?php
    require ('../lib/env.php');
    require ('../lib/db_handler.php');
    
    $env   = new Env('../');
    $dbh = new dbHandler($env);
    $dbh->process_sql_file($env->basedir.'/testing/sql/events.sql');
    echo 'Testing DB reset';
?>
