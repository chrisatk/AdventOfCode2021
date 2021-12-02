<?php
class Autoloader
{
    public static function loader( $class, $dir = null ) {
    	
    	// If no directory is specified, use the default /Classes/MyClasses/ folder
    	if ( is_null( $dir ) ) {
    		$dir = $_SERVER['DOCUMENT_ROOT'].'/advent_of_code/2021/Classes/';
    	}

    	foreach ( scandir( $dir ) as $file ) {
    		// Check to see if it's a directory first and recursively call the loader on the child directory
    		if ( is_dir( $dir.$file ) && substr( $file, 0, 1 ) !== '.' ) {
        		loader( $class, $dir.$file.'/' );
    		}

    		// If it's a PHP file, include it provided it's not a hidden file
    		if ( substr( $file, 0, 2 ) !== '._' && preg_match( "/.php$/i" , $file ) ) {
       			// Check to see if the file name matches the class and load it
        		if ( str_replace( '.php', '', $file ) == $class ) {
            		include $dir . $file;
        		}
       		}

    	}
    }
}

spl_autoload_register( 'Autoloader::loader' );
?>