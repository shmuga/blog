<?
class Template
{
	private $registry;
	private $vars=array();

	public function __construct($registry)
	{
		$this->registry=$registry;
	}

	public function set($varname, $value, $overwrite=false) 
	{
        if (isset($this->vars[$varname]) == true AND $overwrite == false) 
        {
                trigger_error ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
                return false;
        }

        $this->vars[$varname] = $value;
        return true;
	}

	public function remove($varname) 
	{
        unset($this->vars[$varname]);
        return true;
	}

	public function unsetAll()
	{
		$this->vars=array();
	}

	public function show($name) 
	{
        $path = site_path . 'includes' . DIRSEP . 'views' . DIRSEP . $name . '.php';
        if (file_exists($path) == false) 
        {
                trigger_error ('Template `' . $name . '` does not exist.', E_USER_NOTICE);
                return false;
        }

        // Load variables
        foreach ($this->vars as $key => $value) 
        {
                $$key = $value;
        }
        include ($path);               
	}

	public function header()
	{
		include('main/header.php');
	}

	public function headerAdmin()
	{
		include('main/header_admin.php');
	}

	public function footer()
	{
		include('main/footer.php');
	}

	public function pagination($url, $num_links=3,$per_page=10)
	{
		$post = new Posts();
		$total = $post->countPosts();
		$start_row = (!empty($_GET['p']))? intval($_GET['p']): 0;

		if($start_row < 0) $start_row = 0;
		if($start_row > $total) $start_row = $total;

	    //all pages count
	    $num_pages = ceil($total/$per_page);
	 	//

	    if ($num_pages == 1) return '';
	 
	    //num of elements
	    $cur_page = $start_row;
	 	//
	  
	    if ($cur_page > $total){
	        $cur_page = ($num_pages - 1) * $per_page;
	    }
	 
	  	//current page number
	    $cur_page = floor(($cur_page/$per_page) + 1);
	 	//
	    //start number
	    $start = (($cur_page - $num_links) > 0) ? $cur_page - $num_links : 0;
	    //
	    //last number
	    $end   = (($cur_page + $num_links) < $num_pages) ? $cur_page + $num_links : $num_pages;
	 	//
	    $output = '<div class="pagination" align="center">';
	 	$output.= '<ul>';
	   
	    //make link for previous
	    if  ($cur_page != 1){
	        $i = $start_row - $per_page;
	        if ($i <= 0) $i = 0;
	        $output .= '<li class="previous"><a href="'.$url.'p='.$i.'"><span class="arrow"><</span></a></li>';
	    }
	    else{
	        $output .='<li class="previous"><a href=""><span class="arrow"><</span></a></li>';
	    }
	    //	    

	    //make link for 1 page
	    if  ($cur_page > ($num_links + 1)){
	        $output .= '<li><a href="'.$url.'" title="first">F.</a></li>';
	    }
	 	//

	    //make list of page with 1 and last page
	        for ($loop = $start; $loop <= $end; $loop++){
	        $i = ($loop * $per_page) - $per_page;
	 
	        if ($i >= 0)
	        {
	            if ($cur_page == $loop)
	            {
	               //current page
	               $output .= '<li class="active"><a href="">'.$loop.'</a></li>';
	               //
	            }
	            else
	            {
	 
	               $n = ($i == 0) ? '0' : $i;
	 
	               $output .= '<li> <a href="'.$url.'p='.$n.'">'.$loop.'</a></li>';
	            }
	        }	      
	    }
	 	//	 	
	    //make link for last page
	    if (($cur_page + $num_links) < $num_pages){
	        $i = (($num_pages * $per_page) - $per_page);
	        $output .= '<li><a href="'.$url.'p='.$i.'">L.</a></li>';
	    }
	    //
	     //make link for next page
	    if ($cur_page < $num_pages){
	        $output .= '<li class="next"><a href="'.$url.'p='.($cur_page * $per_page).'"><span class="arrow">></span></a></li>';
	    }
	    else{
	        $output .='<li class="next"><a href=""><span class="arrow">></span></a></li>';
	    }	   
	 	//
	 	$output .= '</ul></div>';
	    return $output;
	}
}
?>