<?php
$this->Html->css('documentaries.view', null, array('inline' => false));
echo $this->Html->script('documentaries.view', array('inline' => false)); // Include jQuery library
echo $this->Html->scriptBlock(
	'
	jQuery(function(){
        jQuery.ajax({
			type: "post",
			url: "/documentaries/getMapList/'.$Documentary['Documentary']['id'].'",
			//data: data,
			dataType: "json",
			success: function(data){
				bounds = new OpenLayers.Bounds();
				//for(var a in data){
					var d = data/*[a]*/["Documentary"];
					var lonLat = new OpenLayers.LonLat( d.lat,d.lon )
						.transform(
							new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
							home_map.getProjectionObject() // to Spherical Mercator Projection
						);

					var point = new OpenLayers.Geometry.Point(lonLat.lon, lonLat.lat);
					var marker = new OpenLayers.Feature.Vector(point);
						marker.id = d.id;
					markersLayer.addFeatures([marker]);
					bounds.extend(lonLat);
				//}
				home_map.zoomToExtent(bounds);
			}
        });
	});
	',
	array('inline' => false)
);
?>
<div id='map'></div>
<?php /* ?>
<pre>
<?php
	print_r($Documentary);
?>
</pre>
<?php */ ?>
<?php
	$d = $Documentary['Documentary'];
?>
<div class='profile'>
	<h2><?php echo $d['name']; ?></h2>
	<?php if(!empty($video_data)){ ?>
		<div class='data'>
			<h3>Video</h3>
			<div class='data_content'>
				<?php echo $video_data['embed_html']; ?>
			</div>
		</div>
	<?php } ?>
	<div class='data'>
		<h3>Available languages</h3>
		<div class='data_content'>
			<?php foreach($Documentary['AvailableLanguage'] as $t){
				echo $this->Html->link($t['name'], array('action'=>$this->request->action,$d['id'],$t['id'])).' ';
			} ?>
		</div>
	</div>
	<div class='data'>
		<h3>Director</h3>
		<div class='data_content'>
			<?php echo $d['director']; ?>
		</div>
	</div>
	<div class='data'>
		<h3>Regions</h3>
		<div class='data_content'>
			<?php foreach($Documentary['Region'] as $t){
				echo "<span> ".$t['name']." </span>";
			} ?>
		</div>
	</div>
	<div class='data'>
		<h3>Topics</h3>
		<div class='data_content'>
			<?php foreach($Documentary['Topic'] as $t){
				echo "<span> ".$t['name']." </span>";
			} ?>
		</div>
	</div>
	<div class='data'>
		<h3>Sinopsis</h3>
		<div class='data_content'>
			<?php echo $d['sinopsis']; ?>
		</div>
	</div>
	<div class='data'>
		<h3>Production country</h3>
		<div class='data_content'>
			<?php echo $d['production_country']; ?>
		</div>
	</div>
	<div class='data'>
		<h3>Release year</h3>
		<div class='data_content'>
			<?php echo $d['release_date']; ?>
		</div>
	</div>
	<div class='data'>
		<h3>Website</h3>
		<div class='data_content'>
			<?php echo $this->Html->link($d['website'], $d['website'], array('target'=>'_blank')); ?>
		</div>
	</div>
</div>