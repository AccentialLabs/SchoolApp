<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Note
 *
 * @author user
 */
class Note extends AppModel {

    public function insert($data) {

        $noteTo = '';
        if ($data['apont_to'] == 'specific_teacher') {
            $noteTo = $data['teacher'];
        } else {
            $noteTo = $data['apont_to'];
        }

        $sql = "INSERT INTO notes ("
                . "`student_id`,"
                . "`note_to`,"
                . "`description`,"
                . "`date`,"
                . "`status`,"
                . "`school_id`)" .
                "VALUES ("
                . "'{$data['id']}',"
                . "'{$noteTo}',"
                . "'{$data['description']}',"
                . "'{$data['date']}',"
                . "'WAIT',"
                . "{$data['school_id']});";

        return $this->query($sql);
    }

    public function selectAll($schoolId) {

        $sql = "SELECT * FROM notes where school_id = {$schoolId} and status = 'WAIT' and note_to = 'adm';";

        return $this->query($sql);
    }

    public function selectAllByTeacher($teacher) {

        $sql = "SELECT * FROM notes where status = 'WAIT' and note_to = '{$teacher}';";

        return $this->query($sql);
    }

    public function selectBy($data) {

        $sql = "select * from notes inner join students on students.id = notes.student_id inner join series on series.id = students.cod_serie where notes.school_id = {$data['school_id']} and notes.note_to = '{$data['note_to']}';";

        return $this->query($sql);
    }

    public function readNote($data) {

        $sql = "UPDATE notes SET `status`='READ' WHERE id={$data['id']};";

        return $this->query($sql);
    }

    public function formataData2($dataH) {
        $data = explode('/', $dataH);
        if (!empty($data[1])) {
            return $data[2] . '-' . $data[0] . '-' . $data[1];
        } else {
            return 'ERRO - CONVERT DATA';
        }
    }

}
