<?php
    require_once("pa_config.php");

    class Database extends Config {

        public function fetch($id = 0) {
            $sql = "SELECT * FROM parent";
            if ($id != 0) {
                $sql .= " WHERE id = :id";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["id" => $id]);
            $rows = $stmt->fetchAll();
            return $rows;
        }

        public function insert($pa_fullname, $pa_student, $pa_stat, $pa_phone) {
            $sql = "INSERT INTO parent(pa_fullname, pa_student, pa_stat, pa_phone) VALUES(:pa_fullname, :pa_student, :pa_stat, :pa_phone)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["pa_fullname" => $pa_fullname, "pa_student" => $pa_student, "pa_stat" => $pa_stat, "pa_phone" => $pa_phone]);
            return true;
        }

        public function update($pa_fullname, $pa_student, $pa_stat, $pa_phone, $id) {
            $sql = "UPDATE parent SET pa_fullname = :pa_fullname, pa_student = :pa_student, pa_stat = :pa_stat, pa_phone = :pa_phone WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["pa_fullname" => $pa_fullname, "pa_student" => $pa_student, "pa_stat" => $pa_stat, "pa_phone" => $pa_phone, "id" => $id]);
            return true;
        }
    }
?>