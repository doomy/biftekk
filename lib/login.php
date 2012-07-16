<?php
class Login {
    # requires session_start
    # version 3
    
    public function is_logged_in() {
        return isset($_SESSION['logged_in']);
    }
    
    public function log_out() {
        unset($_SESSION['logged_in']);
    }
    
    public function attempt_login($given_credentials, $expected_credentials) {
        if ($this->_check_login($given_credentials, $expected_credentials)) {
            $this->_log_in();
            return true;
        }
        else return false;
    }
    
    function _check_login($given_credentials, $expected_credentials) {
        return (
            $given_credentials->username == $expected_credentials->username
            && $given_credentials->password == $expected_credentials->password
        );
    }
    
    function _log_in() {
        $_SESSION['logged_in'] = true;
    }
}
?>
