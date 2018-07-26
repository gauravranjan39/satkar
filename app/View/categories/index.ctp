



<?php
        echo $this->Html->link("Add Category",array('action'=>'add'));
        echo "<ul>";
        foreach($categories as $key=>$value){
        $edit = $this->Html->link("Edit", array('action'=>'edit', $key));
        $delete = $this->Html->link("Delete", array('action'=>'delete', $key));
        echo "<li>$value &nbsp;[$edit]&nbsp;[$delete]</li>";
    }
    echo "</ul>";
?>