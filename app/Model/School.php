<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('Model', 'Note');

/**
 * Description of School
 *
 * @author user
 */
class School extends AppModel {

//put your code here

    public function insert($data) {

        $pass = md5($data['password']);

        $sql = "INSERT INTO schools ("
                . "`name`,"
                . "`address`,"
                . "`phone`, "
                . "`email`,"
                . "`responsible_name`,"
                . "`responsible_email`,"
                . "`admin_email`,"
                . "`admin_name`,"
                . "`password`,"
                . "`photo`)" .
                "VALUES ("
                . "'{$data['name']}',"
                . "'{$data['address']}',"
                . "'{$data['phone']}',"
                . "'{$data['email']}',"
                . "'{$data['responsible_name']}',"
                . "'{$data['responsible_email']}',"
                . "'{$data['admin_email']}',"
                . "'{$data['admin_name']}',"
                . "'{$pass}',"
                . "'{$data['photo']}');";

        return $this->query($sql);
    }

    public function login($data) {

        $pass = md5($data['password']);
        $sql = "select * from schools where admin_email = '{$data['email']}' and password = '{$pass}';";
        $retorno = $this->query($sql);

        if ($retorno) {
            $retorno['status'] = 'ok';
             $retorno['logged'] = 'adm';
        } else {
            
            $pass = md5($data['password']);
            $sql = "select * from teachers inner join schools on schools.id = teachers.school_id where teachers.email = '{$data['email']}' and teachers.password = '{$pass}';";
            $retorno = $this->query($sql);

            if ($retorno) {
                $retorno['status'] = 'ok';
                $retorno['logged'] = 'teacher';
                $retorno[0]['teachers']['status'] = 'ok';
            } else {
                $retorno['status'] = 'error';
                $retorno[0]['teachers']['status'] = 'error';
            }
        }

        return $retorno;
    }

    public function update($data) {

        $pass = md5($data['password']);

        /**
         * Lógica UPLOAD foto
         */
        if ($_FILES['photo']['name'] != '') {
            $uploaddir = "../img/school/logo/" . basename($_FILES['photo']['name']);
            $uploadFile = WWW_ROOT . 'img/school/logo' . DS . basename($_FILES['photo']['name']);

            move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile);


            $sqlupdate = "UPDATE schools SET"
                    . " name='{$data['name']}',"
                    . "address = '{$data['address']}',"
                    . "phone = '{$data['phone']}',"
                    . "phone_2 = '{$data['phone_2']}',"
                    . "email = '{$data['email']}',"
                    . "responsible_name = '{$data['responsible_name']}',"
                    . "responsible_email = '{$data['responsible_email']}',"
                    . "admin_name = '{$data['admin_name']}',"
                    . "admin_email = '{$data['admin_email']}',"
                    . "password = '{$pass}',"
                    . "photo = '{$uploaddir}' "
                    . "WHERE id = {$data['id']};";
        } else {

            $sqlupdate = "UPDATE schools SET"
                    . " name='{$data['name']}',"
                    . "address = '{$data['address']}',"
                    . "phone = '{$data['phone']}',"
                    . "phone_2 = '{$data['phone_2']}',"
                    . "email = '{$data['email']}',"
                    . "responsible_name = '{$data['responsible_name']}',"
                    . "responsible_email = '{$data['responsible_email']}',"
                    . "admin_name = '{$data['admin_name']}',"
                    . "admin_email = '{$data['admin_email']}',"
                    . "password = '{$pass}',"
                    . "photo = '{$data['old_photo']}' "
                    . "WHERE id = {$data['id']};";
        }

        $this->query($sqlupdate);


        $sql = "select * from schools where id = {$data['id']};";

        return $this->query($sql);
    }

    public function homeStatistics($schoolId) {

        $sqlWarnings = "select * from warnings where school_id = {$schoolId}";
        $sqlSchedules = "select * from daily_schedules where school_id = {$schoolId}";
        $sqlEvents = "select * from events where school_id = {$schoolId}";

        $warnings = $this->query($sqlWarnings);
        $schedules = $this->query($sqlSchedules);
        $events = $this->query($sqlEvents);



        //warnings
        $totalWarnings = 0;
        $lookedWarnings = "";
        foreach ($warnings as $warning) {
            if ($warning['warnings']['looked'] != 0) {
                $lookedWarnings++;
            }
            $totalWarnings++;
        }

        //schedules
        $totalSchedules = 0;
        $lookedSchedules = 0;
        foreach ($schedules as $schedule) {
            if ($schedule['daily_schedules']['looked'] != 0) {
                $lookedSchedules++;
            }
            $totalSchedules++;
        }

        //events
        $totalEvents = 0;
        $lookedEvents = 0;
        foreach ($events as $event) {
            if ($event['events']['looked'] != 0) {
                $lookedEvents++;
            }
            $totalEvents++;
        }

        //warnings
        $statistics['warnings']['looked'] = $lookedWarnings;
        $statistics['warnings']['waiting'] = $totalWarnings - $lookedWarnings;
        //schedules
        $statistics['daily_schedules']['looked'] = $lookedSchedules;
        $statistics['daily_schedules']['waiting'] = $totalSchedules - $lookedSchedules;
        //events
        $statistics['events']['looked'] = $lookedEvents;
        $statistics['events']['waiting'] = $totalEvents - $lookedEvents;

        return $statistics;
    }

}
