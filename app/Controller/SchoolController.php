<?php

App::uses('AppController', 'Controller');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SchoolController
 *
 * @author user
 */
class SchoolController extends AppController {

    private $contextMenuItems = array(
        array('title' => 'Videos', 'url' => array('action' => '../movies/listVideos'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array())
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('contextMenuItems', $this->contextMenuItems);
    }

    public function home() {

        $school = $this->Session->read('loggedSchool');
        $this->loadModel('Student');
        $this->loadModel('School');

        $data['id'] = $school['schools']['id'];
        $news = $this->Student->getNews($data);
        $statistics = $this->School->homeStatistics($data['id']);
        $this->set(compact('news', 'statistics'));


        $this->layout = 'school_header';
    }

    /**
     * Listagem dos avisos
     */
    public function avisos() {

        $this->loadModel('Warning');
        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $return = $this->Warning->remove($data);
        }

        $warnings = $this->Warning->selectAll($school['schools']['id']);
        $this->set(compact('warnings'));

        $this->layout = 'school_header';
    }

    /**
     * Listagem dos eventos futuros agendados 
     */
    public function agenda() {

        $this->loadModel('DailySchedule');
        $this->loadModel('Note');
        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $return = $this->DailySchedule->remove($data);
        }

        $schedules = $this->DailySchedule->selectAll($school['schools']['id']);

        //verifica se login é ADM ou PROFESSOR
        if ($school['logged'] == 'adm') {

            $date['school_id'] = $school['schools']['id'];
            $date['note_to'] = 'adm';
        } else {
            $date['school_id'] = $school['schools']['id'];
            $date['note_to'] = $school['teachers']['name'];
        }

        $notes = $this->Note->selectBy($date);

        $this->set(compact('schedules', 'notes'));
        $this->layout = 'school_header';
    }

    /**
     * Listagem dos eventos
     */
    public function eventos() {

        $this->loadModel('Events');
        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $return = $this->Events->remove($data);
        }

        $events = $this->Events->selectAll($school['schools']['id']);
        $this->set(compact('events'));
        $this->layout = 'school_header';
    }

    /**
     * Listagem dos alunos
     */
    public function alunos() {

        $this->loadModel('Student');
        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $return = $this->Student->remove($data);
        }

        $students = $this->Student->selectAll($school['schools']['id']);

        $this->set(compact('students'));
        $this->layout = 'school_header';
    }

    /**
     * Cadastro de novo aviso
     */
    public function cadastraAviso() {

        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $this->loadModel('Warning');

            $data = $this->request->data;
            $data['school_id'] = $school['schools']['id'];

            $return = $this->Warning->insert($data);
        }

        $this->loadModel('Serie');
        $series = $this->Serie->selectAll($school['schools']['id']);

        $this->set(compact('series'));

        $this->layout = 'school_header';
    }

    /**
     * Cadastra Série e professor
     */
    public function cadastraSerie() {

        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $this->loadModel('Serie');

            $data = $this->request->data;
            $data['school_id'] = $school['schools']['id'];
            $return = $this->Serie->insert($data);
        }


        $this->loadModel('Teacher');
        $teachers = $this->Teacher->selectAll($school['schools']['id']);

        $this->set(compact('teachers'));
        $this->layout = 'school_header';
    }

    /**
     * Cadastra Aluno e seus responsáveis 
     */
    public function cadastraAluno() {

        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $this->loadModel('Student');

            $data = $this->request->data;
            $data['school_id'] = $school['schools']['id'];
            $return = $this->Student->insert($data);
        }

        $this->loadModel('Serie');
        $series = $this->Serie->selectAll($school['schools']['id']);

        $this->set(compact('series'));
        $this->layout = 'school_header';
    }

    /**
     * Configura infos da Escola usuária
     */
    public function configuraEscola() {

        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $this->loadModel('School');

            $data = $this->request->data;
            $data['id'] = $school['schools']['id'];
            $data['old_photo'] = $school['schools']['photo'];

            $return = $this->School->update($data);

            $return[0]['schools']['login_pass'] = $data['password'];
            $this->Session->write('loggedSchool', $return[0]);
        }

        $this->set(compact('school'));
        $this->layout = 'school_header';
    }

    /**
     * Lista de Professores cadastrados 
     */
    public function professores() {

        $this->loadModel('Teacher');
        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $return = $this->Teacher->remove($data);
        }

        $teachers = $this->Teacher->selectAll($school['schools']['id']);

        $this->set(compact('teachers'));
        $this->layout = 'school_header';
    }

    /**
     * Lista de séries cadastradas
     */
    public function series() {

        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $return = $this->Serie->remove($data);
        }

        $this->loadModel('Serie');

        $series = $this->Serie->selectAll($school['schools']['id']);

        $this->set(compact('series'));
        $this->layout = 'school_header';
    }

    public function booteste() {
        $this->layout = 'school';
    }

    public function login() {

        $loginError = false;
        if ($this->request->is('post')) {

            $this->loadModel('School');

            $data = $this->request->data;
            $return = $this->School->login($data);

            if ($return['status'] == 'ok') {

                //ESCOLA LOGIN
                if ($return['logged'] === 'adm') {

                    $return[0]['schools']['login_pass'] = $data['password'];

                    $this->loadModel('Note');
                    $notes = $this->Note->selectAll($return[0]['schools']['id']);
                    $return[0]['notes'] = $notes;
                    $return[0]['logged'] = $return['logged'];

                    $this->Session->write('loggedSchool', $return[0]);

                    $this->redirect("home");

                    //PROFESSOR
                } else {

                    $return[0]['schools']['login_pass'] = $data['password'];
                    $this->loadModel('Note');
                    $notes = $this->Note->selectAllByTeacher($return[0]['teachers']['name']);
                    $return[0]['notes'] = $notes;
                    $return[0]['logged'] = $return['logged'];
                    $this->Session->write('loggedSchool', $return[0]);

                    $this->redirect("home");
                }
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

    /**
     * Evento
     */
    public function cadastraEvento() {

        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $this->loadModel('Events');

            $data = $this->request->data;
            $data['school_id'] = $school['schools']['id'];

            $return = $this->Events->insert($data);
        }

        $this->loadModel('Serie');

        $series = $this->Serie->selectAll($school['schools']['id']);

        $this->set(compact('series'));
        $this->layout = 'school_header';
    }

    public function cadastraAgenda() {

        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $this->loadModel('DailySchedule');

            $data = $this->request->data;
            $data['school_id'] = $school['schools']['id'];

            $return = $this->DailySchedule->insert($data);
        }

        $this->loadModel('Serie');

        $series = $this->Serie->selectAll($school['schools']['id']);

        $this->set(compact('series'));
        $this->layout = 'school_header';
    }

    public function cadastraProfessor() {

        $school = $this->Session->read('loggedSchool');

        if ($this->request->is('post')) {

            $this->loadModel('Teacher');

            $data = $this->request->data;
            $data['school_id'] = $school['schools']['id'];

            $return = $this->Teacher->insert($data);
        }

        $this->layout = 'school_header';
    }

    public function cadastraGrade() {

        if ($this->request->is('post')) {
            //capturando aulas e horarios
            //7h
            $seteHrs = array(
                $this->request->data['7hseg'],
                $this->request->data['7hter'],
                $this->request->data['7hqua'],
                $this->request->data['7hqui'],
                $this->request->data['7hsex'],
            );

            //8h
            $oitoHrs = array(
                $this->request->data['8hseg'],
                $this->request->data['8hter'],
                $this->request->data['8hqua'],
                $this->request->data['8hqui'],
                $this->request->data['8hsex'],
            );

            //9h
            $noveHrs = array(
                $this->request->data['9hseg'],
                $this->request->data['9hter'],
                $this->request->data['9hqua'],
                $this->request->data['9hqui'],
                $this->request->data['9hsex'],
            );

            //9:15h
            $noveQuinzeHrs = array(
                $this->request->data['915hseg'],
                $this->request->data['915hter'],
                $this->request->data['915hqua'],
                $this->request->data['915hqui'],
                $this->request->data['915hsex'],
            );

            //10:15h
            $dezQuinzeHrs = array(
                $this->request->data['1015hseg'],
                $this->request->data['1015hter'],
                $this->request->data['1015hqua'],
                $this->request->data['1015hqui'],
                $this->request->data['1015hsex'],
            );

            //11:15h
            $onzeQuinzeHrs = array(
                $this->request->data['1115hseg'],
                $this->request->data['1115hter'],
                $this->request->data['1115hqua'],
                $this->request->data['1115hqui'],
                $this->request->data['1115hsex'],
            );

            //12h
            $dozeHrs = array(
                $this->request->data['12hseg'],
                $this->request->data['12hter'],
                $this->request->data['12hqua'],
                $this->request->data['12hqui'],
                $this->request->data['12hsex'],
            );

            //14h
            $quatorzeHrs = array(
                $this->request->data['14hseg'],
                $this->request->data['14hter'],
                $this->request->data['14hqua'],
                $this->request->data['14hqui'],
                $this->request->data['14hsex'],
            );

            //15h
            $quinzeHrs = array(
                $this->request->data['15hseg'],
                $this->request->data['15hter'],
                $this->request->data['15hqua'],
                $this->request->data['15hqui'],
                $this->request->data['15hsex'],
            );

            //16h
            $dezeseisHrs = array(
                $this->request->data['16hseg'],
                $this->request->data['16hter'],
                $this->request->data['16hqua'],
                $this->request->data['16hqui'],
                $this->request->data['16hsex'],
            );

            $seven = implode(",", $seteHrs);
            $eight = implode(",", $oitoHrs);
            $nine = implode(",", $noveHrs);
            $quarterPastNine = implode(",", $noveQuinzeHrs);
            $quarterPastTen = implode(",", $dezQuinzeHrs);
            $quarterPastEleven = implode(",", $onzeQuinzeHrs);
            $twelve = implode(",", $dozeHrs);
            $fourteen = implode(",", $quatorzeHrs);
            $fifteen = implode(",", $quinzeHrs);
            $sixteen = implode(",", $dezeseisHrs);

            $dados['serie'] = $this->request->data['serie'];
            $dados['seven'] = $seven;
            $dados['eight'] = $eight;
            $dados['nine'] = $nine;
            $dados['quarter_past_nine'] = $quarterPastNine;
            $dados['quarter_past_ten'] = $quarterPastTen;
            $dados['quarter_past_eleven'] = $quarterPastEleven;
            $dados['twelve'] = $twelve;
            $dados['fourteen'] = $fourteen;
            $dados['fifteen'] = $fifteen;
            $dados['sixteen'] = $sixteen;

            $this->loadModel('Grid');
            $series = $this->Grid->insert($dados);
        }

        $school = $this->Session->read('loggedSchool');

        $this->loadModel('Serie');
        $series = $this->Serie->selectAll($school['schools']['id']);
        $this->set(compact('series'));

        $this->layout = 'school_header';
    }

    public function notes() {

        $school = $this->Session->read('loggedSchool');
        $this->loadModel('Note');

        if ($this->request->is('post')) {
            $this->Note->readNote($this->request->data);
        }

        //verifica se login é ADM ou PROFESSOR
        if ($school['logged'] == 'adm') {
            $data['school_id'] = $school['schools']['id'];
            $data['note_to'] = 'adm';
        } else {
            $data['school_id'] = $school['schools']['id'];
            $data['note_to'] = $school['teachers']['name'];
        }

        $notes = $this->Note->selectBy($data);
        $this->set(compact('notes'));
        $this->layout = 'school_header';
    }

    public function configuraProfessor() {
        $this->layout = 'school_header';
    }

    public function answerNote(){
        
        if ($this->request->is('post')) {
            
        }
    }
    
}
