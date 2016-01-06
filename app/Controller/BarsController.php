<?php

    class BarsController extends AppController {

        public $layout = 'barLayout';

        public $helpers = array('GoogleMap');

        public function beforeFilter(){
            parent::beforeFilter();
            $this->Auth->allow('index', 'view', 'sort', 'search');
        }

        public function sort($sort){

            if($sort == 'pop'){
                $this->Session->delete('sort');
                $this->Session->write('sort', 'pop');
            }else{
                $this->Session->delete('sort');
                $this->Session->write('sort', 'alpha');
            }

            $this->redirect($this->referer());
        }

        /**
        * Gere l'affichage de la liste des bars
        **/
        public function index($letter = '#'){

            if($letter != '#')
                $barList = $this->Bar->find('all', array(
                    'fields'            => array('Bar.slug', 'Bar.id', 'Bar.name', 'Bar.letter'),
                    'conditions'        => array('Bar.letter' => $letter),
                    'order'             => array('Bar.name' => 'ASC')
                ));
            else
                $barList = $this->Bar->find('all', array(
                    'fields'            => array('Bar.slug', 'Bar.id', 'Bar.name', 'Bar.letter'),
                    'order'             => array('Bar.name' => 'ASC')
                ));

            foreach ($barList as $k => $v) {
                $nbComment = $this->Bar->Comment->nbCommentBar($barList[$k]['Bar']['id']);
                $barList[$k]['Bar']['nbComment'] = $nbComment['nb'];
                $barList[$k]['Bar']['rate'] = 0;
                $barList[$k]['Bar']['nbRate'] = 0;
                if(!empty($v['Rating'])){
                    foreach ($v['Rating'] as $key => $value) {
                        $barList[$k]['Bar']['rate'] += $value['rate'];
                    }
                    $rate = $this->Bar->Rating->nbRateBar($barList[$k]['Bar']['id']);
                    $barList[$k]['Bar']['rate'] = intval($barList[$k]['Bar']['rate'] / $rate['nb']);
                    $barList[$k]['Bar']['nbRate'] = $rate['nb'];
                }
            }

            if($this->Session->read('sort') == 'pop')
                AppController::aasort($barList, "rate");
            else
                AppController::aasort($barList, "name");

            $this->set(compact('barList'));
        }

        /**
        * Gere l'affichage des détails d'un bar
        **/
        public function view($slug){
            $barInfo = $this->Bar->find('all', array(
                'fields'        => array('Bar.id', 'Bar.name', 'Bar.addr', 'Bar.tel', 'Bar.email', 'Bar.horaire', 'Bar.letter'),
                'conditions'    => array('Bar.slug' => $slug)
            ));

            if(empty($barInfo))
                throw new NotFoundException();

            foreach ($barInfo as $k => $v) {
                $barInfo[$k]['Bar']['rate'] = 0;
                $barInfo[$k]['Bar']['nbRate'] = 0;
                if(!empty($v['Rating'])){
                    foreach ($v['Rating'] as $key => $value) {
                        $barInfo[$k]['Bar']['rate'] += $value['rate'];
                    }
                    $rate = $this->Bar->Rating->nbRateBar($barInfo[$k]['Bar']['id']);
                    $barInfo[$k]['Bar']['rate']= intval($barInfo[$k]['Bar']['rate'] / $rate['nb']);
                    $barInfo[$k]['Bar']['nbRate'] = $rate['nb'];
                }
            }

            $id = $barInfo[0]['Bar']['id'];

            if(!empty($this->request->data)){
                $this->request->data['Comment']['user_id'] = $this->Auth->user("id") ? $this->Auth->user("id") : 0;
                $this->Bar->Comment->create($this->request->data, true);
                $fields = array('user_id', 'bar_id', 'content');
                if(!$this->Auth->user("id")){
                    $fields[] = 'username';
                    $fields[] = 'mail';
                }
                if($this->Bar->Comment->save(null, true, $fields)){
                    $this->Session->setFlash('Merci pour votre commentaire', 'flash', array('class' => 'success'));
                    $this->request->data = array();
                }else{
                    $this->Session->setFlash('Impossible d\'envoyer votre commentaire', 'flash', array('class' => 'error'));
                }
            }

            $rate = $this->Bar->Rating->find('all', array(
                    'fields'        => array('rate'),
                    'conditions'    => array('Rating.bar_id' => $id, 'Rating.user_id' => $this->Auth->user("id")),
                ));

            $comments = $this->Bar->Comment->find('all', array(
                    'conditions' => array('Comment.bar_id' => $id),
                    'contain'    => array('User'),
                    'fields'     => array('Comment.id', 'Comment.user_id', 'Comment.content','Comment.created','User.username','User.avatar','User.id','Comment.username','Comment.mail'),
                    'order'      => array('Comment.created' => 'DESC'),
                ));

            $nbComment = $this->Bar->Comment->find('all', array(
                    'fields'        => array('count(*) nb'),
                    'conditions'    => array('Comment.bar_id' => $id)
                ));

            $nbComment = $nbComment[0][0];

            $this->set(compact('barInfo', 'comments', 'nbComment', 'rate'));
        }

        /**
        * Gere la recherche
        **/
        public function search(){

            if(!empty($this->request->data)){

                $barSalt = $this->request->data['Bar']['barSalt'];

                $barList = $this->Bar->find('all', array(
                    'fields'            => array('Bar.slug', 'Bar.id', 'Bar.name', 'Bar.letter'),
                    'conditions'        => array('Bar.name LIKE' => '%' . $barSalt . '%'),
                    'order'             => array('Bar.name' => 'ASC')
                ));

                foreach ($barList as $k => $v) {
                    $nbComment = $this->Bar->Comment->nbCommentBar($barList[$k]['Bar']['id']);
                    $barList[$k]['Bar']['nbComment'] = $nbComment['nb'];
                    $barList[$k]['Bar']['rate'] = 0;
                    $barList[$k]['Bar']['nbRate'] = 0;
                    if(!empty($v['Rating'])){
                        foreach ($v['Rating'] as $key => $value) {
                            $barList[$k]['Bar']['rate'] += $value['rate'];
                        }
                        $rate = $this->Bar->Rating->nbRateBar($barList[$k]['Bar']['id']);
                        $barList[$k]['Bar']['rate'] = intval($barList[$k]['Bar']['rate'] / $rate['nb']);
                        $barList[$k]['Bar']['nbRate'] = $rate['nb'];
                    }
                }

                if($this->Session->read('sort') == 'pop')
                    AppController::aasort($barList, "rate");
                else
                    AppController::aasort($barList, "name");

                $this->set(compact('barList', 'barSalt'));
            }
        }
    }