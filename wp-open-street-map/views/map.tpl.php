<div id="wp_osm_<?= $map->id ?>" class="wp_osm" style="width: <?= $map->width ?>; height: <?= $map->height ?>" data-lon="<?= $map->longitude ?>" data-lat="<?= $map->latitude ?>" data-zoom="<?= $map->zoom ?>">
	<div class="ol-popup">
	    <a href="#" class="ol-popup-closer"></a>
	    <div class="popup-content"></div>
	</div>
	<?php

		foreach($map->markers as $marker)
		{
			echo '<div class="marker" data-icon="'.$marker->icon.'" data-lon="'.$marker->longitude.'" data-lat="'.$marker->latitude.'" data-name="'.$marker->name.'" data-description="'.nl2br($marker->description).'"></div>';
		}
	?>
</div>