<?php
    require_once("t_config.php");

    class Database extends Config {

        public function fetch($id = 0) {
            $sql = "SELECT * FROM teacher";
            if ($id != 0) {
                $sql .= " WHERE id = :id";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["id" => $id]);
            $rows = $stmt->fetchAll();
            return $rows;
        }

        public function insert($t_fullname, $t_phone) {
            $sql = "INSERT INTO teacher(t_fullname, t_phone) VALUES(:t_fullname, :t_phone)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["t_fullname" => $t_fullname, "t_phone" => $t_phone]);
            return true;
        }

        public function update($t_fullname, $t_phone, $id) {
            $sql = "UPDATE teacher SET t_fullname = :t_fullname, t_phone = :t_phone WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["t_fullname" => $t_fullname, "t_phone" => $t_phone, "id" => $id]);
            return true;
        }
    }
?>