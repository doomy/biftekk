<!doctype html>
<?php // version 2 ?>
<html lang="cs">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="The HTML5 Herald" />
        <meta name="author" content="SitePoint" />
        <title>Biftekk sound system</title>
        <?php
            include ($env->basedir . 'lib/template/included_file.php');
            $css = new IncludedFile ('css/style.css', $env);
            $jquery = new IncludedFile(
                    'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js',
                    $env
            );
            $css->include_file();
            $jquery->include_file();
        ?>

    </head>
    <body>
        <?php if($content_template != 'intro') { ?>
            <img src = "css/bg.jpg"  id="background"  style='width: 100%; height: 100%; position: absolute; left: 0px; top: 0px; z-index:-1000;' />
        <?php } ?>
        <?php include($env->basedir."$content_template.php"); ?>
    </body>
</html>
