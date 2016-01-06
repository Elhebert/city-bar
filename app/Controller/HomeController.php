<?php

    class HomeController extends AppController{

        public $layout = 'barLayout';

        public $helpers = array('GoogleMap');

        public function beforeFilter(){
            parent::beforeFilter();
            $this->Auth->allow('index', 'about', 'contact');
        }

        public function index(){
        }

        public function about(){
        }

        /**
        * Envoie un mail de contact
        **/
        public function contact(){
            if($this->request->is('post')){
                HomeController::loadModel('Contact');
                if(!empty($this->request->data['Contact']['website'])){
                    $this->Session->setFlash('Merci pour votre message', 'flash');
                    $this->request->data = array();
                }else{
                    if($this->Contact->sendMail($this->request->data['Contact'])){
                        $this->Session->setFlash('Merci pour votre message', 'flash');
                        $this->request->data = array();
                    }else{
                        $this->Session->setFlash('Oups, quelque chose s\'est mal passé', 'flash', array('class' => 'danger'));
                    }
                }
            }
        }
    }