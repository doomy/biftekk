<?php
    $event = $dbh->query_get_assoc_onerow(
        array('filename', 'date'), 'events', 'date', true
    );
    $image_url = "img/events/$event[filename]";
?>