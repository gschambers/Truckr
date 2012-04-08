<?php

class Tag extends AppModel {

    public $name = 'Tag';
    public $hasMany = array('PostTag','CategoryTag');

    public $validate = array(
        'slug' => array(
            'rule'    => 'isUnique',
            'message' => 'This name already exists.'
        )
    );

    public function makeSlug($name, $maxLength = 50){
       $result = strtolower($name);
       $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
       $result = trim(preg_replace("/[\s-]+/", " ", $result));
       $result = trim(substr($result, 0, $maxLength));
       $result = preg_replace("/\s/", "-", $result);
       return $result;
    }

   public function setCategories($category_ids){

        $this->CategoryTag->deleteAll(array(
            'Tag.id' => $this->id
        ));

        foreach($category_ids as $tag_id){
            $this->CategoryTag->create();
            $this->CategoryTag->save(array(
                'tag_id' => $this->id,
                'category_id' => $tag_id
            ));
        }
    }

}