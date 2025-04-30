<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelObjek extends BaseModel {
    public function __construct() {
        parent::__construct();
        $this->table = 'users';
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

    public function getAllUsers() {
        try {
            $query = $this->db->query("SELECT * FROM {$this->table}");
            return $query->fetchAll(PDO::FETCH_OBJ); // Fetch sebagai objek
        } catch (PDOException $e) {
            return (object) ['status' => false, 'message' => 'Gagal mengambil data user: ' . $e->getMessage()]; // Kembalikan sebagai objek
        }
    }

    public function getUserById($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ); // Fetch sebagai objek
        } catch (PDOException $e) {
           return (object) ['status' => false, 'message' => 'Gagal mengambil data user: ' . $e->getMessage()];
       }
   }

   public function createUser($data) {
    try {
            // Periksa apakah email sudah ada
        $query = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE email = :email");
        $query->bindParam(':email', $data['email']);
        $query->execute();
        $email_count = $query->fetchColumn();

        if ($email_count > 0) {
                return (object) ['status' => false, 'message' => 'Email sudah terdaftar.'];
                // Kembalikan sebagai objek
            }

            $query = $this->db->prepare("INSERT INTO {$this->table} (nama, email) VALUES (:nama, :email)");
            $query->bindParam(':nama', $data['nama']);
            $query->bindParam(':email', $data['email']);
            $query->execute();
            return (object) ['status' => true, 'message' => 'User berhasil dibuat.']; // Kembalikan sebagai objek
        } catch (PDOException $e) {
            return (object) ['status' => false, 'message' => 'Gagal membuat user: ' . $e->getMessage()]; // Kembalikan sebagai objek
        }
    }

    public function updateUser($id, $data) {
        try {
            $query = $this->db->prepare("UPDATE {$this->table} SET nama = :nama, email = :email WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->bindParam(':nama', $data['nama']);
            $query->bindParam(':email', $data['email']);
            $query->execute();
            return (object) ['status' => true, 'message' => 'User berhasil diupdate.']; // Kembalikan sebagai objek
        } catch (PDOException $e) {
            return (object) ['status' => false, 'message' => 'Gagal mengupdate user: ' . $e->getMessage()]; // Kembalikan sebagai objek
        }
    }

    public function deleteUser($id) {
        try {
            $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
            $query->bindParam(':id', $id);
            $query->execute();
            return (object) ['status' => true, 'message' => 'User berhasil dihapus.']; // Kembalikan sebagai objek
        } catch (PDOException $e) {
            return (object) ['status' => false, 'message' => 'Gagal menghapus user: ' . $e->getMessage()]; // Kembalikan sebagai objek
        }
    }
}
