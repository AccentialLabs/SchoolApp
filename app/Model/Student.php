<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Student
 *
 * @author user
 */
class Student extends AppModel {

    //put your code here
    //put your code here

    public $useTable = false;
    public $displayField = 'name';
    public $validate = array();

    public function insert($data) {

        $uploaddir = "../img/school/students/" . basename($_FILES['photo']['name']);
        $uploadFile = WWW_ROOT . 'img/school/students' . DS . basename($_FILES['photo']['name']);

        $pass = $this->generateRandomPassword();
        $password = md5($pass);

        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile);

        $sql = "INSERT INTO students (`name`,"
                . "`cod_serie`,"
                . "`responsible_name_1`,"
                . "`responsible_email_1`,"
                . "`responsible_name_2`,"
                . "`responsible_email_2`,"
                . "`gender`,"
                . "`birthday`,"
                . "`photo`,"
                . "`school_id`,"
                . "`password`) "
                . "VALUES("
                . "'{$data['name']}',"
                . "{$data['serie']},"
                . "'{$data['responsible_name_1']}',"
                . "'{$data['responsible_email_1']}',"
                . "'{$data['responsible_name_2']}',"
                . "'{$data['responsible_email_2']}',"
                . "'{$data['gender']}',"
                . "'essaeurldafoto',"
                . "'{$uploaddir}',"
                . "{$data['school_id']},"
                . "'{$password}');";

        return $this->query($sql);
    }

    public function selectAll($schoolId) {

        $sql = "select * from students inner join series on students.cod_serie = series.id where students.school_id = {$schoolId};";

        return $this->query($sql);
    }

    public function remove($data) {

        $sql = "DELETE FROM students WHERE id = {$data['id']};";

        return $this->query($sql);
    }

    /**
     * Auto-descritivo
     * @return type
     */
    private function generateRandomPassword() {
        $alphabet = "23456789bcdefghijklmnopqrstuwxyzBCDEFGHIJKLMNOPQRSTUWXYZ";
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i ++) {
            $n = rand(0, $alphaLength);
            $pass [] = $alphabet [$n];
        }
        return implode($pass);
    }

    /**
     * STUDENT PORTAL
     */
    public function login($data) {
        /**
         * Tenta primeiro Responsável 1
         */
        $pass = md5($data['password']);
        $sql = "select * from students inner join schools on students.school_id = schools.id inner join series on students.cod_serie = series.id   where students.responsible_email_1 = '{$data['email']}' and students.password = '{$pass}';";
        $retorno = $this->query($sql);

        if (!empty($retorno)) {
            $retorno['status'] = 'ok';
        } else {
            /**
             * Tentando Responsável 2
             */
            $pass = md5($data['password']);
            $sql = "select * from students inner join schools on students.school_id = schools.id inner join series on students.cod_serie = series.id   where students.responsible_email_1 = '{$data['email']}' and students.password = '{$pass}';";
            $retorno = $this->query($sql);

            if ($retorno) {
                $retorno['status'] = 'ok';
                $retorno[0]['students']['status'] = 'ok';
            } else {
                $retorno['status'] = 'error';
                $retorno[0]['students']['status'] = 'error';
            }
        }
        return $retorno;
    }

    /**
     * TELA CONFIGURAÇÕES - EDITAR USUÁRIOS RESPONSÁVEIS 
     * @param type $data
     * @return type
     */
    public function editResponsible($data) {

        $pass = md5($data['password']);
        $sql = "UPDATE students SET "
                . "responsible_name_1='{$data['responsible_name_1']}', "
                . "responsible_email_1='{$data['responsible_email_1']}', "
                . "responsible_name_2='{$data['responsible_name_2']}', "
                . "responsible_email_2='{$data['responsible_email_2']}', "
                . "password='{$pass}' "
                . "WHERE "
                . "id = {$data['id']};";
        $this->query($sql);

        $sql = "select * from students inner join schools on students.school_id = schools.id inner join series on students.cod_serie = series.id where students.id = {$data['id']};";
        return $this->query($sql);
    }

    public function getNews($data) {

        $sqlWarnings = "SELECT * FROM warnings WHERE public = 'ACTIVE' and school_id = {$data['id']} ORDER BY id DESC LIMIT 1;";
        $sqlSchedules = "SELECT * FROM daily_schedules WHERE public = 'ACTIVE' and school_id = {$data['id']} ORDER BY id DESC LIMIT 1;";
        $sqlEvents = "SELECT * FROM events WHERE public = 'ACTIVE' and school_id = {$data['id']} ORDER BY id DESC LIMIT 1;";

        $news = '';
        // 0 - AVISOS
        $news[0] = $this->query($sqlWarnings);
        // 1 - AGENDA
        $news[1] = $this->query($sqlSchedules);
        // 2 - EVENTOS
        $news[2] = $this->query($sqlEvents);

        return $news;
    }

    public function getResume($data) {

        $warningArray = '';
        $eventsArray = '';
        $schedulesArray = '';
        $sts = array_slice($data, 0, count($data) - 1);

        foreach ($sts as $student) {

            //avisos
            $sqlWarnings = "SELECT * FROM warnings WHERE to_serie = '{$student['series']['description']}' ORDER BY id DESC LIMIT 1;";
            $returnWarnings = $this->query($sqlWarnings);
            $warningArray[$student['students']['id']]['warnings'] = $returnWarnings;

            //agenda
            $sqlSchedules = "SELECT * FROM daily_schedules WHERE to_serie = '{$student['series']['description']}' ORDER BY id DESC LIMIT 1;";
            $returnSchedules = $this->query($sqlSchedules);
            $schedulesArray[$student['students']['id']]['daily_schedules'] = $returnSchedules;

            $sqlEvents = "SELECT * FROM events WHERE to_serie = '{$student['series']['description']}' ORDER BY id DESC LIMIT 1;";
            $returnEvents = $this->query($sqlEvents);
            $eventsArray[$student['students']['id']]['events'] = $returnEvents;
        }

        $resume['warnings'] = $warningArray;
        $resume['events'] = $eventsArray;
        $resume['diary_schedules'] = $schedulesArray;
        return $resume;
    }

}
