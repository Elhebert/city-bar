<?php
    class User extends AppModel{

        public $hasMany = array('Comment', 'Rating');

        public $validate = array(
                'username'  => array(
                        'alpha'        => array(
                            'rule'           => "/^[a-z0-9A-Z]*$/",
                            'message'   => 'Votre nom d\'utilisateur n\'est pas valide',
                        ),
                        'uniq'          => array(
                            'rule'          => 'isUnique',
                            'message'  => 'Ce pseudo est déjà utilisé',
                        ),
                    ),
                'password'  => array(
                        'rule'          => 'notEmpty',
                    ),
                'password2'  => array(
                        'rule'          => 'identicalFields',
                    ),
                'mail'      => array(
                        'mail'      => array(
                            'rule'         => 'email',
                        ),
                       'uniq'          => array(
                            'rule'          => 'isUnique',
                            'message'  => 'Cet email est déjà utilisé',
                        ),
                    ),
                'avatarf'   => array(
                        'rule'  => 'sizeimg',
                        'message'  => 'Les formats acceptés sont jpg et png',
                    ),
            );

        public function identicalFields($check, $limit){
            $field = key($check);
            return $check[$field] == $this->data['User']['password'];
        }

        public function afterFind($results, $primary = false){
            foreach ($results as $k => $v) {
                if(isset($v[$this->alias]['avatar']) && isset($v[$this->alias]['id']))
                    $results[$k][$this->alias]['avatari'] = 'avatars/' . ceil($v[$this->alias]['id'] / 1000) . '/' . $v[$this->alias]['id'] . '.jpg';
            }

            return $results;
        }

        public function afterSave($created, $options = array()){
            if(isset($this->data[$this->alias]['avatarf']) && !empty($this->data[$this->alias]['avatarf']['tmp_name'])){
                $file = $this->data[$this->alias]['avatarf'];
                $dest = IMAGES . 'avatars' . DS . ceil($this->data['User']['id'] / 1000);

                if(!file_exists($dest))
                    mkdir($dest, 0777, true);

                $dest .= DS . $this->data['User']['id'] . '.jpg';

                $imagine = new Imagine\Gd\Imagine();
                try{
                    $imagine->open($file['tmp_name'])->thumbnail(new Imagine\Image\Box(100, 100), Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)->save($dest);
                }catch(Imagine\Exception\Exception $e){
                    debug($e);
                }
            }
        }
    }