<?php
// version 4

    require ('../lib/env.php');
    $env   = new Env('../');
    
    require ($env->basedir . 'lib/logger.php');
    $logger = new Logger($env, __FILE__);
    $logger->log('Init admin page');
    
    $logger->log('Attemting to require libs.');
    require ($env->basedir . 'lib/db_handler.php');
    require ($env->basedir . 'admin/lib/admin.php');
    require ($env->basedir . 'admin/lib/plugins/table_edit.php');
    require ($env->basedir . 'admin/lib/plugins/table_edit/editable_column.php');

    $logger->log('Creating dbHandler object.');
    $dbh = new dbHandler($env);

    $logger->log('Creating Admin object.');
    $admin = new Admin($env);
    
    $logger->log('Creating Admin Modules and assigning them.');
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
    
    $logger->log('Running Admin');
    $admin->run();
    
    $logger->log('Leaving admin page');
?>
