<?php
/**
 * Provides static methods for determining the desired class to call.
 *
 * @author Bill Bushey<wbushey@acm.org>
 * Last Updated 01/03/2009
 */

abstract class boris_ClassLoader{
    
    /**
     * Loads and returns the desired view class based on the provided uri.
     * The provided GET and POST arguments will be passed on to the view.
     *
     * @param string $uri
     * @param string $get_args
     * @param string $post_args
     * @return boris_View
     */
    public static function loadClass($uri, $get_args, $post_args){
        $names = boris_ClassLoader::getNames($uri);
        if (!file_exists($names['class_file'])) throw new Exception('Sorry, the provided address could not be found.', 404);
    
        return new $names['class_name']($get_args, $post_args);
    }
    
    /**
     * Derives the desired filename and class name from the provided URI.
     * 
     * If the provided URI does not specify a view then the method will default
     * to /main.
     * 
     * The method returns an array with two elements:
     *      ['class_name'] = Name of the desired class
     *      ['class_file'] = Path to the desired file
     *
     * @param string $uri
     * @return array
     */
    public static function getNames($uri){
        global $appConf;
        
        $req = explode('?', $uri);
        $path = explode ('/', $req[0]);
        $path = array_slice($path, array_search($appConf['controller_name'], $path) + 1);
        
        // Make the default destination /main
        if (!isset($path[0])) $path[0] = 'main';
        
        // Get the destination class name and filename
        $class_file = '';
        for ($i = 0; $i < count($path); ++$i){
            $class_file .= $path[$i] . '/';
        }
        $class_name = $appConf['namespace'] . '_' . ucwords(end($path)) . 'View';
        $class_file .= $class_name . '.php';
        
        return array('class_name' => $class_name, 'class_file' => $class_file);
    }
    
	/**
	 * Autoload callback function for classes in the site's namespace. 
	 * The function loads site classes by performing a file system search 
	 * (find -iname) within the site/ folder.
	 *
	 * @param unknown_type $class
	 */
	public static function autoload($class){
	    global $appConf;
	    
	    /*
	    ***Debugging***
	    echo "<br/>Requested Class:";
	    print_r($class);
        */
        
	    
		// This function only handles classes in the correct namespace
		if (strpos($class, $appConf['namespace']) === FALSE) return false;
		
		// Modify string, search, and load the file
		$filename = $class . '.php';
		
		//exec('find ' . $appConf['site_path'] . ' -name ' . $filename, $return_output, $return_value);
		//$cmd = 'find ' . $appConf['site_path'] . ' -iname ' . $filename;
		//$result = trim(`$cmd`);
		$results = boris_ClassLoader::find_files($appConf['site_path'], $filename);
		/*
         ***Debugging***
        echo "<br/>Backtick Path:";
        var_dump($result);
        */
		
		/*
		 ***Debugging***
		echo "<br/>Exec Path:";
		var_dump($return_output[0]);
		
		echo "<br/>Are they equal:" . strcmp($result, $return_output[0]);
        */
        
		require($results[0]);
	}

    private static function find_files($path, $search_name){
        $matches = array();
        $entries = array();
        $dir = dir($path);
        while (false !==($entry = $dir->read())) $entries[] = $entry;
        $dir->close();
        
        foreach($entries as $entry){
            $fullname = $path . '/' . $entry;
            if ($entry != '.' && $entry != '..' && is_dir($fullname)){
                $matches = array_merge($matches, boris_ClassLoader::find_files($fullname, $search_name));
            } else {
                if(is_file($fullname) && $search_name == $entry){
                    $matches[] = $fullname;
                }
            }
        }
        return $matches;
    }
}
?>
