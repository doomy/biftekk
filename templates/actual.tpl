<img src = 'img/events/<?php
    $event = $dbh->query_get_assoc_onerow(
        'filename, date', 'events', 'date', true, 1
    );
    echo $event['filename'];
?>' />

<a href='?action=archiv'>ARCHIV</a>