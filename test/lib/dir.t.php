<?php

class UnitTest_Dir {
// version 1
    
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
        $testing_directory_name = 'testing directory';
        if (is_dir($testing_directory_name)) {
            rmdir($testing_directory_name);
        }
        $this->dir_handler->create_dir($testing_directory_name);
        $result = is_dir($testing_directory_name);
        rmdir($testing_directory_name);
        return $result;
    }
    
    public function runtests() {
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
$unittest_dir->runtests();

?>
