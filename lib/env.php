<?php
class Env {
    # version 4

    public function __construct($basedir) {
        require($basedir.'lib/dir.php');
        $this->basedir = $basedir;
        $dir_handler = new Dir();
        $files = $dir_handler->get_files_from_dir_by_extension(
            $this->basedir.'env_spec', 'php'
        );
        foreach ($files as $file) {
            include($this->basedir . 'env_spec/'.$file);
        }
        $this->ENV_VARS = $ENV_VARS;
    }
}
?>
