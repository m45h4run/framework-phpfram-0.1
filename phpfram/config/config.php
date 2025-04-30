<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * URL / DOMAIN -----------------
 * */
$my_env['BASE_URL'] = 'http://mas.test/phpfram/';


/**
 * DATABASE ---------------------
 * */
$my_env['db_hostname'] = 'localhost';
$my_env['db_username'] = 'root';
$my_env['db_password'] = '';
$my_env['db_database'] = 'db_geminifram';

/*
| -------------------------------------------------------------------
| Loop All $my_env[]
| -------------------------------------------------------------------
*/
foreach ($my_env as $key_env => $value_env) {
	define($key_env, isset($_SERVER['GM_ENV']) ? $_SERVER['GM_ENV'] : $value_env);
}