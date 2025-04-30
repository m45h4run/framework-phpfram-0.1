<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('site_url')) {
    function site_url($uri = '') {
        if (!defined('BASE_URL')) {
            throw new Exception('Konstanta BASE_URL belum didefinisikan.');
        }

        $base_url = BASE_URL;
        // Memastikan BASE_URL diakhiri dengan '/'
        if (substr($base_url, -1) != '/') {
            $base_url .= '/';
        }

        return $base_url . $uri;
    }
}

if (!function_exists('base_url')) {
    function base_url() {
        if (!defined('BASE_URL')) {
            throw new Exception('Konstanta BASE_URL belum didefinisikan.');
        }
        return BASE_URL;
    }
}

if (!function_exists('redirect')) {
    function redirect($url) {
        header('Location: ' . base_url() . $url);
        exit;
    }
}