<div>
	<div class='section'>
		<h2>Menu</h2>
		<?php
		$list = array(
			__('Documentaries')=> array(
				$this->Html->link(__("List"),array('controller'=>'documentaries','action'=>'index')),
				$this->Html->link(__("Add"),array('controller'=>'documentaries','action'=>'add'))
			),
			__('Videos')=> array(
				$this->Html->link(__("List"),array('controller'=>'videos','action'=>'index')),
				$this->Html->link(__("Add"),array('controller'=>'videos','action'=>'add'))
			),
// 			__('Images')=> array(
// 				$this->Html->link(__("List"),array('controller'=>'images','action'=>'index')),
// 				$this->Html->link(__("Add"),array('controller'=>'images','action'=>'add'))
// 			),
			__('Regions')=> array(
				$this->Html->link(__("List"),array('regions'=>'regions','action'=>'index')),
				$this->Html->link(__("Add"),array('controller'=>'regions','action'=>'add'))
			),
			__('Languages')=> array(
				$this->Html->link(__("List"),array('regions'=>'available_languages','action'=>'index')),
				$this->Html->link(__("Add"),array('controller'=>'available_languages','action'=>'add'))
			),
			__('Topics')=> array(
				$this->Html->link(__("List"),array('regions'=>'topics','action'=>'index')),
				$this->Html->link(__("Add"),array('controller'=>'topics','action'=>'add'))
			)
		);
		echo $this->Html->nestedList($list);
		?>
	</div>
</div>