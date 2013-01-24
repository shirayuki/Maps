<?php

/**
 * This groupe contains all Leaflet related files of the Maps extension.
 *
 * @defgroup Leaflet
 * @ingroup Maps
 */

/**
 * This file holds the hook and initialization for the Leaflet service.
 *
 * @file Leaflet.php
 * @ingroup Leaflet
 *
 * @licence GNU GPL v2+
 * @author Pavel Astakhov < pastakhov@yandex.ru >
 */

// Check to see if we are being called as an extension or directly
if ( !defined( 'MEDIAWIKI' ) ) {
    die( 'This file is an extension to MediaWiki and thus not a valid entry point.' );
}

// Specify the function that will initialize the parser function.
$wgHooks['MappingServiceLoad'][] = 'efMapsInitLeaflet';

$wgResourceModules['ext.maps.leaflet'] = array(
    'dependencies' => array( 'ext.maps.common' ),
    'localBasePath' => __DIR__,
    'remoteBasePath' => $egMapsScriptPath .  '/includes/services/Leaflet',
    'group' => 'ext.maps',
    'scripts' => array(
        'leaflet/leaflet.js',
        'jquery.leaflet.js',
        'ext.maps.leaflet.js',
        ),
    'styles' => array(
        'leaflet/leaflet.css',
        'leaflet/leaflet.ie.css',
	),
    'messages' => array(
        'maps-markers',
        'maps-copycoords-prompt',
        'maps-searchmarkers-text',
	),
    );

/**
 * Initialization function for the Leaflet service.
 *
 * @ingroup Leaflet
 *
 * @return true
 */
function efMapsInitLeaflet() {
    global $wgAutoloadClasses;

    $wgAutoloadClasses['MapsLeaflet'] = __DIR__ . '/Maps_Leaflet.php';

    MapsMappingServices::registerService( 'leaflet', 'MapsLeaflet' );
    $leafletMaps = MapsMappingServices::getServiceInstance( 'leaflet' );
    $leafletMaps->addFeature( 'display_map', 'MapsDisplayMapRenderer' );

    return true;
}
