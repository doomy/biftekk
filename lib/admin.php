<?php
class Admin {
    # version 1
    
    public function __construct($env) {
        session_start();
        $this->env = $env;
    }

    public function run() {
        if (!$this->_check_login(@$_REQUEST['username'], @$_REQUEST['password'])) {
            $this->_show_login_form();
        }
    }
    
    function _check_login($username, $password) {
        return ( isset ( $_SESSION['username'] )  || (
            $username == $this->env->ENV_VARS['admin_username']
            && $password == $this->env->ENV_VARS['admin_password']
        ));
    }
    
    function _show_login_form() {
        include($this->env->basedir.'templates/admin/login.tpl');
    }
}
?>
