<?php
    class Contact extends AppModel{

        public $useTable = false;

        public $validate = array(
            'name' => array(
                'rule' => 'notEmpty',
                'message' => 'Vous devez entrer votre nom'
            ),
            'mail' => array(
                'rule' => 'email',
                'message' => 'Vous devez entrer un email valide'
            ),
            'message' => array(
                'rule' => 'notEmpty',
                'message' => 'Vous devez entrer votre message'
            )
        );

        public function sendMail($data){
            if($this->validates()){
                App::uses('CakeEmail', 'Network/Email');
                $CakeEmail = new CakeEmail('default');

                $CakeEmail->from($data['mail']);
                $CakeEmail->to('citybar.be@gmail.com');
                $CakeEmail->subject('[CONTACT] ' . $data['subject']);
                $CakeEmail->emailFormat('html');
                $CakeEmail->viewVars($data);
                $CakeEmail->template('contact');

                return $CakeEmail->send();
            }else
                return false;
        }
    }