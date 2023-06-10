<?php
    require_once("std_config.php");

    class Database extends Config {

        public function fetch($id = 0) {
            $sql = "SELECT * FROM student";
            if ($id != 0) {
                $sql .= " WHERE id = :id";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["id" => $id]);
            $rows = $stmt->fetchAll();
            return $rows;
        }

        public function insert($std_fullname, $std_id, $std_level, $std_class, $std_phone) {
            $sql = "INSERT INTO student(std_fullname, std_id, std_level, std_class, std_phone) VALUES(:std_fullname, :std_id, :std_level, :std_class, :std_phone)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["std_fullname" => $std_fullname, "std_id" => $std_id, "std_level" => $std_level, "std_class" => $std_class, "std_phone" => $std_phone]);
            return true;
        }

        public function update($std_fullname, $std_id, $std_level, $std_class, $std_phone, $id) {
            $sql = "UPDATE student SET std_fullname = :std_fullname, std_id = :std_id, std_level = :std_level, std_class = :std_class, std_phone = :std_phone WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["std_fullname" => $std_fullname, "std_id" => $std_id, "std_level" => $std_level, "std_class" => $std_class, "std_phone" => $std_phone, "id" => $id]);
            return true;
        }
    }
?>