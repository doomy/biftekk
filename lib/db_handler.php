<?php
class dbHandler {
    private $connection;

    public function __construct($env) {
        $this->connection = mysql_connect($env->ENV_VARS['DB_HOST'], $env->ENV_VARS['DB_USER'], $env->ENV_VARS['DB_PASS']);
        mysql_select_db($env->ENV_VARS['DB_NAME'], $this->connection);
        if ($env->ENV_VARS['DB_CREATE']) {
            $this->_create_db();
        }
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

    public function query($sql) {
        return mysql_query($sql, $this->connection);
    }
    
    function _create_db() {
        $sql = 'CREATE TABLE IF NOT EXISTS upgrade_history (id INT, message TEXT);';
        $this->query($sql);
    }
}
?>
