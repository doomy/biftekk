<?php
class dbHandler {
    public function __construct($db_host, $db_user, $db_pass, $db_name) {
        $connection = mysql_connect($db_host, $db_user, $db_pass);
        mysql_select_db($db_name, $connection);
        return $connection;
    }

    public function query_get_assoc_onerow(
        $columns, $table, $order_by = '', $desc = false, $limit=0
    ) {
        if ($order_by <> '')
            $order_by = "ORDER BY $order_by";
        if ($desc)
            $desc = 'DESC';
        else
            $desc = '';
        if ($limit > 0)
            $limit = "LIMIT $limit";
        else
            $limit = '';
        $sql = "SELECT $columns FROM $table $order_by $desc LIMIT 1;";
        $result = mysql_query($sql);
        return mysql_fetch_assoc($result);
    }
}
?>