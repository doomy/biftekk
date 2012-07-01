<?php
class Dir {
    # version 1
    
    public function get_files_from_dir_by_extension($dir, $extension) {
        if ($all_files = $this->_get_files_from_dir($dir)) {
            foreach ($all_files as $file) {
                if ($this->_file_has_extension($file, $extension)) {
                    $files[] = $file;
                }
            }
            return $files;
        }
        else die('could not read env config directory');
    }

    function _get_files_from_dir($dir) {
        if ($handle = opendir($dir)) {
            while ($file = readdir($handle)) {
                if ($file != "." && $file != "..") {
                    $files[] = $file;
                }
            }
            return $files;
        }
        else return false;
    }
    
    function _file_has_extension($filename, $extension) {
        return stristr($filename, '.'.$extension);
    }
}
?>
