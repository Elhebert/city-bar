<?php
    class Rating extends AppModel{
        public $belongsTo = array('User', 'Bar');

        public function nbRateBar($barId){
            $nbRate = $this->find('all', array(
                    'fields'        => array('count(*) nb'),
                    'conditions'    => array('Rating.bar_id' => $barId),
                ));

            $nbRate = $nbRate[0][0];

            return $nbRate;
        }
    }