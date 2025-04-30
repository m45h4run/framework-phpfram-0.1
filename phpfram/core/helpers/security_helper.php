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

if (!function_exists('xss_clean')) {
    /**
     * XSS Clean
     *
     * Filters data to prevent Cross Site Scripting (XSS) attacks.
     *
     * @param	string|array	$data	Input data
     * @return	string|array	Cleaned data
     */
    function xss_clean($data) {
        // Jika data adalah array, bersihkan setiap elemen secara rekursif
        if (is_array($data)) {
            $cleaned = [];
            foreach ($data as $key => $value) {
                $cleaned[$key] = xss_clean($value);
            }
            return $cleaned;
        }

        // Gunakan htmlspecialchars untuk membersihkan XSS
        $cleaned = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $cleaned;
    }
}

if (!function_exists('remove_invisible_characters')) {
    /**
     * Remove Invisible Characters
     *
     * This prevents people from adding ASCII control characters to
     * hack data or insert malicious code.
     *
     * @param	string	$str
     * @return	string
     */
    function remove_invisible_characters($str) {
        static $non_display_regex = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/s';
        return preg_replace($non_display_regex, '', $str);
    }
}

if (!function_exists('sanitize_filename')) {
    /**
     * Sanitize Filename
     *
     * @param	string	$filename	Filename
     * @return	string
     */
    function sanitize_filename($filename) {
        // Strip any character that is not a word character, underscore,
        // hyphen, space, period, plus, or percentage sign.
        $bad = array_merge(
            array_map('chr', range(0, 31)),
            ["<", ">", "*", "?", "\\", "/", "|", ":", '"']
        );
        $filename = str_replace($bad, '', $filename);
        $filename = preg_replace('/\s+/', '_', $filename);
        return trim($filename, '_.-');
    }
}
