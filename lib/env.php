<?php
class Env {
    public function __construct($env_dir) {
        if ($handle = opendir($env_dir)) {
            while ($file = readdir($handle)) {
                if ($file != "." && $file != ".." && stristr($file, '.php')) {
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
}
?>
