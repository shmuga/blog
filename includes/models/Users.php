<?php
class Users
{
	public $id;
	public $login;
	public $password;

	public function exist()
	{		
		$rez = mysql_query("SELECT * FROM `users` WHERE `login` = \"{$this->login}\"");		
		if ($rez)
			if (mysql_num_rows($rez))
			{					
				return $rez;
			}
			else
			{
				return false;
			}
		else return false;

	}

	public function validate()
	{
		if ($rez = $this->exist)
		{
			$rez = mysql_fetch_array($rez);
			if ($this->password === $rez[2])
				return true;
			else return false;
		}
		else return false;
	}
}
?>