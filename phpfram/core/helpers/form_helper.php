<?php
/**
 * Gemini Framewok
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2024, m45h4run & Gemini
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    Gemini Framework
 * @author     m45h4run
 * @author     4run & Gemini
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @link       https://sites.google.com/view/m45h4run 
 * @since      Version 1.0.0
 * @filesource
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gemini Framework Form Helpers
 *
 * @package     Gemini Framework
 * @subpackage  Helpers
 * @category    Helpers
 * @author      m45h4run
 * @author      Gemini
 * @link        [Link ke dokumentasi helper Anda, jika ada]
 */

// ------------------------------------------------------------------------
require_once 'core/traits/Singleton.php';

if (!function_exists('form_open')) {
    /**
     * Form Declaration
     *
     * Creates the opening portion of the form.
     *
     * @param	string	$action		The form action URL
     * @param	array	$attributes	A key/value pair of attributes
     * @param	array	$hidden		An array of hidden fields
     * @return	string
     */
    function form_open($action = '', $attributes = [], $hidden = []) {
    	$form = '<form  method="post" action="';
    	$form .= ($action) ? site_url().$action : $_SERVER['PHP_SELF'];
    	$form .= '"';

    	if (is_array($attributes) && count($attributes) > 0) {
    		foreach ($attributes as $key => $val) {
    			$form .= ' ' . $key . '="' . $val . '"';
    		}
    	}
    	$form .= '>';

    	if (is_array($hidden) && count($hidden) > 0) {
    		foreach ($hidden as $name => $value) {
    			$form .= '<input type="hidden" name="' . $name . '" value="' . htmlspecialchars($value, ENT_QUOTES) . '">';
    		}
    	}

    	return $form;
    }
}

if (!function_exists('form_open_multipart')) {
    /**
     * Form Declaration - Multipart
     *
     * Creates the opening portion of a "multipart" form.
     *
     * @param	string	$action		The form action URL
     * @param	array	$attributes	A key/value pair of attributes
     * @param	array	$hidden		An array of hidden fields
     * @return	string
     */
    function form_open_multipart($action = '', $attributes = [], $hidden = []) {
    	$attributes['enctype'] = 'multipart/form-data';
    	return form_open($action, $attributes, $hidden);
    }
}

if (!function_exists('form_close')) {
    /**
     * Form Close Tag
     *
     * Returns the HTML form close tag
     *
     * @return	string
     */
    function form_close() {
    	return '</form>';
    }
}



if (!function_exists('input_post')) {
    /**
     * Mengambil nilai dari $_POST dengan sanitasi XSS.
     *
     * @param string $index   Nama key dari data POST yang ingin diambil.
     * @param bool   $xss_clean Apakah akan menjalankan sanitasi XSS atau tidak. Default TRUE.
     * @return string|null  Nilai dari $_POST setelah sanitasi, atau NULL jika tidak ada.
     */
    function input_post($index, $xss_clean = TRUE) {
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

if (!function_exists('input_get')) {
    /**
     * Mengambil nilai dari $_GET dengan sanitasi XSS.
     *
     * @param string $index   Nama key dari data GET yang ingin diambil.
     * @param bool   $xss_clean Apakah akan menjalankan sanitasi XSS atau tidak. Default TRUE.
     * @return string|null  Nilai dari $_GET setelah sanitasi, atau NULL jika tidak ada.
     */
    function input_get($index, $xss_clean = TRUE) {
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


if (!function_exists('input_post_file')) {
    /**
     * Menangani upload gambar dengan aman.
     *
     * @param string $field_name Nama field dari form yang digunakan untuk upload file (misalnya, 'gambar').
     * @param string $upload_path Path direktori tempat gambar akan disimpan (relatif terhadap base path).
     * @param array  $allowed_types Tipe file yang diizinkan (misalnya, ['jpg', 'jpeg', 'png']).
     * @param int    $max_size Ukuran maksimum file dalam kilobyte (KB).
     * @return array|null Mengembalikan array berisi informasi file jika upload berhasil,
     * atau NULL jika terjadi kesalahan.  Array berisi kunci-kunci seperti
     * 'file_name', 'file_path', 'full_path', 'raw_name', 'file_ext',
     * 'file_size', 'is_image', 'image_width', 'image_height', dan 'mime_type'.
     */
    function input_post_file($field_name, $upload_path, $allowed_types = ['jpg', 'jpeg', 'png'], $max_size = 2048) {
        // Pastikan direktori upload ada dan dapat ditulis.
        if (!is_dir($upload_path) && !mkdir($upload_path, 0777, TRUE)) {
            error_log('Direktori upload tidak dapat dibuat: ' . $upload_path);
            return null;
        }

        if (!is_writable($upload_path)) {
            error_log('Direktori upload tidak dapat ditulis: ' . $upload_path);
            return null;
        }

        // Konfigurasi upload.
        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = implode('|', $allowed_types); // Konversi array ke string yang dipisahkan pipe
        $config['max_size']      = $max_size;
        $config['encrypt_name']  = TRUE; // Enkripsi nama file untuk keamanan.
        $config['remove_spaces'] = TRUE; // Hapus spasi dari nama file

        // Load library upload.
        // Jika menggunakan framework, gunakan library upload bawaan jika ada.
        // Di sini, kita menggunakan implementasi manual untuk contoh.
        if (!function_exists('do_upload')) {
            /**
             * Melakukan upload file. Fungsi ini adalah implementasi manual
             * dan harus diganti dengan fungsi upload dari framework Anda jika ada.
             */
            function do_upload($field_name, $config) {
                if (!isset($_FILES[$field_name])) {
                    return ['error' => 'File tidak diupload.'];
                }

                $file = $_FILES[$field_name];

                // Check for upload errors
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    switch ($file['error']) {
                        case UPLOAD_ERR_INI_SIZE:
                        return ['error' => 'Ukuran file melebihi upload_max_filesize di php.ini.'];
                        case UPLOAD_ERR_FORM_SIZE:
                        return ['error' => 'Ukuran file melebihi MAX_FILE_SIZE dalam form HTML.'];
                        case UPLOAD_ERR_PARTIAL:
                        return ['error' => 'File hanya terupload sebagian.'];
                        case UPLOAD_ERR_NO_FILE:
                        return ['error' => 'Tidak ada file yang diupload.'];
                        case UPLOAD_ERR_NO_TMP_DIR:
                        return ['error' => 'Direktori temporary tidak ditemukan.'];
                        case UPLOAD_ERR_CANT_WRITE:
                        return ['error' => 'Gagal menulis file ke disk.'];
                        case UPLOAD_ERR_EXTENSION:
                        return ['error' => 'Ekstensi file upload dihentikan oleh extension.'];
                        default:
                        return ['error' => 'Kesalahan upload tidak diketahui.'];
                    }
                }
                // Basic validation
                if ($file['size'] > $config['max_size'] * 1024) {
                    return ['error' => 'Ukuran file melebihi batas maksimum (' . $config['max_size'] . ' KB).'];
                }

                $allowed_types = explode('|', $config['allowed_types']);
                $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                if (!in_array($file_ext, $allowed_types)) {
                    return ['error' => 'Tipe file tidak diizinkan. Tipe yang diizinkan adalah ' . $config['allowed_types'] . '.'];
                }

                // Sanitize filename
                $new_file_name = ($config['encrypt_name']) ? md5(uniqid($file['name'], true)) . '.' . $file_ext : str_replace(' ', '_', $file['name']);
                $new_file_path = $config['upload_path'] . '/' . $new_file_name;

                if (!move_uploaded_file($file['tmp_name'], $new_file_path)) {
                    return ['error' => 'Gagal memindahkan file yang diupload.'];
                }
                // Get image info if it is an image
                $image_info = getimagesize($new_file_path);
                $is_image = ($image_info !== false);
                $file_data = [
                    'file_name'      => $new_file_name,
                    'file_path'      => $config['upload_path'],
                    'full_path'      => $new_file_path,
                    'raw_name'       => pathinfo($new_file_name, PATHINFO_FILENAME),
                    'file_ext'       => $file_ext,
                    'file_size'      => round($file['size'] / 1024, 2), // in KB
                    'is_image'       => $is_image,
                    'image_width'    => $is_image ? $image_info[0] : null,
                    'image_height'   => $is_image ? $image_info[1] : null,
                    'mime_type'      => $is_image ? $image_info['mime'] : null,
                ];

                return $file_data;
            }
        }

        // Lakukan upload.
        $upload_result = do_upload($field_name, $config);

        if (isset($upload_result['error'])) {
            error_log('Upload gambar gagal: ' . $upload_result['error']);
            return null;
        }

        return $upload_result;
    }
}
