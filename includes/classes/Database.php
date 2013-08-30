<?
class DataBase
{
	private $hostname;
	private $username;
	private $password;
	private $base;

	private $dbhandle;

	public function __construct()
	{
		$this->hostname="localhost";
		$this->username="root";
		$this->password="16481657=vfhr=!";

		$this->base="blog";

		$db=mysql_connect($this->hostname,$this->username,$this->password)
			or die("Unable to connect to mysql base");

		$this->dbhandle=mysql_select_db($this->base,$db)
			or die("Couldn't find such base with name $this->base");	

		mysql_query("SET NAMES `utf8`");
	}
}
?>
