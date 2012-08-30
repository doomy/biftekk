<?php
class Dir {
    # version 4
    
    public function get_files_from_dir_by_extension($dir, $extension) {
        if ($all_files = $this->_get_files_from_dir($dir)) {
            foreach ($all_files as $file) {
                if ($this->_file_has_extension($file, $extension)) {
                    $files[] = $file;
                }
            }
            return $files;
        }
        else return false;
    }
    
    public function create_dir($dir_name) {
        mkdir($dir_name);
    }

    private function _get_files_from_dir($dir) {
        if ($handle = @opendir($dir)) {
            $files = array();
            while ($file = readdir($handle)) {
                if ($file != "." && $file != "..") {
                    $files[] = $file;
                }
            }
            return $files;
        }
        else return false;
    }
    
    private function _file_has_extension($filename, $extension) {
        return stristr($filename, '.'.$extension);
    }
}
?>
