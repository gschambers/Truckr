<?php echo $this->Html->link($subject['name'], array('controller' => 'subjects', 'action' => 'view', $subject['slug']), array('class' => 'subject '.$subject['slug'])); ?>