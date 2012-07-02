<?php
class Admin {
    # version 1
    
    public function __construct($env) {
        session_start();
        $this->env = $env;
    }

    public function run() {
        if (isset($_SESSION['username'])) {
            $this->_logged_in();
            return true;
        }
        if(isset ($_POST['username']) ) {
            if ($this->_check_login($_POST['username'], $_POST['password'])) {
                $this->_logged_in();
                return true;
            }
        }
        $this->_show_login_form();
    }
    
    function _check_login($username, $password) {
        return (
            $username == $this->env->ENV_VARS['admin_username']
            && $password == $this->env->ENV_VARS['admin_password']
        );
    }
    
    function _show_login_form() {
        include($this->env->basedir.'templates/admin/login.tpl');
    }
    
    function _logged_in() {
        echo 'You are logged in.';
    }
}
?>
