<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Warning extends AppModel {

    public function insert($data) {

        //todos ou direcionado
        $public = null;
        $serie = '';
        if ($data['public'] == 'PUBLIC') {
            $public = 'ACTIVE';
        } else {
            $public = 'INACTIVE';
            $serie = $data['public'];
        }

        $sql = "INSERT INTO warnings ("
                . "`school_id`,"
                . " `date`,"
                . "`description`,"
                . "`public`,"
                . "`to_serie`,"
                . "`to_students`,"
                . "`looked`"
                . ")" .
                "VALUES ("
                . "{$data['school_id']}, "
                . "'{$this->formataData2($data['date'])}',"
                . "'{$data['description']}',"
                . "'{$public}',"
                . "'{$serie}',"
                . "'',"
                . "0"
                . ");";

        $this->query($sql);

        //capturando registro que acabou de ser inserido
        $sqlSelectWarning = "SELECT * FROM warnings where school_id = 1 ORDER BY id DESC LIMIT 1;";
        $warningReturn = $this->query($sqlSelectWarning);

        //alunos que receberâo esse aviso
        //selecionamos todos para criar o students_warnings
        $sqlSelectStudents = "select students.id from students inner join series on series.id = students.cod_serie where series.description = '{$warningReturn[0]['warnings']['to_serie']}';";
        $studentsId = $this->query($sqlSelectStudents);

        //criando registros no students_warnings
        foreach ($studentsId as $id) {

            $sqlInsertSW = "INSERT INTO students_warnings ("
                    . "`student_id`,"
                    . "`warning_id`)"
                    . "VALUES ("
                    . "{$id['students']['id']},"
                    . "{$warningReturn[0]['warnings']['id']});";

            $this->query($sqlInsertSW);
        }

        return $studentsId;
    }

    public function selectAll($schoolId) {

        $sql = "SELECT * FROM warnings where school_id = {$schoolId};";

        return $this->query($sql);
    }

    public function remove($data) {

        $sql = "DELETE FROM warnings WHERE id = {$data['id']}";

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

    public function getByStudents($data) {

        $warningArray = '';
        $sts = array_slice($data, 0, count($data) - 1);


        foreach ($sts as $student) {
            //$sql = "SELECT * FROM warnings where to_serie = '{$student['series']['description']}';";
            $sql = "select * from warnings inner join students_warnings on students_warnings.warning_id = warnings.id where warnings.to_serie = '{$student['series']['description']}' and students_warnings.student_id = {$student['students']['id']};";
            $retorno = $this->query($sql);

            $warningArray[$student['students']['id']] = $retorno;
        }

        $selectAll = "SELECT * FROM warnings where public = 'ACTIVE'";
        $retorno = $this->query($selectAll);
        $warningArray[0] = $retorno;

        return $warningArray;
    }

    public function visualizedMsg($data) {

        $sqlBySerie = "select count(*) total from students where cod_serie = {$data['series_id']}";
        $retorno = $this->query($sqlBySerie);
        $total = $retorno[0][0]['total'];

        $result = 1 / $total;
        $result2 = $result * 100;
        $result3 = number_format($result2, 2);


        $sqlSelect = "select looked from warnings where id = {$data['warning_id']};";
        $select = $this->query($sqlSelect);

        $finalResult = $select[0]['warnings']['looked'] + $result3;

        $sql = "UPDATE warnings SET `looked`={$finalResult} WHERE id={$data['warning_id']};";
        $this->query($sql);
    }

    public function aware($data) {

        $sql = "UPDATE students_warnings SET"
                . " status='READ'"
                . "WHERE student_id = {$data['students']['id']} and warning_id = {$data['warnings']['id']};";

        $this->query($sql);
    }

}
