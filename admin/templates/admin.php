<!doctype html>
<?php // version 2 ?>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Administrace</title>
        <link rel="stylesheet" href="style.css">
        <?php $admin = $this ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js" type="text/javascript"></script>
        <script src="<?php echo $admin->env->basedir ?>admin/js/modules/table_edit.js"/></script>
    </head>
    <body>
        <?php
            include ($admin->env->basedir . 'admin/templates/plugins/' . $content_template);
        ?>
        <br />
        <a href='?action=logout' />Log out</a>
    </body>
</html>
