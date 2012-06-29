<?php
class Env {
    public function __construct($env_file) {
        include ($env_file);

        $this->ENV_VARS = $ENV_VARS;
    }
}
?>
