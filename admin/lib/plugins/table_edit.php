<?php
class TableEdit {
# version 5
    public function __construct($admin, $dbh, $table, $editable_columns) {
        $this->admin = $admin;
        $this->dbh = $dbh;
        $this->title = 'TableEdit';
        $this->content_template = 'table_edit.php';
        $this->table_name = $table;
        $this->editable_columns = $editable_columns;
        if (isset($_POST['tableedit_action']))
            $this->_perform_action($_POST['tableedit_action']);
        $this->template_vars = $this->_get_table_vars();
    }
    
    private function _get_table_vars() {
        $rows = $this->dbh->get_array_of_rows_from_table($this->table_name);
        if (count($rows) <= 0) return false;
        $table_vars['columns'] = array_keys($rows[0]);
        $table_vars['rows']    = $rows;
        $table_vars['editable_columns'] = $this->editable_columns;
        return $table_vars;
    }
    
    private function _perform_action($action) {
        switch ($action) {
            case 'update':
               $this->_update();
            break;
        }
    }
    
    private function _update() {
        $this->_update_files();
        $this->_update_from_post();
    }
    
    private function _update_files() {
        foreach ($_FILES as $file) {
            move_uploaded_file(
                $file['tmp_name'],
                $this->admin->env->basedir . "img/events/" . $file["name"]
            );
        }
    }
    
    private function _update_from_post() {
        foreach($_POST as $post_key => $post_value) {
            $sql = "";

            if (strpos($post_key, 'column_') > -1) {
                $sql .= $this->_get_update_sql_from_post($post_key, $post_value);
            }
            $this->dbh->query($sql);
        }
    }

    private function _get_update_sql_from_post($post_key, $post_value) {
        $parts = explode('_', $post_key);
        $column = $parts[1];
        $id = array_pop($parts);
        return "UPDATE $this->table_name
            SET $column='$post_value' WHERE id=$id";
    }
}
?>
