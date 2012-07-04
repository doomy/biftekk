<!doctype html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title>Administrace</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            $admin = $this;
            include ($admin->env->basedir . 'templates/admin/plugins/'.$content_template);
        ?>
        <br />
        <a href='?action=logout' />Log out</a>
    </body>
</html>
