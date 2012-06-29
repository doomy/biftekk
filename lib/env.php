<?php
class Env {
    public function __construct($env_file) {
        include ($env_file);

        $this->ENV_VARS['DB_CREATE'] = $DB_CREATE;
        $this->ENV_VARS['DB_HOST'] = $DB_HOST;
        $this->ENV_VARS['DB_USER'] = $DB_USER;
        $this->ENV_VARS['DB_PASS'] = $DB_PASS;
        $this->ENV_VARS['DB_NAME'] = $DB_NAME;
    }
}
?>
