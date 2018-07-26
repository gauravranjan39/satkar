<?php
    class CategoriesController extends AppController {
        var $name = 'Categories';   

    
    public function index() {
        $categories = $this->Category->generateTreeList(null,null,null," - ");
        $this->set('categories', $categories);
    }

    public function add() {
        $this->loadModel('Category');
        if (!empty($this->data) ) {
            $this->Category->save($this -> data);
            $this->Session->setFlash('A new category has been added');
            $this->redirect(array('action' => 'index'));
        } else {
            $parents[0] = "[Top]";
            $categories = $this->Category->generateTreeList(null,null,null," - ");
            if($categories) {
                foreach ($categories as $key=>$value)
                $parents[$key] = $value;
            }
            $this->set(compact('parents'));
        }
    }

    public function edit($id=null) {
        if (!empty($this->data)) {
            if($this->Category->save($this->data)==false)
            $this->Session->setFlash('Error saving Node.');
            $this->redirect(array('action'=>'index'));
        } else {
            if($id==null) die("No ID received");
                $this->data = $this->Category->read(null, $id);
                $parents[0] = "[ Top ]";
                $categories = $this->Category->generateTreeList(null,null,null," - ");
            if($categories)
                foreach ($categories as $key=>$value)
                $parents[$key] = $value;
            $this->set(compact('parents'));
        }
    }

    public function delete($id=null) {
        if($id==null)
        die("No ID received");
        $this->Category->id=$id;
        if($this->Category->removeFromTree($id,true)==false)
        $this->Session->setFlash('The Category could not be deleted.');
        $this->Session->setFlash('Category has been deleted.');
        $this->redirect(array('action'=>'index'));
    }

}
?>