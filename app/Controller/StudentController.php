<?php

App::uses('AppController', 'Controller');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StudentController extends AppController {

    public function home() {

        $student = $this->Session->read('loggedStudent');
        $this->loadModel('Student');

        $data['id'] = $student[0]['schools']['id'];
        $news = $this->Student->getNews($data);
        $resume = $this->Student->getResume($student);

        $this->set(compact('news', 'resume'));
        $this->layout = 'student_header';
    }

    public function cadastraApontamento() {

        $student = $this->Session->read('loggedStudent');

        if ($this->request->is("post")) {

            $this->loadModel('Note');

            $data = $this->request->data;
            $data['id'] = $student[0]['students']['id'];
            $data['school_id'] = $student[0]['schools']['id'];

            $this->Note->insert($data);
        }

        $this->loadModel('Serie');
        $this->loadModel('Teacher');

        $teachers = $this->Teacher->selectAll($student[0]['schools']['id']);
        $series = $this->Serie->selectAll($student[0]['schools']['id']);

        $this->set(compact('teachers', 'series'));
        $this->layout = 'student_header';
    }

    public function grade() {

        $this->loadModel('Grid');
        $student = $this->Session->read('loggedStudent');

        $grids = $this->Grid->selectAll($student[0]['students']['cod_serie']);

        //print_r($grids);

        $this->set(compact('grids'));
        $this->layout = 'student_header';
    }

    public function avisos() {

        $this->loadModel('Warning');
        $student = $this->Session->read('loggedStudent');

        if ($this->request->is("post")) {

            $data['warning_id'] = $this->request->data['id'];
            $data['series_id'] = $student[0]['series']['id'];
            $this->Warning->visualizedMsg($data);
        }

        $warnings = $this->Warning->getByStudents($student);

        $this->set(compact('warnings'));
        $this->layout = 'student_header';
    }

    public function awareWarning() {

        if ($this->request->is("post")) {

            $this->loadModel('Warning');
            $dados = '';
            $dados['students']['id'] = $this->request->data['student_id'];
            $dados['warnings']['id'] = $this->request->data['warning_id'];

            $this->Warning->aware($dados);
        }
    }

    public function configuraUsuario() {

        $student = $this->Session->read('loggedStudent');

        if ($this->request->is('post')) {

            $this->loadModel('Student');

            $editedUser = $this->Student->editResponsible($this->request->data);

            $editedUser[0]['students']['login_pass'] = $this->request->data['password'];
            $this->Session->write('loggedStudent', $editedUser);

            $this->redirect("configuraUsuario");
        }

        $this->set(compact('student'));
        $this->layout = 'student_header';
    }

    public function agenda() {

        $this->loadModel('DailySchedule');
        $student = $this->Session->read('loggedStudent');

        if ($this->request->is("post")) {
            
        }

        $schedules = $this->DailySchedule->getByStudents($student);
        $this->set(compact('schedules'));
        $this->layout = 'student_header';
    }

    public function eventos() {

        $this->loadModel('Events');
        $student = $this->Session->read('loggedStudent');

        if ($this->request->is("post")) {
            
        }

        $events = $this->Events->getByStudents($student);
        $this->set(compact('events'));
        $this->layout = 'student_header';
    }

    public function login() {

        $this->loadModel('Student');
        $loginError = false;

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $return = $this->Student->login($data);

            if ($return['status'] == 'ok') {

                $return[0]['students']['login_pass'] = $data['password'];
                $this->Session->write('loggedStudent', $return);

                $this->redirect("home");
            } else {
                $loginError = true;
            }
        }

        $this->set(compact('loginError'));
        $this->layout = '';
    }

    public function logout() {
        //$this->autoRender = false;
        $this->Session->destroy();
        // $this->Cookie->destroy();
        $this->redirect("login");
    }

    public function loginAndroid() {

        $this->layout = '';
    }

}
