<?php
class Admin {
    # version 3
    # requires Env, Login
    
    public function __construct($env) {
        session_start();
        $this->env = $env;
    }

    public function run() {
        require ($this->env->basedir.'lib/login.php');
        $login = new Login();
        if ($login->is_logged_in()) {
            if (@$_GET['action']=='logout') {
                $login->log_out();
            }
            else {
                $this->_logged_in();
                return true;
            }
        }
        if(isset ($_POST['username']) ) {
            $given_credentials->username = $_POST['username'];
            $given_credentials->password = $_POST['password'];
            $expected_credentials->username =
                $this->env->ENV_VARS['admin_username'];
            $expected_credentials->password =
                $this->env->ENV_VARS['admin_password'];
        
            if ($login->attempt_login($given_credentials, $expected_credentials)) {
                $this->_logged_in();
                return;
            }
        }
        $this->_show_login_form();
    }

    function _show_login_form() {
        include($this->env->basedir.'templates/admin/login.tpl');
    }
    
    function _logged_in() {
        echo 'You are logged in.<br/>';
        echo "<a href='?action=logout' />Log out</a>";
    }
}
?>
