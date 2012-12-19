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
	
	map.addLayer(markers);

	window.markersLayer = markers;
});