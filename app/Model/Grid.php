<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grid
 *
 * @author user
 */
class Grid extends AppModel {

    public function insert($data) {
        $sql = "INSERT INTO grids ("
                . "`serie_id`,"
                . "`seven`,"
                . "`eight`,"
                . "`nine`,"
                . "`quarter_past_nine`,"
                . "`quarter_past_ten`,"
                . "`quarter_past_eleven`,"
                . "`twelve`,"
                . "`fourteen`,"
                . "`fifteen`,"
                . "`sixteen`)" .
                "VALUES ("
                . "{$data['serie']},"
                . "'{$data['seven']}',"
                . "'{$data['eight']}',"
                . "'{$data['nine']}',"
                . "'{$data['quarter_past_nine']}',"
                . "'{$data['quarter_past_ten']}',"
                . "'{$data['quarter_past_eleven']}',"
                . "'{$data['twelve']}',"
                . "'{$data['fourteen']}',"
                . "'{$data['fifteen']}',"
                . "'{$data['sixteen']}');";

        return $this->query($sql);
    }

    public function selectAll($serieId) {

        $sql = "SELECT * FROM grids where serie_id = {$serieId};";

        return $this->query($sql);
    }

    public function remove($data) {

        $sql = "DELETE FROM grids WHERE id = {$data['id']}";

        return $this->query($sql);
    }

}
