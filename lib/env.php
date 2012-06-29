<?php
class Env {
    public function __construct($env_dir) {
        if ($handle = opendir($env_dir)) {
            while ($file = readdir($handle)) {
                if ($file != "." && $file != ".." && $this->_file_has_extension($file, 'php')) {
                    $files[] = $file;
                }
            }
            
            foreach ($files as $file) {
                include('env_spec/'.$file);
            }
        }
        else die('could not read env config directory');
        $this->ENV_VARS = $ENV_VARS;
    }

    function _file_has_extension($filename, $extension) {
        return stristr($filename, '.'.$extension);
    }
}
?>
