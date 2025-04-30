<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BaseModel {

    protected $db;
    protected $table;
    protected $select = '*';
    protected $where = [];
    protected $limit;
    protected $offset;
    protected $orderBy;
    protected $orderDirection = 'ASC';

    public function __construct() {
        global $db; 
        require_once 'Database.php';

        if (isset($db) && is_array($db)) {
            $db_config = $db['default'];
            if (isset($db_config)) {
                try {
                    $this->db = new PDO(
                        "mysql:host={$db_config['hostname']};dbname={$db_config['database']}",
                        $db_config['username'],
                        $db_config['password']
                    );
                    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                } catch (PDOException $e) {
                    die("Koneksi database gagal: " . $e->getMessage());
                }
            } else {
                die("Konfigurasi database default tidak ditemukan.");
            }
        } else {
            die("Konfigurasi database tidak ditemukan atau tidak valid.");
        }
    }

    // Metode untuk mengatur nama tabel
    public function _table($table) {
        $this->table = $table;
        return $this; // Memungkinkan chaining
    }

    // Metode untuk mengatur kolom yang akan diambil
    public function _select($select) {
        $this->select = $select;
        return $this; // Memungkinkan chaining
    }

     // Metode untuk menambahkan kondisi WHERE
    public function _where($column, $value = null, $operator = '=') {
        if (is_array($column)) {
            foreach ($column as $field => $val) {
                $this->where[] = [$field, '=', $val]; // Menyimpan kondisi sebagai array
            }
        } else {
         $this->where[] = [$column, $operator, $value];
     }
     return $this;
 }

    // Metode untuk mengatur limit
 public function _limit($limit) {
        $this->limit = intval($limit); // Ensure it's an integer
        return $this;
    }

    // Metode untuk mengatur offset
    public function _offset($offset) {
        $this->offset = intval($offset); // Ensure it's an integer
        return $this;
    }

    // Metode untuk mengatur order by
    public function _orderBy($orderBy, $orderDirection = 'ASC') {
        $this->orderBy = $orderBy;
        $this->orderDirection = strtoupper($orderDirection); // Ensure it's uppercase
        return $this;
    }

    // Metode untuk menjalankan query SELECT
    public function _get() {
        if (empty($this->table)) {
            throw new Exception('Nama tabel belum diatur. Gunakan table() di model Anda.');
        }
        try {
            $sql = "SELECT {$this->select} FROM {$this->table}";

            // Build WHERE clause
            if (!empty($this->where)) {
                $conditions = [];
                foreach ($this->where as $condition) {
                    $conditions[] = "{$condition[0]} {$condition[1]} :{$condition[0]}";
                }
                $sql .= " WHERE " . implode(' AND ', $conditions);
            }

            // Build ORDER BY clause
            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy} {$this->orderDirection}";
            }

            // Build LIMIT and OFFSET clause
            if ($this->limit) {
                $sql .= " LIMIT ";
                if ($this->offset) {
                    $sql .= "{$this->offset}, ";
                }
                $sql .= "{$this->limit}";
            }
            
            $stmt = $this->db->prepare($sql);

            // Bind parameters for WHERE clause
            if (!empty($this->where)) {
                foreach ($this->where as $condition) {
                    $stmt->bindValue(":{$condition[0]}", $condition[2]);
                }
            }
            $stmt->execute();
            $this->_resetQueryBuilder(); // Reset setelah query dieksekusi
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error _get di BaseModel: " . $e->getMessage());
            $this->_resetQueryBuilder();
            return false;
        }
    }

    // Metode untuk reset query builder
    private function _resetQueryBuilder() {
        $this->table = null;
        $this->select = '*';
        $this->where = [];
        $this->limit = null;
        $this->offset = null;
        $this->orderBy = null;
        $this->orderDirection = 'ASC';
    }

    public function _insert($data) {
        if (empty($this->table)) {
            throw new Exception('Nama tabel belum diatur. Gunakan table() di model Anda.');
        }
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $query = $this->db->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
            foreach ($data as $key => $value) {
                $query->bindValue(":$key", $value);
            }
            $query->execute();
            $this->_resetQueryBuilder();
            return $this->db->lastInsertId();
        }  catch (PDOException $e) {
            error_log("Error insert: " . $e->getMessage());
            $this->_resetQueryBuilder();
            return false;
        }
    }

    public function _update($id, $data) {
        if (empty($this->table)) {
            throw new Exception('Nama tabel belum diatur. Gunakan table() di model Anda.');
        }
        try {
            $setClauses = [];
            foreach ($data as $key => $value) {
                if ($key != 'id') { 
                    $setClauses[] = "$key = :$key";
                }
            }
            $setClause = implode(', ', $setClauses);
            $query = $this->db->prepare("UPDATE {$this->table} SET $setClause WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            foreach ($data as $key => $value) {
                $query->bindValue(":$key", $value);
            }
            $query->execute();
            $this->_resetQueryBuilder();
            return true;
        } catch (PDOException $e) {
            error_log("Error update: " . $e->getMessage());
            $this->_resetQueryBuilder();
            return false;
        }
    }

    public function _delete($column, $value) {
        if (empty($this->table)) {
            throw new Exception('Nama tabel belum diatur. Gunakan table() di model Anda.');
        }
        try {
            $query = $this->db->prepare("DELETE FROM {$this->table} WHERE $column = :value");
            $query->bindParam(':value', $value);
            $query->execute();
            $this->_resetQueryBuilder();
            return true;
        }  catch (PDOException $e) {
            error_log("Error delete: " . $e->getMessage());
            $this->_resetQueryBuilder();
            return false;
        }
    }




}