<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$db['default'] = array(
	'hostname' => db_hostname,
	'username' => db_username, // Ganti dengan nama pengguna database Anda
	'password' => db_password,// Ganti dengan kata sandi database Anda
	'database' => db_database,// Ganti dengan nama database Anda
	'dbdriver' => 'mysqli', // Atau 'pdo', 'pgsql', dll.
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT != 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);