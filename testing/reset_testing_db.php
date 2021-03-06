<?php
    require ('../lib/env.php');
    require ('../lib/db_handler.php');
    
    $env   = new Env('../');
    $dbh = new dbHandler($env);
    
    echo 'reseting events table data... <br />';
    $dbh->process_sql_file($env->basedir.'/testing/sql/events.sql');
    echo 'clearing upgrade history... <br />';
    $dbh->process_sql_file($env->basedir.'/testing/sql/upgrade_history.sql');

    echo '<strong>Testing dataset was succesfully reset!</strong>';
?>
