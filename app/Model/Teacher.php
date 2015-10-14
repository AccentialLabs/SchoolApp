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
class Teacher extends AppModel {

    public function insert($data) {

        $password = md5($data['password']);

        $uploaddir = "../img/school/teachers/" . basename($_FILES['photo']['name']);
        $uploadFile = WWW_ROOT . 'img/school/teachers' . DS . basename($_FILES['photo']['name']);

        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile);

        $sql = "INSERT INTO teachers ("
                . "`school_id`,"
                . "`name`,"
                . "`email`,"
                . "`phone`,"
                . "`password`,"
                . "`photo`)" .
                "VALUES ("
                . "{$data['school_id']},"
                . "'{$data['name']}',"
                . "'{$data['email']}',"
                . "'{$data['phone']}',"
                . "'{$password}',"
                . "'{$uploaddir}');";

        return $this->query($sql);
    }

    public function selectAll($schoolId) {

        $sql = "SELECT * FROM teachers where school_id = {$schoolId};";

        return $this->query($sql);
    }

    public function remove($data) {

        $sql = "DELETE FROM teachers WHERE id = {$data['id']}";

        return $this->query($sql);
    }

}
