<?php
    $sql = "SELECT filename, gallery_link FROM events ORDER BY DATE DESC LIMIT 999 OFFSET 1";
    $result = $dbh->query($sql);

    while ($assoc = mysql_fetch_assoc($result)) {
        $archive_files[] = $assoc;
    }
?>
