<?php
class Login {
    # version 1
    
    public function is_logged_in() {
        return isset($_SESSION['logged_in']);
    }
}
?>
