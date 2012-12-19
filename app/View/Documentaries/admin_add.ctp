<?php
$this->Html->css('admin', null, array('inline' => false));
$this->Html->css('admin.documentaries.add', null, array('inline' => false));

// $this->Html->css('/js/jwysiwyg/jquery.wysiwyg', null, array('inline' => false));
// $this->Html->script(array('jwysiwyg/jquery.wysiwyg'), array('inline' => false));
// echo $this->Html->scriptBlock(
//     '$(document).ready(function() {
//       $(".description_area").wysiwyg();
// 	});',
//     array('inline' => false)
// );
?>
<div class='admin_div'>
	<h1 class='form_title'>
		Add new documentary
	</h1>
	<?
	if($error = $this->Session->flash()){
		?>
		<div class='error'>
			<?
			echo $error;
			?>
		</div>
		<?
	}
	?>
	<div id='voucher_form'>
		<div class="form">
		<?php
			$between_html = "</div><div class='input_div'>";
			echo $this->Form->create('Documentary');
			echo $this->Form->input('lon',array('between'=>$between_html,'label'=>"Longitude"));
			echo $this->Form->input('lat',array('between'=>$between_html,'label'=>"Latitude"));
			echo $this->Form->input('name',array('between'=>$between_html,'label'=>"Title"));
			echo $this->Form->input('embed_html',array('between'=>$between_html,'label'=>"Embed html"));
			echo $this->Form->input('director',array('between'=>$between_html,'label'=>"Director"));
			echo $this->Form->input('sinopsis',array('type'=>'textarea','between'=>$between_html,'label'=>"Sinopsis"));
			echo $this->Form->input('production_country',array('between'=>$between_html,'label'=>"Production Country"));
			echo $this->Form->input('website',array('between'=>$between_html,'label'=>"Website"));
			
			echo $this->Form->input('release_date',array('between'=>$between_html,'label'=>"Release date"));

			echo $this->Form->input('Topic', array('multiple'=>'checkbox','label'=>"Topics"));
			echo $this->Form->input('Region', array('multiple'=>'checkbox','label'=>"Regions"));
			echo $this->Form->input('AvailableLanguage', array('multiple'=>'checkbox','label'=>"Available languages"));
			
			echo $this->Form->input('tags',array('type'=>'textarea','between'=>$between_html,'label'=>"Tags (separated by comma)"));
			?>
			<div class='clearer'></div>
			<?
			echo $this->Form->end(__('Save'));
		?>
		</div>
	</div>
	<?php
	if(isset($images)/* && is_array($images)*/){
		?>
		<div class='image_container'>
			<?php
			foreach($images/*['Image']*/ as $img){
				$img = $img['Image'];
				/*if(!$img['id']) continue;*/?>
				<div class='image'>
					<div class='img background_image_link' style='background-image:url(<?="/img/documentaries/".$img['filename']?>);'></div>
					<div class='options'>
						<div>
                            <?php
                            echo $this->Form->postLink(
                                __('Eliminar'),
                                array(
                                      'controller' => 'Images', 'action'   => 'delete', $img['id']
                                      ),
                                array(
                                      'confirm'  => "Are you sure you wish to delete this element?"
                                     ));
                            ?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			<div class='clearer'></div>
		</div>
		<div class='image_form'>
			<div class='options'>
				<div>
					<div class='title'> Upload image </div>
					<?php
					echo $this->Form->create('Image', array('enctype' => 'multipart/form-data'));
					echo $this->Form->input('filename', array('type'=>'file', 'label'=>"File"));
					echo $this->Form->end("Upload");
					?>
				</div>
			</div>
			<div class='clearer'></div>
		</div>
	<?
	}
	?>
	<div class='admin_bottom_menu'>
		<?php
		$list = array(
			$this->Html->link("List documentaries",array('action'=>'index'))
		);
		echo $this->Html->nestedList($list);
		?>
	</div>
</div>