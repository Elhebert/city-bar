<?php

    class RatingsController extends AppController{

        public function beforeFilter(){
            parent::beforeFilter();
            $this->Auth->allow('rate');
        }

        /**
        * Gere la notation d'un bar
        **/
        public function rate(){
            if(!empty($this->request->data)){
                $this->request->data['Rating']['user_id'] = $this->Auth->user("id") ? $this->Auth->user("id") : 0;
                $this->request->data['Rating']['bar_id'] = $this->request->data['bar_id'];
                $this->request->data['Rating']['rate'] = $this->request->data['star'];
                $this->Rating->create($this->request->data, true);
                $fields = array('user_id', 'bar_id', 'rate');

                if($this->Rating->save(null, true, $fields)){
                    $this->Session->setFlash('Merci pour votre note', 'flash', array('class' => 'success'));
                    $this->request->data = array();
                    return $this->redirect($this->referer());
                }else{
                    $this->Session->setFlash('Impossible d\'envoyer votre note', 'flash', array('class' => 'error'));
                }
            }
        }

        /**
        * Gere le Panel Admin
        **/
        public function admin_index(){
            if($this->Session->read('Auth.User.role') != 2){
                $this->redirect($this->referer());
            }

            $ratingList = $this->Rating->find('all', array(
                    'fields'    => array('Rating.rate', 'User.username', 'Bar.name', 'Rating.id'),
                    'order'     => array('Rating.id' => 'ASC'),
                    'contain'   => array('User', 'Bar')
                ));

            $this->set(compact('ratingList'));
        }
    }