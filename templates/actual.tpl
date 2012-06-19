<img src = 'img/events/<?php
    $sql = 'SELECT filename, date FROM events ORDER BY date DESC LIMIT 1;';
    $result = mysql_query($sql);

    $event = mysql_fetch_assoc($result);

    echo $event['filename'];

?>' />

<a href='?action=archiv'>ARCHIV</a>