<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of School
 *
 * @author user
 */
class Serie extends AppModel {
    
    public function insert($data) {
        $sql = "INSERT INTO series ("
                . "`description`,"
                . "`teachers`,"
                . "`school_id`,"
                . "`students_qtd`)" .
                "VALUES ("
                . "'{$data['description']}',"
                . "'{$data['teachers']}',"
                . "{$data['school_id']},"
                . "{$data['students_qtd']});";

        return $this->query($sql);
    }

    public function selectAll($schoolId) {

        $sql = "SELECT * FROM series where school_id = {$schoolId};";

        return $this->query($sql);
    }

    public function remove($data) {

        $sql = "DELETE FROM series WHERE id = {$data['id']}";

        return $this->query($sql);
    }

}
