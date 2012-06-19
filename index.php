<?php
    include('env_spec/db.php');
    include('lib/db_handler.php');

    $dbh = new dbHandler($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $action = $_REQUEST['action'];
    switch ($action) {
        case 'actual':
            $content_module   = 'actual';
            $content_template = 'actual';
        break;
        case 'archiv':
            $content_template = 'archiv';
        break;
        default:
            $content_template = 'intro';
        break;
    }

    include ('templates/index.tpl');
?>