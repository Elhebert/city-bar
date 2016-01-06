<?php
    class Bar extends AppModel {

        public $hasMany = array('Comment', 'Rating');

        public function afterFind($results, $primary = false){
            foreach($results as $k=>$result){
                if(isset($result[$this->alias]['slug'])){
                    $results[$k][$this->alias]['url'] = array('controller' => 'Bars', 'action' => 'view', $result[$this->alias]['slug']);
                }
            }
            return $results;
        }
    }