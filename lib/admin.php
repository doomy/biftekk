<?php
class Admin {
    # version 5
    # requires Env, Login
    
    public function __construct($env) {
        session_start();
        $this->env = $env;
    }

    public function run() {
        require ($this->env->basedir.'lib/login.php');
        $this->login = new Login();
        if ($this->login->is_logged_in()) {
            if (@$_GET['action']=='logout') {
                $this->login->log_out();
            }
            else {
                $this->_logged_in();
                return;
            }
        }
        if(isset($_POST['username']) && $this->_attempt_login()) {
            $this->_logged_in();
            return;
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
    
    function _attempt_login() {
        require ($this->env->basedir.'lib/login/credentials.php');
        $given_credentials = new Credentials(
            $_POST['username'], $_POST['password']
        );
        $expected_credentials = new Credentials(
            $this->env->ENV_VARS['admin_username'],
            $this->env->ENV_VARS['admin_password']
        );

        if ($this->login->attempt_login(
            $given_credentials, $expected_credentials
        ))
        {
            return true;
        }
        return false;
    }
}
?>
