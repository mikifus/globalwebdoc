<?php
$this->Html->css('documentaries.index', null, array('inline' => false));
?>
<h1> Documentaries </h1>
<div class='documentary_list'>
	<?
	foreach($documentary_list as $documentary){
		$imageurl = (!empty($documentary['Image'])&&$img=$documentary['Image'][0])?("/img/documentaries/".$img['filename']):false;
		$d = $documentary['Documentary'];
		$link = Router::url(array('action'=>'view',$d['id']));
		?>
		<div class='element'>
			<?php  ?>
			<?if($imageurl){?>
				<a class="" href="<?echo $link?>">
					<div class='img background_image_link' style="background-image: url(<?echo $imageurl?>);"></div>
				</a>
			<?}?>
			<?php  ?>
			<div class='text'>
				<div class='titles'>
					<div class="title"><a href="<?php echo $link?>" class="t1">
						<?echo $d['name']?>
					</a></div>
					<div class="director"><?echo $d['director']?></div>
				</div>
				<div class='language_list'>
					<?php foreach($documentary['AvailableLanguage'] as $lang){ ?>
						<span class='lang'>
							<?php
								echo $this->Html->link($lang['name'],array('action'=>'view',$d['id'],$lang['id']));
							?>
						</span>
					<?php } ?>
					<div class='clearer'></div>
				</div>
			</div>
		</div>
	<?
	}?>
	<div class='clearer'></div>
	<div class='paginate'>
		<?php echo $this->Paginator->prev(null,null,null,array('class'=>'hidden')); ?>
		<?php
			echo $this->Paginator->numbers(array('first' => 'First page','separator'=>' - '));
		?>
		<?php echo $this->Paginator->next(null,null,null,array('class'=>'hidden')); ?>
	</div>
</div>