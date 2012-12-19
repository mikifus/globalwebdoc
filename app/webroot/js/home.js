var home_map;
jQuery(function(){
	var map = new OpenLayers.Map("map");
	home_map = map;
	var layer = new OpenLayers.Layer.Stamen("toner");
	map.addLayer(layer);
	var wms = new OpenLayers.Layer.WMS( "OpenLayers WMS",
		"http://vmap0.tiles.osgeo.org/wms/vmap0", {layers: "basic"} );
	map.addLayer(wms);
	map.zoomToMaxExtent();

	var markers = new OpenLayers.Layer.Vector("Vector Layer");
// 	markers.addFeatures([new OpenLayers.Feature.Vector(new OpenLayers.Geometry.Point(lonLat))]);

	var selectFeature = new OpenLayers.Control.SelectFeature(
		markers,
		{
			clickout: true, toggle: false,
			multiple: false, hover: false,
// 			callback:{
				onSelect: function(f){
					location.href='/documentaries/view/'+f.id;
				}
// 			}
		}
	);
	map.addControls([selectFeature]);
	selectFeature.activate();
	
	map.addLayer(markers);

	window.markersLayer = markers;
});