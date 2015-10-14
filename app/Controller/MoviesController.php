<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AppController', 'Controller');

/**
 * Description of MoviesController
 *
 * @author user
 */
class MoviesController extends AppController {

    //put your code here

    private $contextMenuItems = array(
        //array('title' => 'Configurações Gerais', 'url' => array('action' => 'general'), 'attr' => array()),
        array('title' => 'Menu 1', 'url' => array('action' => 'comissions'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array()),
        array('title' => 'Menu 2', 'url' => array('action' => 'methods'), 'attr' => array())
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('contextMenuItems', $this->contextMenuItems);
    }

    public function listVideos() {
        $this->layout = '';
    }
}
