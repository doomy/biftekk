<?php
class TableEdit {
# version 2
    public function __construct($dbh, $table) {
        $this->dbh = $dbh;
        $this->title = 'TableEdit';
        $this->content_template = 'table_edit.php';
        $this->template_vars = $this->_get_table_vars($table);
    }
    
    function _get_table_vars($table) {
        $rows = $this->dbh->get_array_of_rows_from_table($table);
        if (count($rows) <= 0) return false;
        $table_vars['columns'] = array_keys($rows[0]);
        $table_vars['rows']    = $rows;
        return $table_vars;
    }
}
?>
