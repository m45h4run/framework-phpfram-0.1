<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('start_session')) {
    /**
     * Memulai sesi jika belum dimulai.
     *
     * * Untuk mencegah error "headers already sent", output buffering digunakan.
     */
    function start_session() {
        if (session_status() == PHP_SESSION_NONE) {
            ob_start(); // Tambahkan output buffering
            session_start();
        }
    }
}

if (!function_exists('set_userdata')) {
    /**
     * Menetapkan data ke sesi.
     *
     * @param string|array $key Nama key untuk data sesi, atau array asosiatif berisi pasangan key/value.
     * @param mixed        $value Nilai yang akan disimpan (hanya diperlukan jika $key adalah string).
     */
    function set_userdata($key, $value = NULL) {
        start_session();
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $_SESSION[$k] = $v;
            }
        } else {
            $_SESSION[$key] = $value;
        }
    }
}

if (!function_exists('userdata')) {
    /**
     * Mengambil data dari sesi.
     *
     * @param string $key Nama key dari data sesi yang ingin diambil.
     * @param mixed  $default Nilai default yang akan dikembalikan jika key tidak ditemukan. Default NULL.
     * @return mixed Nilai dari data sesi, atau $default jika key tidak ditemukan.
     */
    function userdata($key, $default = NULL) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }
}

if (!function_exists('unset_userdata')) {
    /**
     * Menghapus data dari sesi.
     *
     * @param string|array $key Nama key dari data sesi yang ingin dihapus, atau array berisi daftar key.
     */
    function unset_userdata($key) {
        if (is_array($key)) {
            foreach ($key as $k) {
                unset($_SESSION[$k]);
            }
        } else {
            unset($_SESSION[$key]);
        }
    }
}


if (!function_exists('set_flashdata')) {
    /**
     * Menetapkan flash data (data sesi yang hanya tersedia untuk request berikutnya).
     *
     * @param string $key Nama key untuk flash data.
     * @param mixed  $value Nilai flash data.
     */
    function set_flashdata($key, $value) {
        $_SESSION['flashdata'][$key] = $value;
    }
}

if (!function_exists('flashdata')) {
    /**
     * Mengambil flash data.  Data akan otomatis dihapus setelah diambil.
     *
     * @param string $key Nama key dari flash data yang ingin diambil.
     * @param mixed  $default Nilai default yang akan dikembalikan jika key tidak ditemukan. Default NULL.
     * @return mixed Nilai flash data, atau $default jika key tidak ditemukan.
     */
    function flashdata($key, $default = NULL) {
        if (isset($_SESSION['flashdata'][$key])) {
            $value = $_SESSION['flashdata'][$key];
            unset($_SESSION['flashdata'][$key]);
            return $value;
        }
        return $default;
    }
}

if (!function_exists('keep_flashdata')) {
    /**
     * Menyimpan flash data agar tersedia untuk request berikutnya setelah diambil.
     *
     * @param string $key Nama key dari flash data yang ingin disimpan.
     */
    function keep_flashdata($key) {
        if (isset($_SESSION['flashdata'][$key])) {
            
        }
    }
}



if (!function_exists('sess_destroy')) {
    /**
     * Menghancurkan semua data sesi.
     */
    function sess_destroy() {
        session_destroy();
    }
}