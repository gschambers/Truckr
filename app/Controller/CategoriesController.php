<?php

App::uses('Sanitize', 'Utility');

class CategoriesController extends AppController {

    public $name = 'Categories';
    public $helpers = array('Html', 'Form','Text',"Time", "Markdown.Markdown");
    public $components = array('Session');

    public function view($slug) {
        $category = $this->Category->find('first', array(
            'conditions' => array('Category.slug' => $slug)
        ));
        if(!$category){
            throw new NotFoundException();
        }
        $this->set("category", $category);
        $this->set('posts', $this->Category->Post->find('all',array(
             'order' => array('modified desc'),
             'conditions' => array(
                'Category.slug' => $slug
             )
        )));
    }

}