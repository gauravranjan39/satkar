<?php
    class CategoriesController extends AppController {
        var $name = 'Categories';   

    
    public function index() {
        $this->layout = "my_layout";
        //echo strtoupper(uniqid());die;
        //$categories = $this->Category->generateTreeList(null,null,null," - ");
        $categoryLists = $this->get_cat_selectlist(0, 0);
        $this->set('categoryLists',$categoryLists);
    }

    function get_cat_selectlist($current_cat_id, $count, $name='') {
        static $option_results;
        // if ($current_cat_id == 0) {
        //     $current_cat_id=Null;
        // }
        $count = $count+1;
        $get_options = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$current_cat_id),'fields'=>array('id','name'),'order'=>'name ASC'));
        $num_options =  count($get_options);
        $categoryLists = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>$current_cat_id),'fields'=>array('id','name'),'order'=>'name ASC'));
        
        if ($num_options > 0) {
            foreach ($categoryLists as $key=>$value) {
                $indent_flag = '';
                if ($current_cat_id!=0) {
                    $indent_flag =  $name . '--';
                    $indent_flag .=  '>';
                }
                $value = $indent_flag.$value;
                $option_results[$key] = $value;
                $this->get_cat_selectlist($key, $count, $value);
            }
        }
        return $option_results;
    }

    public function add() {
        $this->layout = "my_layout";
        $this->loadModel('Category');
        if (!empty($this->data) ) {
            $this->Category->save($this->data);
            $this->Session->setFlash('A new category has been added', 'success');
            $this->redirect(array('action' => 'index'));
        } else {
            $parents[0] = "[Main Category]";
            $categories = $this->get_cat_selectlist(0, 0);
            //$categories = $this->Category->generateTreeList(null,null,null," - ");
            if($categories) {
                foreach ($categories as $key=>$value)
                $parents[$key] = $value;
            }
            $this->set(compact('parents'));
        }
    }

    public function edit($id=null) {
        $this->layout = "my_layout";
        if (!empty($this->data)) {
            if($this->Category->save($this->data)==false)
            $this->Session->setFlash('Error saving Node.', 'error');
            $this->redirect(array('action'=>'index'));
        } else {
            if($id==null) die("No ID received");
                $this->data = $this->Category->read(null, $id);
                $parents[0] = "[ Main Category ]";
                $categories = $this->get_cat_selectlist(0, 0);
                //$categories = $this->Category->generateTreeList(null,null,null," - ");
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
        $this->Session->SetFlash('The Category could not be deleted', 'error');
        $this->Session->SetFlash('Category has been deleted', 'success');
        $this->redirect(array('action'=>'index'));
    }

}
?>