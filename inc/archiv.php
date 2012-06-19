<?php
    $sql = "SELECT filename FROM events ORDER BY DATE desc";
    $result = $dbh->query($sql);

    while ($assoc = mysql_fetch_assoc($result)) {
        $file_names[] = 'img/events/'.$assoc['filename'];
    }
?>