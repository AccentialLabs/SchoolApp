<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DailySchedule extends AppModel {

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

        $sql = "INSERT INTO daily_schedules (`school_id`, "
                . "`date`, "
                . "`description`,"
                . " `public`,"
                . " `to_serie`,"
                . " `looked`)" .
                "VALUES ("
                . "{$data['school_id']}, "
                . "'{$this->formataData2($data['date'])}',"
                . "'{$data['description']}',"
                . "'{$public}',"
                . "'{$serie}',"
                . "0);";

        return $this->query($sql);
    }

    public function selectAll($schoolId) {

        $sql = "SELECT * FROM daily_schedules where school_id = {$schoolId};";

        $data = $this->query($sql);

        return $data;
    }

    public function remove($data) {

        $sql = "DELETE FROM daily_schedules WHERE id = {$data['id']}";

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

    public function formataDataToExhibition($dataH) {
        $data = explode('-', $dataH);
        if (!empty($data[1])) {
            return $data[1] . '/' . $data[2] . '/' . $data[0];
        } else {
            return 'ERRO - CONVERT DATA';
        }
    }

    public function getByStudents($data) {

        $eventsArray = '';
        $sts = array_slice($data, 0, count($data) - 1);

        foreach ($sts as $student) {
            $sql = "SELECT * FROM daily_schedules where to_serie = '{$student['series']['description']}';";
            $retorno = $this->query($sql);

            $eventsArray[$student['students']['id']] = $retorno;
        }

        $selectAll = "SELECT * FROM daily_schedules where public = 'ACTIVE'";
        $retorno = $this->query($selectAll);
        $eventsArray[0] = $retorno;

        return $eventsArray;
    }
    
     public function visualizedMsg($data) {

        $sqlBySerie = "select count(*) total from daily_schedules where cod_serie = {$data['series_id']}";
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

}
