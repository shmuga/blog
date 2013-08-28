<?
class Upload extends Controller
{
	public function validate($var)
	{
		if (!isset($var['upload']))
			return false;
		$type=$var['upload']['type'];
		$type=explode("/",$type)[1];
		if ($type!=="jpg"&&$type!=="gif"&&$type!=="jpeg")		
			return false;
		return true;
	}

	public function index()
	{
		if ($this->validate($_FILES))
		{
			$uploaddir = 'uploads/';
			$rez=explode("/", $_FILES['upload']['type'])[1];
			if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploaddir . md5($_FILES['upload']['name'] . date("c") . "." . $rez)) {
					
	    			print $uploaddir . md5($_FILES['upload']['name'] . date("c") . "." . $rez;
			}
			else print "There some errors!";
		}
		else  echo "File is not present or incorrect type";
	}
}
