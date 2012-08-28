<?php

class Logger {
// version 1

    public function __construct($env, $file) {
        $this->logfile = $env->basedir . 'log/log.txt';
        $this->file = $file;
        if(!file_exists($this->logfile))
            $this->log('Creating log file');
    }
    
    public function log($text) {
        @file_put_contents(
            $this->logfile, date("Y-m-d H:i:s") . substr((string)microtime(), 1, 8)
            . " <$this->file> "
            . ' '
            . $text
            . "\n", FILE_APPEND
        );
    }
}
?>
