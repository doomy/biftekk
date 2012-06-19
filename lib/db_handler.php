<?php
class dbHandler {
    private $connection;

    public function __construct($env) {
        $this->connection = mysql_connect($env->DB_HOST, $env->DB_USER, $env->DB_PASS);
        mysql_select_db($env->DB_NAME, $this->connection);
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
        $result = $this->query($sql);
        return mysql_fetch_assoc($result);
    }

    private function query($sql) {
        return mysql_query($sql, $this->connection);
    }

}
?>