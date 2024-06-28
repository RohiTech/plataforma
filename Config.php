<?php
class Config {
    private $config;

    public function __construct($file) {
        $this->config = parse_ini_file($file);
    }

    public function get($key) {
        return $this->config[$key];
    }
}
?>