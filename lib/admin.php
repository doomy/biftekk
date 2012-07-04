<?php
class Admin {
    # version 8
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
            else return $this->_logged_in();
        }
        if(isset($_POST['username']) && $this->_attempt_login()) {
            return $this->_logged_in();
        }
        $this->_show_login_form();
    }
    
    public function add_modules($module) {
        $this->modules[] = $module;
    }

    function _show_login_form() {
        include($this->env->basedir.'templates/admin/login.php');
    }
    
    function _logged_in() {
        $this->template_vars = array();
        foreach($this->modules as $module) {
            #var_dump( $module->template_vars);
            $content_template = $module->content_template;
            $this->template_vars = array_merge(
                $this->template_vars, $module->template_vars
            );
        }
        include($this->env->basedir.'templates/admin.php');
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
