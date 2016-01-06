<?php
    App::uses('AppController', 'Controller');

    class UsersController extends AppController{

        public $layout = 'barLayout';

        public function beforeFilter(){
            parent::beforeFilter();
            $this->Auth->allow('signup', 'login', 'activate', 'forgot', 'password', 'facebook');
        }

        /**
        * Gere le Panel Admin
        **/
        public function admin_index(){
            if($this->Session->read('Auth.User.role') != 2){
                $this->redirect($this->referer());
            }

            $userList = $this->User->find('all', array(
                    'fields'    => array('User.username', 'User.id', 'User.lastname', 'User.firstname', 'User.created'),
                    'order'     => array('User.id' => 'ASC')
                ));

            $this->set(compact('userList'));
        }

        /**
        * Affiche les infos d'un utilisateur
        **/
        public function account(){
            $comments = $this->User->Comment->find('all', array(
                    'conditions' => array('Comment.user_id' => $this->Auth->user('id')),
                    'contain'    => array('Bar', 'User'),
                    'fields'     => array('Comment.content', 'Comment.id', 'Comment.created', 'User.username', 'User.avatar', 'Bar.name', 'Bar.id'),
                    'limit'      => 4,
                )
            );
            $this->set(compact('comments'));
        }

        /**
        * Gere l'édition des infos de l'utilisateur
        **/
        public function edit(){
            if(!empty($this->request->data)){
                $this->request->data['User']['id'] = $this->Auth->user('id');
                $this->User->create($this->request->data);
                if($this->User->validates()){
                    $this->User->create();
                    $this->User->save($this->request->data, true, array('firstname', 'lastname'));

                    if(!empty($this->request->data['User']['avatarf']['tmp_name'])){
                        $directory = IMAGES . 'avatars' . DS . ceil($this->User->id / 1000);

                        if(!file_exists($directory))
                            mkdir($directory, 0777, true);

                        move_uploaded_file($this->request->data['User']['avatarf']['tmp_name'], $directory . DS . $this->User->id . '.jpg');

                        $this->User->saveField('avatar', 1);
                    }

                    $user = $this->User->read();
                    $this->Auth->login($user['User']);

                    $this->Session->setFlash("Vos informations ont bien été modifiée","flash", array('class' => 'success'));
                }
            }else{
                $this->User->id = $this->Auth->user('id');
                $this->request->data = $this->User->read;
            }
        }

        /**
        * Gere la connection de l'utilisateur
        **/
        public function login(){
            if(!empty($this->request->data)){
                if($this->Auth->login()){
                    $this->Session->setFlash("Vous êtes connecté", "flash", array('class' => 'success'));
                    return $this->redirect('/users/edit');
                }else
                    $this->Session->setFlash("Identifiants incorrects", "flash", array('class' => 'danger'));
            }
        }

        /**
        * Gere la conection via Facebook
        **/
        function facebook(){
            $this->Session->read();

            require APPLIBS . 'Facebook' . DS . 'facebook.php';
            $facebook = new Facebook(array(
              'appId'  => '1458128141086340',
              'secret' => '1b930427e1e4195d51389e7342c14302',
              'allowSignedRequest' => false
            ));

            $this->Session->write('test','test');
            $user = $facebook->getUser();

            if($user){
                try{
                    $infos = $facebook->api('/me', 'GET');

                    $avatar = $facebook->api(
                        "/me/picture",
                        "GET",
                        array (
                            'redirect' => false,
                            'height' => '100',
                            'type' => 'normal',
                            'width' => '100',
                        )
                    );

                    $avatar = $avatar['data']['url'];

                    $u = $this->User->find('first', array(
                        'recursive'  => -1,
                        'conditions' => array('facebook_id' => $infos['id'])
                    ));
                    if(!empty($u)){
                        $this->Auth->login($u['User']);
                        $this->redirect('/users/edit');
                    }

                    if($this->request->is('post')){
                        $data = $this->request->data['User'];
                        $d = array(
                            'username'    => $data['username'],
                            'facebook_id' => $infos['id'],
                            'mail'        => $infos['email'],
                            'lastname'    => $infos['last_name'],
                            'firstname'   => $infos['first_name'],
                            'active'      => 1,
                            'avatar'      => 1
                        );
                        if($this->User->save($d)){
                            $this->Session->setFlash('Vous êtes maintenant inscrit', 'flash');

                            $directory = IMAGES . 'avatars' . DS . ceil($this->User->id / 1000);

                            if(!file_exists($directory))
                                mkdir($directory, 0777, true);

                            copy($avatar, $directory . DS . $this->User->id . '.jpg');

                            $u = $this->User->read();
                            $this->Auth->login($u['User']);
                            $this->redirect('/users/edit');
                        }else{
                            $this->Session->setFlash("Votre pseudo est déja utilisé", "flash", array('type'=>'danger'));
                        }
                    }
                    $d = array();
                    $d['user'] = $infos;
                    $this->set($d);
                }catch(FacebookApiException $e){
                    debug($e);
                }
            }else{
                $this->Session->setFlash("Erreur de l'identification facebook", "flash", array('type'=>'danger'));
                $this->redirect(array('action'=>'login'));
            }
        }

        /**
        * Déconnecte l'utilisateur
        **/
        public function logout(){
            $this->Auth->logout();
            return $this->redirect('/users/login');
        }

        /**
        * Gere l'inscription l'utilisateur
        **/
        public function signup(){
            if(!empty($this->request->data)){
                $this->User->create($this->request->data);
                if($this->User->validates()){
                    $token = md5(time() . ' - ' . uniqid());
                    $this->User->create( array(
                            'username'  => $this->request->data['User']['username'],
                            'password'   => $this->Auth->password($this->request->data['User']['password']),
                            'mail'           => $this->request->data['User']['mail'],
                            'token'         => $token,
                        ));
                    $this->User->save();

                    App::uses('CakeEmail', 'Network/Email');
                    $CakeEmail = new CakeEmail('default');
                    $CakeEmail->to($this->request->data['User']['mail']);
                    $CakeEmail->subject('[CITY-BAR] Inscription');
                    $CakeEmail->viewVars(
                        $this->request->data['User'] +
                        array(
                            'token' => $token,
                            'id' => $this->User->id
                        )
                    );
                    $CakeEmail->emailFormat('html');
                    $CakeEmail->template('signup');
                    $CakeEmail->send();

                    $this->Session->setFlash('Merci de votre inscription, vous allez recevoir un email pour activer votre compte. Vérifier votre boite de spam, il arrive parfois que le mail s\'y trouve.', 'flash');
                    return $this->redirect('/users/login');
                }else
                    $this->Session->setFlash('Oups, quelque chose s\'est mal passé', 'flash', array('class' => 'danger'));
            }
        }

        /**
        * Gere l'oublie de mot de passe
        **/
        public function forgot(){
            if(!empty($this->request->data)){
                $user = $this->User->findByMail($this->request->data['User']['mail'], array('id'));
                if(empty($user))
                    $this->Session->setFlash("Ce mail n'est associé à aucun compte", "flash", array("class" => "warning"));
                else{
                    $token = md5(uniqid().time());
                    $this->User->id = $user['User']['id'];
                    $this->User->saveField('token', $token);

                    App::uses('CakeEmail', 'Network/Email');
                    $CakeEmail = new CakeEmail('default');
                    $CakeEmail->to($this->request->data['User']['mail']);
                    $CakeEmail->to($this->request->data['User']['mail']);
                    $CakeEmail->subject('[CITY-BAR] Régénération de mot de passe');
                    $CakeEmail->viewVars(array(
                            'token' => $token,
                            'id', $user['User']['id'],
                        ));
                    $CakeEmail->emailFormat('text');
                    $CakeEmail->template('password');
                    $CakeEmail->send();

                    $this->Session->setFlash("Un email vous à été envoyé avec les instructions pour régénérer votre mot de passe","flash", array('class' => 'success'));
                }
            }
        }

        /**
        * Gere la regénération de mot de passe
        **/
        public function password($user_id, $token){
            $user = $this->User->find('first', array(
                'conditions'    => array(
                    'id'        => $user_id,
                    'token'   => $token,
               ),
                'fields'           => array('id'),
            ));

            if(empty($user)){
                $this->Session->setFlash('Ce lien ne semble pas bon', 'flash');
                return $this->redirect(array('action' => 'forgot'));
            }

            if(!empty($this->request->data)){
                $this->User->create($this->request->data);
                if($this->User->validates()){
                    $this->User->create();
                    $this->User->save(array(
                        'id'              => $user['User']['id'],
                        'token'         => '',
                        'active'        => 1,
                        'password'   => $this->Auth->password($this->request->data['User']['password']),
                    ));

                    $this->Session->setFlash('Votre mot de passe à bien été modifié', 'flash', array('class' => 'success'));
                    return $this->redirect(array('action' => 'login'));
                }
            }
        }

        /**
        * Gere l'activation du compte utilisateur
        **/
        public function activate($user_id, $token){
            $user = $this->User->find('first', array(
                'conditions'    => array(
                    'id'        => $user_id,
                    'token'   => $token,
               ),
                'fields'           => array('id'),
            ));

            if(empty($user)){
                $this->Session->setFlash('Ce lien de validatation ne semble pas bon', 'flash');
                return $this->redirect('/');
            }

            $this->Session->setFlash('Votre compte à bien été validé', 'flash');
            $this->User->save(array(
                'id'          => $user['User']['id'],
                'active'    => 1,
                'token'     => '',
            ));

            return $this->redirect(array('action' => 'login'));
        }
    }