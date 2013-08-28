<?php
class Themes
{
	public $id;
	public $theme;

	public function validate()
	{
		if ($this->theme === "")
			return false;
		return true;
	}

	public function exist()	
	{
		if ($this->validate())
		{
			$rez = mysql_query("SELECT * FROM `themes` WHERE `name` = \"{$this->theme}\"");		
			if ($rez)
				if (mysql_num_rows($rez))
				{					
					return true;
				}
				else
				{
					return false;
				}
			else return false;
		}
	}

	public function createTheme()
	{		
		if (!$this->exist())
		{				
			mysql_query("INSERT INTO `themes`(`name`) VALUES(\"{$this->theme}\")");
		}
		else return false;
	}

		
	public function deleteTheme()
	{
		if ($this->exist())
		{
			mysql_query("DELETE FROM `themes` WHERE `name` = \"{$this->theme}\"");
			mysql_query("UPDATE `posts` SET `theme_id` = \"0\" WHERE `theme_id` = \"{$this->id}\"");
		}
		else return false;
	}

	public function readAllThemes()
	{
		if ($this->validate())
		{
			$result = mysql_query("SELECT * FROM `themes`");
			while ($row = mysql_fetch_assoc($result)) 
			{		
				$items[] = $row;			
			}
			return $items;
		}
		else return false;
	}

	public function readThemeByName()
	{
		if ($this->validate())
		{
			$result = mysql_query("SELECT * FROM `themes` WHERE `name` = \"{$this->theme}\"");		
			$result = mysql_fetch_array($result);		
			$this->id = $result[0];
		}
		else return false;
	}

	public function countPostsWithTheme()
	{
		$rez = mysql_query("SELECT COUNT(*) AS numrows FROM `posts` WHERE `theme_id` = \"$this->id\"");		
		return mysql_fetch_row($rez)[0];
	}

}
?>