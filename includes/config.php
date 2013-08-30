<?php
function __autoload($class_name) {
        $filename = $class_name . '.php';
        $file = site_path . 'includes' . DIRSEP . 'classes' . DIRSEP . $filename;
        if (file_exists($file) == false) 
        {        		
        	$file=$file = site_path . 'includes' . DIRSEP . 'models' . DIRSEP . $filename;
        	if (file_exists($file) == false)
        	{
        		$file=$file = site_path . 'includes' . DIRSEP . 'controllers' . DIRSEP . $filename;
        		if (file_exists($file) == false)
        		{        
        			$file=$file = site_path . 'includes' . DIRSEP . 'views' . DIRSEP . $filename;
        			if (file_exists($file) == false)
        			{
        			return false;
	        		}
	        	}
        	}            
        }

        include ($file);
}

//creating registry
$registry = new Registry;
//

//connect database
$db = new Database();
$registry['db'] = $db;
//

//creating templater
$template=new Template($registry);
$registry['template'] = $template;
//

//creating session class
$session=new Session($registry);
$registry['session'] = $session;
//

//creating router and adding pass to controllers , start delegate
$router = new Router($registry);
$registry['router'] = $router;
$router->setPath (site_path . 'includes'. DIRSEP . 'controllers');
$router->delegate();
//
?>