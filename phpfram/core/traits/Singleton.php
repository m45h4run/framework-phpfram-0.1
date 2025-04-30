<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* require_once 'core/traits/Singleton.php'; // Pastikan path ini benar */

trait Singleton {
    private static $instance;

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    private function __construct() {}
    private function __clone() {}
    public function __wakeup() {} // Ubah ke public
}
