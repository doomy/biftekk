<?php

class UnitTest_Dir {
// version 1

    private $TESTING_DIRECTORY_NAME = 'testing_directory';
    
    public function __construct() {
        require ('../../lib/env.php');
        $env = new Env('../../');
        include_once ($env->basedir . 'lib/dir.php');

        $this->dir_handler = new Dir;
    }
    
    private function test_get_files_from_dir_by_extension_returns_false_when_directory_doesnt_exist() {
        return (!$this->dir_handler->get_files_from_dir_by_extension('non-existent-dir', 'somext'));
    }
    
    private function test_create_dir() {
        $this->_reset_testing_directory();
        $this->dir_handler->create_dir($this->TESTING_DIRECTORY_NAME);
        $result = is_dir($this->TESTING_DIRECTORY_NAME);
        $this->dir_handler->delete_dir($this->TESTING_DIRECTORY_NAME);
        return $result;
    }
    
    private function test_delete_dir() {
        $this->_reset_testing_directory();
        $this->dir_handler->create_dir($this->TESTING_DIRECTORY_NAME);
        $this->dir_handler->delete_dir($this->TESTING_DIRECTORY_NAME);
        $result = !is_dir($this->TESTING_DIRECTORY_NAME);
        $this->_reset_testing_directory();
        return $result;
    }
    
    private function _reset_testing_directory() {
        if (is_dir($this->TESTING_DIRECTORY_NAME)) {
            rmdir($this->TESTING_DIRECTORY_NAME);
        }
    }
    
    public function run_tests() {
        $methods = get_class_methods('UnitTest_Dir');
        foreach ($methods as $method) {
            if(strpos($method, 'test_') > -1) {
                if ($this->$method())
                    echo "ok: $method <br/>";
                else
                    echo "FAIL: $method </br>";
            }
        }
     }
}

$unittest_dir = new UnitTest_Dir();
$unittest_dir->run_tests();

?>
