<?php
class IncludedFile {
    // version 1

    public function __construct($file, $type) {
        $this->file = $file;
        $this->type = $type;
    }

    public function include_file() {
        switch ($this->type) {
            case 'javascript':
                echo "<script src='$this->file' type='text/javascript'></script>";
            break;
            case 'css':
                echo "<link rel='stylesheet' href='$this->file'>";
            break;
        }
    }
}

?>
