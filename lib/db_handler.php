<?php
class dbHandler {
    private $connection;

    public function __construct($env_file) {
        include ($env_file);
        $this->connection = mysql_connect($DB_HOST, $DB_USER, $DB_PASS);
        mysql_select_db($DB_NAME, $this->connection);
    }

    public function query_get_assoc_onerow(
        $columns_list, $table, $order_by = '', $desc = false
    ) {
        $columns = implode(', ', $columns_list);
        if ($order_by <> '')
            $order_by = "ORDER BY $order_by";
        if ($desc)
            $desc = 'DESC';
        else
            $desc = '';
        $sql = "SELECT $columns FROM $table $order_by $desc LIMIT 1;";
        $result = mysql_query($sql, $this->connection);
        return mysql_fetch_assoc($result);
    }
}
?>