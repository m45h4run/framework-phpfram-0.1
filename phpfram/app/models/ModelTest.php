<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelTest extends BaseModel {
    public function __construct() {
        parent::__construct();
    }

    /*
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    */

    public function getAll() {
        $this->_select('*');
        $this->_table('users');
        return $this->_get();
    }
    public function getById($id) {
        return $this->_table('users')
        ->_select('id, nama, email')
        ->_where('id', $id)
        ->_get();
    }


    public function create($data) {
        $this->_table('users');
        return $this->_insert($data);
    }

    public function update($id, $data) {
        $this->_table('users'); 
        return $this->_update($id, $data);
    }

    public function delete($column, $value) {
        $this->_table('users');
        return $this->_delete($column, $value);
    }

}
