<?php
class IncludedFile {
    // version 2

    public function __construct($file, $env, $type) {
        $this->file = $file;
        $this->type = $type;
        $this->env = $env;
    }

    public function include_file() {
        if (!$this->_contains_path()) {
            $this->_assume_path();
        }
        switch ($this->type) {
            case 'javascript':
                echo "<script src='$this->file' type='text/javascript'></script>";
            break;
            case 'css':
                echo "<link rel='stylesheet' href='$this->file'>";
            break;
        }
    }
    
    function _contains_path() {
        return (strpos($this->file, '/') > -1);
    }
    
    function _assume_path(){
        if ($this->type == 'javascript') {
            $this->file = $this->env->basedir . 'js/' . $this->file;
        }
    }
}

?>
