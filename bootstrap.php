<?php

Autoloader::add_core_namespace('Filemanager');

Autoloader::add_classes(array(
    /**
	 * Filemanager classes.
	 */
//	'Filemanager\\connector'						=> __DIR__.'/classes/connector.php',
//	'Filemanager\\connector.minimal'				=> __DIR__.'/classes/connector.minimal.php',
    
	'Filemanager\\elFinder'			                => __DIR__.'/classes/elFinder.class.php',
	'Filemanager\\elFinderConnector'				=> __DIR__.'/classes/elFinderConnector.class.php',
	'Filemanager\\elFinderVolumeDriver'		    	=> __DIR__.'/classes/elFinderVolumeDriver.class.php',
	'Filemanager\\elFinderVolumeLocalFileSystem'	=> __DIR__.'/classes/elFinderVolumeLocalFileSystem.class.php',
	'Filemanager\\elFinderVolumeFTP'				=> __DIR__.'/classes/elFinderVolumeFTP.class.php',
	'Filemanager\\elFinderVolumeDropbox'			=> __DIR__.'/classes/elFinderVolumeDropbox.class.php',
));
