<?php
class Env {
    # version 3

    public function __construct($basedir) {
        require($basedir.'lib/dir.php');

        $dir_handler = new Dir();
        $files = $dir_handler->get_files_from_dir_by_extension($basedir.'env_spec', 'php');
        foreach ($files as $file) {
            include($basedir . 'env_spec/'.$file);
        }
        $this->ENV_VARS = $ENV_VARS;
    }
}
?>
