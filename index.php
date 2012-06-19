<?php
    include('lib/env.php');
    include('lib/db_handler.php');

    $env = new Env('env_spec/db.php');
    $dbh = new dbHandler($env);

    $action = $_REQUEST['action'];
    switch ($action) {
        case 'actual':
            $module = $content_template = 'actual';
        break;
        case 'archiv':
            $module = $content_template = 'archiv';
        break;
        default:
            $content_template = 'intro';
        break;
    }

    if (isset($module)) include ("inc/$module.php");
    include ('templates/index.tpl');
?>