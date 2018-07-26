<h1>Add a new category</h1>
    <?php
    //echo $this->Form->create('Category',array('url'=> array('controller' => 'Categories', 'action' => 'add'),'method'=>'POST'));
    echo $this->Form->create('Category');
    echo $this->Form->input('parent_id',array('label'=>'Parent'));
    echo $this->Form->input('name',array('label'=>'Name'));
    echo $this->Form->end('Add');
    ?>