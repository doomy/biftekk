<?php
class dbHandler {
    # version 7

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
        $this->_manage_upgrades();
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
    
    public function get_array_of_rows_from_table($table_name) {
        $sql = "SELECT * FROM $table_name";
        $result = $this->query($sql);
        while ($row = mysql_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
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
    
    private function _create_db() {
        $this->process_sql_file($this->env->basedir.'sql/base.sql');
    }
    
    private function _manage_upgrades() {
        $last_processed_upgrade_id = $this->_get_last_processed_upgrade_id();

        $upgrade_files = $this->_get_upgrade_files();
        
        $last_file = end($upgrade_files);
        $newest_upgrade_id = $this->_get_upgrade_id_from_filename($last_file);

        if ($newest_upgrade_id > $last_processed_upgrade_id) {
            $this->_upgrade_to_actual(
                $upgrade_files, $last_processed_upgrade_id
            );
        }
    }
    
    private function _upgrade_to_actual(
        $upgrade_files, $last_processed_upgrade_id
    )
    {
        foreach ($upgrade_files as $upgrade_file) {
            $upgrade_id = $this->_get_upgrade_id_from_filename($upgrade_file);
            if ($upgrade_id > $last_processed_upgrade_id) {
                $this->_upgrade_to_version($upgrade_id, $upgrade_file);
            }
        }
    }
    
    private function _get_upgrade_id_from_filename($upgrade_file) {
        $parts = explode('.', $upgrade_file);
        return $parts[0];
    }

    private function _upgrade_to_version($upgrade_id, $upgrade_file) {
        $this->process_sql_file(
            $this->env->basedir . '/sql/upgrade/' . $upgrade_file
        );
        $this->_update_upgrade_version($upgrade_id);
    }
    
    private function _get_last_processed_upgrade_id() {
        $assoc_array = @$this->query_get_assoc_onerow(
            array('id'), 'upgrade_history', 'id', true
        );
        return $assoc_array['id'];
    }
    
    private function _get_upgrade_files() {
        include_once($this->env->basedir.'lib/dir.php');
        $dir_handler = new Dir;
        return $dir_handler->get_files_from_dir_by_extension(
             $this->env->basedir.'sql/upgrade', 'sql'
        );
    }
    
    private function _update_upgrade_version($upgrade_id) {
        $sql = "INSERT INTO upgrade_history (id, message) VALUES('$upgrade_id', 'Upgrade no. $upgrade_id');";
        $this->query($sql);
    }
}
?>
