<?php
    include('lib/db_handler.php');

    $dbh = new dbHandler('env_spec/db.php');
    $action = $_REQUEST['action'];
    switch ($action) {
        case 'actual':
            $module = $content_template = 'actual';
        break;
        case 'archiv':
            $content_template = 'archiv';
        break;
        default:
            $content_template = 'intro';
        break;
    }

    if (isset($module)) include ("inc/$module.php");
    include ('templates/index.tpl');
?>