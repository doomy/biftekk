<?php
class Admin {
    # version 2
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
                $this->_log_out();
            }
            else {
                $this->_logged_in();
                return true;
            }
        }
        if(isset ($_POST['username']) ) {
            if ($this->_check_login($_POST['username'], $_POST['password'])) {
                $this->_log_in();
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
        echo 'You are logged in.<br/>';
        echo "<a href='?action=logout' />Log out</a>";
    }
    
    function _log_out() {
        unset($_SESSION['logged_in']);
    }
    
    function _log_in() {
        $_SESSION['logged_in'] = true;
        echo 'Logging you in...';
        $this->_logged_in();
    }
}
?>
