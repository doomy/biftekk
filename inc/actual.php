<?php
    $event = $dbh->query_get_assoc_onerow(
        array('filename', 'date', 'gallery_link'), 'events', 'date', true
    );
    $image_url = "img/events/$event[filename]";
    $gallery_link = $event['gallery_link'];
?>
