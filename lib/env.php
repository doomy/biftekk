<?php
class Env {
    # version 1

    public function __construct($env_dir) {
        require('lib/dir.php');

        $dir_handler = new Dir();
        $files = $dir_handler->get_files_from_dir_by_extension($env_dir, 'php');
        foreach ($files as $file) {
            include('env_spec/'.$file);
        }
        $this->ENV_VARS = $ENV_VARS;
    }


    

}
?>
