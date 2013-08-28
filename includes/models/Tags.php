<?
class Tags
{
	public $id;
	public $post_id;
	public $tag;

	public function validate()
	{
		if (!$this->id === "")
			return false;
		return true;
	}

	public function exist()	
	{
		if ($this->validate())
		{
			$rez = mysql_query("SELECT * FROM `tags` WHERE `name` = \"{$this->tag}\"");		
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

	public function createTag()
	{		
		if (!$this->exist())
		{				
			mysql_query("INSERT INTO `tags`(`post_id`,`name`) VALUES(\"{$this->post_id}\",\"{$this->tag}\")");
		}
		else return false;
	}
		
	public function deleteTagByName()
	{
		if ($this->exist())
		{
			mysql_query("DELETE FROM `tags` WHERE `name` = \"{$this->tag}\"");
		}
		else return false;
	}

	public function deleteTagByPostId()
	{
		if ($this->exist())
		{
			mysql_query("DELETE FROM `tags` WHERE `post_id` = \"{$this->post_id}\"");
		}
		else return false;
	}

	public function readAllTags()
	{
		if ($this->validate())
		{
			$result = mysql_query("SELECT * FROM `tags`");
			return mysql_fetch_array($result);
		}
		else return false;	
	}

	public function readTagByName()
	{
		if ($this->validate())
		{		
			$result = mysql_query("SELECT * FROM `tags` WHERE `name` = \"{$this->tag}\"");				
			return $result;
		}
		else return false;
	}	
}
?>