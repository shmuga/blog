<?php

class Registry  Implements ArrayAccess 
{
	private $vars=array();

	function set($key, $var) 
	{
        if (isset($this->vars[$key]) == true) 
        {
                throw new Exception('Unable to set var `' . $key . '`. Already set.');
        }
        $this->vars[$key] = $var;
        return true;
	}

	public function get($key) 
	{
    	if (isset($this->vars[$key]) == false) 
    	{
            return null;
    	}
    	return $this->vars[$key];
	}

	public function remove($var) 
	{
        unset($this->vars[$key]);
	}

	public function offsetExists($offset) 
	{
        return isset($this->vars[$offset]);
	}

	public function offsetGet($offset) 	
	{
	        return $this->get($offset);
	}

	public function offsetSet($offset, $value) 
	{
	        $this->set($offset, $value);
	}

	public function offsetUnset($offset) 
	{
	   unset($this->vars[$offset]);
	}
}

?>