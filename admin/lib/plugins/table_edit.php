<?php
class TableEdit {
# version 9

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
        if (@$_POST['new_row'] == 'yes')
            $this->_insert_new_line();
    }
    
    private function _update_files() {
        require ($this->admin->env->basedir . 'lib/file_uploader.php');
        $fileUploader = new FileUploader;
        foreach ($_FILES as $file) {
            $this->_handle_file_upload($file, $fileUploader);
        }
    }
    
    private function _handle_file_upload($file, $fileUploader) {
        $uploaded_file_path = $fileUploader->upload(
            $this->admin->env->basedir . "img/events/", $file
        );
        $uploaded_filename =
            $this->_get_filename_from_path($uploaded_file_path);
        $this->_handle_filename_change($file['name'], $uploaded_filename);
    }
    
    private function _update_from_post() {
        foreach($_POST as $post_key => $post_value) {
            $sql = "";

            if (strpos($post_key, 'column__') > -1) {
                $sql .= $this->_get_update_sql_from_post($post_key, $post_value);
            }
            $this->dbh->query($sql);
        }
    }

    private function _insert_new_line() {
        foreach ($_POST as $post_key => $post_value) {
            if (strpos($post_key, 'newcol__') > -1) {
                $parts = explode('__', $post_key);
                $column = $parts[1];
                $to_insert[$column] = $post_value;
            }
        }
        if (@count($to_insert) > 0) {
                $sql = $this->_get_insert_sql($to_insert);
                $this->dbh->query($sql);
        }
    }

    private function _get_update_sql_from_post($post_key, $post_value) {
        $parts = explode('__', $post_key);
        $column = $parts[1];
        $id = array_pop($parts);
        return "UPDATE $this->table_name
            SET $column='$post_value' WHERE id=$id";
    }
    
    private function _get_insert_sql($to_insert) {
        echo "aaa";
        $sql = "INSERT INTO $this->table_name (";
        $index = 0;
        foreach($to_insert as $column => $value) {
            $sql .= "$column";
            if ($index < count($to_insert)-1)
                $sql .= ", ";
            $index++;
        }
        $sql .= ") VALUES(";
        $index = 0;
        foreach($to_insert as $column => $value) {
            $sql .= "'$value'";
            if ($index < count($to_insert)-1)
                $sql .= ", ";
            $index++;
        }
        $sql .= ");";

        return $sql;
    }
    
    private function _get_filename_from_path($path) {
        $parts = explode("/", $path);
        return array_pop($parts);
    }
    
    private function _handle_filename_change($old_filename, $new_filename) {
        if ($new_filename != $old_filename) {
            $this->_correct_filename_in_POST($old_filename, $new_filename);
        }
    }
    
    private function _correct_filename_in_POST($old_filename, $new_filename) {
        foreach ($_POST as $post_key => $post_value) {
            if ($post_value == $old_filename) {
                $_POST[$post_key] = $new_filename;
            }
        }
    }
}
?>
