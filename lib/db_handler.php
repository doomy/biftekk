<?php
class dbHandler {
    # version 4

    private $connection;

    public function __construct($env) {
        $this->env = $env;
        $this->connection = mysql_connect(
            $this->env->ENV_VARS['DB_HOST'],
            $this->env->ENV_VARS['DB_USER'],
            $this->env->ENV_VARS['DB_PASS']
        );
        mysql_select_db($env->ENV_VARS['DB_NAME'], $this->connection);
        if ($this->env->ENV_VARS['DB_CREATE']) {
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
        echo $sql;
        return mysql_query($sql, $this->connection);
    }
    
    public function get_array_of_rows_from_table($table_name) {
        $sql = "SELECT * FROM $table_name";
        $result = $this->query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    function _create_db() {
        $this->process_sql_file($this->env->basedir.'sql/base.sql');
    }
    
    public function process_sql($sql) {
        $queries = explode(';', $sql);
        foreach ($queries as $query) {
            $this->query($query.';');
        }
    }
    
    public function process_sql_file($path) {
        $sql = file_get_contents($path);
        $this->process_sql($sql);
    }
}
?>
