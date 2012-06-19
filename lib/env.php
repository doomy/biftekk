<?php
class Env {
    public function __construct($env_file) {
        include ($env_file);
        $this->DB_HOST = $DB_HOST;
        $this->DB_USER = $DB_USER;
        $this->DB_PASS = $DB_PASS;
        $this->DB_NAME = $DB_NAME;
    }
}
?>