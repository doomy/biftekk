<img src = 'img/events/<?php
    $event = $dbh->query_get_assoc_onerow(
        array('filename', 'date'), 'events', 'date', true
    );
    echo $event['filename'];
?>' />

<a href='?action=archiv'>ARCHIV</a>