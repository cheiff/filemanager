<?php

error_reporting(0); // Set E_ALL for debuging
/*
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';
*/
// Required for MySQL storage connector 
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeMySQL.class.php';
// Required for FTP connector support
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';

/**
 * # Dropbox volume driver need "dropbox-php's Dropbox" and "PHP OAuth extension" or "PEAR's HTTP_OAUTH package"
 * * dropbox-php: http://www.dropbox-php.com/
 * * PHP OAuth extension: http://pecl.php.net/package/oauth
 * * PEAR's HTTP_OAUTH package: http://pear.php.net/package/http_oauth
 *  * HTTP_OAUTH package require HTTP_Request2 and Net_URL2
 */
// Required for Dropbox.com connector support
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeDropbox.class.php';

// Dropbox driver need next two settings. You can get at https://www.dropbox.com/developers
// define('ELFINDER_DROPBOX_CONSUMERKEY',    '');
// define('ELFINDER_DROPBOX_CONSUMERSECRET', '');
// define('ELFINDER_DROPBOX_META_CACHE_PATH',''); // optional for `options['metaCachePath']`

/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from '.' (dot)
 *
 * @param  string  $attr  attribute name (read|write|locked|hidden)
 * @param  string  $path  file path relative to volume root directory started with directory separator
 * @return bool|null
 **/
function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}


// Documentation for connector options:
// https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
$opts = array(
	// 'debug' => true,
	'roots' => array(
		array(
			'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
			'path'          => '../assets/',         // path to files (REQUIRED)
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/../assets/', // URL to files (REQUIRED)
			//'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL)
		    //'tmbPathMode'   => '0000'// have to create dir with 755 first
            'tmpPath' => 'tmp',
        ),
        array(
			'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
			'path'          => '../../fuel/',         // path to files (REQUIRED)
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/../../fuel/', // URL to files (REQUIRED)
			//'accessControl' => 'access',             // disable and hide dot starting files (OPTIONAL)
		    //'tmbPathMode'   => '0000'// have to create dir with 755 first
            'tmpPath' => 'tmp',
        ),
		array(
			'driver' => 'FTP',
			'host' => 'localhost',
			'user' => 'dev@deevop.com',
			'pass' => 'kn5czhm3p8cp',
			'path' => '/',
			'tmpPath' => 'tmp',
		 	'alias'    => 'Develop',
             //'accessControl' => 'access',
             //'icon'          => '/assets/img/elfinder/volume_icon_ftp.png'
            //'imgLib'     => 'gd',
           // 'tmbPath'    => '../tmp',
            //'tmbCrop'    => false,
		),

		array(
			'driver' => 'FTP',
			'host' => 'localhost',
			'user' => 'demo@deevop.com',
			'pass' => 'kn5czhm3p8cp',
			'path' => '/',
			//'tmpPath' => '../tmp',
            'tmbAtOnce'    => 5,
		 	'alias'    => 'Demo',
		),

		array(
			'driver' => 'FTP',
			'host' => 'localhost',
			'user' => 'production@deevop.com',
			'pass' => 'kn5czhm3p8cp',
			'path' => '/',
			//'tmpPath' => '../tmp',
		 	'alias'    => 'Production/Live',
		),
	)
);

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

