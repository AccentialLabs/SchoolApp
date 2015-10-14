<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Events extends AppModel {

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

        $sql = "INSERT INTO events (`school_id`, "
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

        $sql = "SELECT * FROM events where school_id = {$schoolId};";

        $data = $this->query($sql);

        return $data;
    }

    public function remove($data) {

        $sql = "DELETE FROM events WHERE id = {$data['id']}";

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
            $sql = "SELECT * FROM events where to_serie = '{$student['series']['description']}';";
            $retorno = $this->query($sql);

            $eventsArray[$student['students']['id']] = $retorno;
        }

        $selectAll = "SELECT * FROM events where public = 'ACTIVE'";
        $retorno = $this->query($selectAll);
        $eventsArray[0] = $retorno;

        return $eventsArray;
    }

}
