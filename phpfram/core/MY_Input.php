<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fungsi-fungsi ini menyediakan cara yang aman dan mudah untuk mengambil data dari
 * input pengguna (POST dan GET).  Fungsi-fungsi ini juga menangani sanitasi
 * untuk mencegah serangan XSS.
 *
 * Tempatkan file ini di direktori `core/` dan beri nama misalnya `MY_Input.php`.
 */
if (!function_exists('get_post')) {
    /**
     * Mengambil nilai dari $_POST dengan sanitasi XSS.
     *
     * @param string $index   Nama key dari data POST yang ingin diambil.
     * @param bool   $xss_clean Apakah akan menjalankan sanitasi XSS atau tidak. Default TRUE.
     * @return string|null  Nilai dari $_POST setelah sanitasi, atau NULL jika tidak ada.
     */
    function get_post($index, $xss_clean = TRUE) {
        if (isset($_POST[$index])) {
            $value = $_POST[$index];
            if ($xss_clean) {
                // Pastikan fungsi xss_clean() tersedia.  Jika tidak, Anda perlu
                // mendefinisikannya sendiri atau menggunakan library eksternal.
                $value = xss_clean($value); // Panggil fungsi sanitasi
            }
            return $value;
        }
        return null;
    }
}

if (!function_exists('get_get')) {
    /**
     * Mengambil nilai dari $_GET dengan sanitasi XSS.
     *
     * @param string $index   Nama key dari data GET yang ingin diambil.
     * @param bool   $xss_clean Apakah akan menjalankan sanitasi XSS atau tidak. Default TRUE.
     * @return string|null  Nilai dari $_GET setelah sanitasi, atau NULL jika tidak ada.
     */
    function get_get($index, $xss_clean = TRUE) {
        if (isset($_GET[$index])) {
            $value = $_GET[$index];
            if ($xss_clean) {
                $value = xss_clean($value); // Panggil fungsi sanitasi
            }
            return $value;
        }
        return null;
    }
}


if (!function_exists('xss_clean')) {
    /**
     * Fungsi untuk membersihkan string dari potensi serangan XSS.
     * Fungsi ini adalah placeholder.  Anda harus menggantinya dengan implementasi
     * yang sesuai dengan framework atau library yang Anda gunakan.
     *
     * @param string $string String yang akan dibersihkan.
     * @return string String yang sudah dibersihkan.
     */
    function xss_clean($string) {
        // Implementasi placeholder: htmlentities() hanyalah contoh dasar dan
        // mungkin tidak cukup untuk semua kasus XSS.
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
        // Contoh Implementasi yang Lebih Baik (membutuhkan library HTML Purifier):
        // require_once APPPATH . 'third_party/htmlpurifier/HTMLPurifier.auto.php';
        // $config = HTMLPurifier_Config::createDefault();
        // $purifier = new HTMLPurifier($config);
        // return $purifier->purify($string);
    }
}
