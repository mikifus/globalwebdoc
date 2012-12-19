<?php
$this->Html->css('home', null, array('inline' => false));
echo $this->Html->script('home', array('inline' => false)); // Include jQuery library
echo $this->Html->scriptBlock(
	'
	jQuery(function(){
        jQuery.ajax({
			type: "post",
			url: "/documentaries/getMapList",
			//data: data,
			dataType: "json",
			success: function(data){
				bounds = new OpenLayers.Bounds();
				for(var a in data){
					var d = data[a]["Documentary"];
					var lonLat = new OpenLayers.LonLat( parseFloat(d.lat),parseFloat(d.lon) )
						.transform(
							new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
							home_map.getProjectionObject() // to Spherical Mercator Projection
						);

					var point = new OpenLayers.Geometry.Point(lonLat.lon, lonLat.lat);
					var marker = new OpenLayers.Feature.Vector(point);
						marker.id = d.id;
					markersLayer.addFeatures([marker]);
					bounds.extend(lonLat);
				}
				home_map.zoomToExtent(bounds);
			}
        });
	});
	',
	array('inline' => false)
);
?>
<div id='map'></div>