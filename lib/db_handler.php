<?php
class dbHandler {
    private $connection;

    public function __construct($db_host, $db_user, $db_pass, $db_name) {
        $this->connection = mysql_connect($db_host, $db_user, $db_pass);
        mysql_select_db($db_name, $this->connection);
    }

    public function query_get_assoc_onerow(
        $columns, $table, $order_by = '', $desc = false
    ) {
        if ($order_by <> '')
            $order_by = "ORDER BY $order_by";
        if ($desc)
            $desc = 'DESC';
        else
            $desc = '';
        $sql = "SELECT $columns FROM $table $order_by $desc LIMIT 1;";
        $result = mysql_query($sql, $this->connection);
        return mysql_fetch_assoc($result);
        echo mysql_error;
    }
}
?>