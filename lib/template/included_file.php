<?php
class IncludedFile {
    // version 4

    private $DEFAULT_JS_PATH = 'js/';

    public function __construct($file, $env, $type=null) {
        $this->file = $file;
        $this->type = $this->_get_type($type);
        $this->env = $env;
    }

    public function include_file() {
        if (!$this->_contains_path()) {
            $this->_assume_path();
        }
        switch ($this->type) {
            case 'javascript':
                echo "<script src='$this->file' type='text/javascript'></script> \n";
            break;
            case 'css':
                echo "<link rel='stylesheet' href='$this->file' /> \n";
            break;
        }
    }
    
    private function _contains_path() {
        return (strpos($this->file, '/') > -1);
    }
    
    private function _assume_path(){
        if ($this->type == 'javascript') {
            $this->file = $this->env->basedir . $this->DEFAULT_JS_PATH . $this->file;
        }
    }
    
    private function _get_type($type) {

        if(is_null($type)) {
            return $this->_assume_type();
        }
        else return $type;
    }
    
    private function _assume_type() {
        $extension = $this->_get_extension($this->file);
        switch (strtolower($extension)) {
            case 'css':
                return 'css';
            break;
            case 'js':
                return 'javascript';
            break;
            default:
                die ('Cannot determine file type!');
            break;
        }
    }
    
    private function _get_extension($filename) {
        $parts = explode('.', $filename);
        return array_pop($parts);
    }
}

?>
