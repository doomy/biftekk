<?php
    require ('../lib/env.php');
    require ('../lib/db_handler.php');
    require ('../lib/admin.php');
    require ('../lib/admin/plugins/table_edit.php');
    require ('../lib/admin/plugins/table_edit/editable_column.php');
    $env   = new Env('../');
    $dbh = new dbHandler($env);
    $admin = new Admin($env);
    
    $filename_column = new EditableColumn('filename','file');
    $date_column     = new EditableColumn('date', 'text');
    $table_edit = new TableEdit(
        $admin, $dbh, 'events', array($filename_column, $date_column
    ));
    $admin->add_modules($table_edit);
    $admin->run();
?>
