<?php
class Env {
    public function __construct($env_dir) {
        $files = $this->_get_files__from_dir_by_extension($env_dir, 'php');
        foreach ($files as $file) {
            include('env_spec/'.$file);
        }
        $this->ENV_VARS = $ENV_VARS;
    }

    function _file_has_extension($filename, $extension) {
        return stristr($filename, '.'.$extension);
    }
    
    function _get_files__from_dir_by_extension($dir, $extension) {
        if ($handle = opendir($dir)) {
            while ($file = readdir($handle)) {
                if ($file != "." && $file != ".." && $this->_file_has_extension($file, $extension)) {
                    $files[] = $file;
                }
            }
            return $files;
        }
        else die('could not read env config directory');
    }
}
?>
