<?php
App::uses('AppController', 'Controller');
class CommentsController extends AppController{

    public $layout = 'barLayout';

    public $paginate = array(
        'contain'    => array('User','Bar'),
        'fields'     => array('Comment.id', 'Comment.user_id', 'Comment.content','Comment.created','User.username','User.avatar','User.id','Bar.name', 'Bar.slug','Bar.id','Comment.username','Comment.mail'),
        'order'      => array('Comment.id' => 'ASC')
    );

    /**
    * Gere la suppression d'un commentaire
    **/
    /*public function delete($id){
        if(!$this->request->is('post')){
            throw new NotFoundException();
        }
        $this->Comment->contain('Post');
        $comment = $this->Comment->findById($id, array('Comment.id','Post.user_id','Comment.user_id'));
        if(
            $this->Auth->user('id') == $comment['Comment']['user_id'] ||
            $this->Auth->user('id') == $comment['Post']['user_id'] ||
            $this->Auth->user('role') == 'admin'
        ){
            $this->Comment->delete($id);
            $this->Session->setFlash("Commentaire supprimé","flash", array('class' => 'success'));
        }else{
            $this->Session->setFlash("Vous n'avez pas le droit de supprimer ce commentaire", "flash", array('class' => 'error'));
        }
        return $this->redirect($this->referer());
    }*/


    /**
    * Affiche les commentaires de l'utilisateur connecté
    **/
    public function user(){
        $comments = $this->paginate('Comment', array('Comment.user_id' => $this->Auth->user("id")));
        $this->set(compact('comments'));
    }

    public function admin_index(){
        $comments = $this->paginate('Comment');
        $this->set(compact('comments'));
    }

}