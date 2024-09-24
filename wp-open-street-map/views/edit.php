<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<h2><?php _e('Add/edit a WP Open Street Map', 'wp-open-street-map') ?></h2>

<form action="" method="post" class="form_wp_osm">

	<?php wp_nonce_field('edit_wposm'); ?>

	<input type="hidden" name="id" value="<?= $map->id ?>" />

	<label for=""><?php _e('Name:', 'wp-open-street-map') ?></label> <input type="text" name="name" value="<?= $map->name ? $map->name : 'WP OSM' ?>" /><br />

	<label for=""><?php _e('Width:', 'wp-open-street-map') ?></label> <input type="text" name="width" id="wp_osm_width" value="<?= $map->width ? $map->width : '100%' ?>" /><br />

	<label for=""><?php _e('Height:', 'wp-open-street-map') ?></label> <input type="text" name="height" id="wp_osm_height" value="<?= $map->height ? $map->height : '500px' ?>" /><br />

	<input type="text" name="zoom" id="wp_osm_zoom" value="<?= $map->zoom ?>" style="display: none" />

	<input type="text" name="latitude" id="wp_osm_latitude" value="<?= $map->latitude ?>" style="display: none" />

	<input type="text" name="longitude" id="wp_osm_longitude" value="<?= $map->longitude ?>" style="display: none" />

	<input type="submit" value="<?php _e('Save map', 'wp-open-street-map') ?>" class="button button-primary" /> <a href="<?= admin_url('admin.php?page=wp_openstreetmaps'); ?>" class="button button-secondary"><?php _e('Back to maps list', 'wp-open-street-map') ?></a>

</form>

<div id="wp_osm" style="width: 100%; height: 500px;">
</div>

<link rel="stylesheet" href="<?= plugins_url('js/OpenLayers/v6.5.0/css/ol.css', dirname(__FILE__)) ?>" type="text/css">
<script src="<?= plugins_url('js/OpenLayers/v6.5.0/build/ol.js', dirname(__FILE__)) ?>"></script>
<script>

	window.onload = function(){

		var map = new ol.Map({
	        target:  jQuery('#wp_osm').get(0),
	        layers: [
	          new ol.layer.Tile({
	            source: new ol.source.OSM()
	          })
	        ],
	        view: new ol.View({
	        	projection: 'EPSG:3857',
	          	center: [ 0,  0],
	          	zoom: 1
	        })
	    });

	    //Mette à jour les coordonnées et le zoom
	    setInterval(function(){ 

	    	var position = map.getView().getCenter();
	    	//console.log(position);
	    	jQuery('#wp_osm_latitude').val(position[0]);
	    	jQuery('#wp_osm_longitude').val(position[1]);

	    	var zoom = map.getView().getZoom();
	    	jQuery('#wp_osm_zoom').val(zoom);

	    }, 1000);

	    jQuery('#wp_osm_width').change(function(){

	    	jQuery('#wp_osm').width(jQuery(this).val());

	    	//on met à jour la taille de la carte
	    	map.updateSize();

	    });

	    jQuery('#wp_osm_height').change(function(){

	    	jQuery('#wp_osm').height(jQuery(this).val());

	    	//on met à jour la taille de la carte
	    	map.updateSize();

	    });

};

</script>