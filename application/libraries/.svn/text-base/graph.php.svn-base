<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Provides a factory for Open Flash Chart2 objects
 *
 * @package CodeIgniter
 * @subpackage Open Flash Chart 2
 * @category Library
 * @author thomas(at)kbox.ch
 */
class Graph
{
    /**
     * Constructor
     * 
     * Loads OFC2 class definition files. Need to change working directory
     * temporarily, so that the links within the original class files work
     * for loading
     */
	
    public function __construct()
    {
        $old_libraries = getcwd();
        chdir(dirname(__FILE__)); //change cwd to the dir of this file
        include_once 'php-ofc-library/open-flash-chart.php';
        require_once('php-ofc-library/open-flash-chart.php');
        chdir($old_libraries);
    }

    /**
     * Creates OFC2 objects from a passed classname and optional
     * array of arguments
     *
     * @param string $classname
     * @param array $arguments
     * @return mixed
     */
    public function create($classname, $arguments = array())
    {
        // check if class is defined
        if (class_exists($classname))
        {
            return call_user_func_array(
                    array(new ReflectionClass($classname), 'newInstance'),
                    $arguments
                   );
        }
        else
        {
            die("Sorry can't create the object, class [$classname] not defined");
        }
    }
} 