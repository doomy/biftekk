<!doctype html>
<?php // version 2 ?>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Administrace</title>
        <?php $admin = $this ?>
        
        <?php
            include( $admin->env->basedir . 'lib/template/included_file.php' );

            $files_to_be_included = array(
                new IncludedFile('style.css', 'css', $admin->env),
                new IncludedFile(
                    'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js',
                    'javascript', $admin->env
                ),
                new IncludedFile(
                    $admin->env->basedir . 'admin/js/modules/table_edit.js',
                    'javascript', $admin->env
                )
            );

            foreach ($files_to_be_included as $file_to_be_included) {
                $file_to_be_included->include_file();
            }
        ?>

    </head>
    <body>
        <?php
            include ($admin->env->basedir . 'admin/templates/plugins/' . $content_template);
        ?>
        <br />
        <a href='?action=logout' />Log out</a>
    </body>
</html>
