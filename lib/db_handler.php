<?php
class dbHandler {
    public function __construct($db_host, $db_user, $db_pass, $db_name) {
        $connection = mysql_connect($db_host, $db_user, $db_pass);
        mysql_select_db($db_name, $connection);
        return $connection;
    }
}
?>