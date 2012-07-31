<!doctype html>
<html lang="cs">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="The HTML5 Herald" />
        <meta name="author" content="SitePoint" />
        <title>Biftekk sound system</title>
        <?php
            include ($env->basedir . 'lib/template/included_file.php');
            $css = new IncludedFile ('style.css', 'css', $dbh);
        ?>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <?php include($env->basedir."$content_template.php"); ?>
    </body>
</html>
