<?php
    class CategoriesController extends AppController {
        var $name = 'Categories';   

    
    public function index() {
        $this->layout = "my_layout";
        //$categories = $this->Category->generateTreeList(null,null,null," - ");
        //$this->set('categories', $categories);

        // echo '<select name="cat_id">';
        // echo '<option value="">-- Select -- </option>';
        //$options = '';
        $categoryLists = $this->get_cat_selectlist(0, 0);
        //pr($categoryLists);die;
        $this->set('categoryLists',$categoryLists);
        // $this->set(compact('get_options'));
        // if (count($get_options) > 0){
        //     //$categories = $_POST['cat_id'];
        //     foreach ($get_options as $key => $value) {
        //         $options .="<option value=\"$key\"";
        //         // show the selected items as selected in the listbox
        //         // if ($_POST['cat_id'] == "$key") {
        //         //     $options .=" selected=\"selected\"";
        //         // }
        //         $options .=">$value</option>\n";
        //     }
        // }
        // echo $options;
        // echo '</select>';  
        //$this->render('index');
    }
    function get_cat_selectlist($current_cat_id, $count, $lastname='') {
        
        static $option_results;
        $this->loadModel('Category');
        if ($current_cat_id == 0) {
            $current_cat_id=Null;
        }
        $count = $count+1;
        $get_options = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$current_cat_id),'fields'=>array('id','name'),'order'=>'name ASC'));
        $num_options =  count($get_options);
        $categoryLists = $this->Category->find('list',array('conditions'=>array('Category.parent_id'=>$current_cat_id),'fields'=>array('id','name'),'order'=>'name ASC'));
        
        if ($num_options > 0) {
            foreach ($categoryLists as $key=>$value) {
                $indent_flag = '';
                if ($current_cat_id!=0) {
                    $indent_flag =  $lastname . '--';
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