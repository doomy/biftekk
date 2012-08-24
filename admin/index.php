<?php
// version 3

    require ('../lib/env.php');
    $env   = new Env('../');
    
    require ($env->basedir . 'lib/db_handler.php');
    require ($env->basedir . 'admin/lib/admin.php');
    require ($env->basedir . 'admin/lib/plugins/table_edit.php');
    require ($env->basedir . 'admin/lib/plugins/table_edit/editable_column.php');

    $dbh = new dbHandler($env);
    $admin = new Admin($env);
    
    $filename_column = new EditableColumn('filename','file');
    $date_column     = new EditableColumn('date', 'text');
    $gallery_link_column = new EditableColumn('gallery_link', 'text');
    $table_edit = new TableEdit(
        $admin,
        $dbh,
        'events',
        array( $filename_column, $date_column, $gallery_link_column )
    );
    $admin->add_modules($table_edit);
    $admin->run();
?>
