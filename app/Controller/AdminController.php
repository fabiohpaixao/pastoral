<?php

App::uses('AppController', 'Controller');

class AdminController extends AppController
{

    /**
     * Uses
     *
     * @var mixed
     */
    public $uses = null;

    /**
     * Index
     *
     * @return void
     */
    public function index()
    {   
        $this->loadModel('Usuario');
        $this->set('usuarios', ($this->Usuario->find('count') - 1));
    }
}
