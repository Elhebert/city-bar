<?php
    class Comment extends AppModel{

        public $validate = array(
                'name'      => array(
                        'rule'      => 'notEmpty',
                        'message'   => 'Vous devez entrer votre nom'
                    ),
                'mail'      => array(
                        'rule'      => 'email',
                    ),
                'content'   => array(
                        'rule'      => 'notEmpty',
                        'message'   => 'Vous devez entrer un message'
                    )
            );

        public $belongsTo = array('User', 'Bar');

        public function afterFind($results, $primary = false){

            foreach($results as $k => $result) {
                if(isset($result[$this->alias])){
                    $data = $result[$this->alias];

                    if(isset($data['username']) && $data['username'] != null){
                        $results[$k]['User']['username'] = $data['username'];
                    }
                    if(isset($data['mail']) && $data['mail'] != null){
                        $results[$k]['User']['avatari'] = 'http://www.gravatar.com/avatar/' . md5($data['mail']) . '?size=150';
                        $results[$k]['User']['avatar'] = 1;
                    }
                    if(isset($result['Bar']['slug'])){
                        $results[$k][$this->alias]['url'] = array('controller' => 'Bars', $result['Bar']['slug']);
                    }
                }
            }
            return $results;
        }

        public function nbCommentBar($barId){
            $nbComment = $this->find('all', array(
                    'fields'        => array('count(*) nb'),
                    'conditions'    => array('Comment.bar_id' => $barId),
                ));

            $nbComment = $nbComment[0][0];

            return $nbComment;
        }
    }