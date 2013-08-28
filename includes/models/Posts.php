<?php
class Posts
{
	public $post_id;
	public $theme_id;
	public $title;
	public $text;
	public $date_created;
	public $show;
	//for tags and theme name input
	public $theme_name;
	public $tags;
	//

	//validation of input data
	public function validate()
	{
		if ($this->title === "")
			$this->title = "untitled";
		$this->date_created = date("Y-m-d H:i:s");
		if (!isset($this->show))
			$this->show = true;
		return true;
	}
	//

	public function createPost()
	{
		//getting theme id from base by it's name
		$theme = new Themes();		
		$theme->theme = $this->theme_name;
		$theme->readThemeByName();
		$this->theme_id = $theme->id;		
		//
		//validating and creating row in posts table
		if ($this->validate() || $this->theme_id !== "")
		{			
			mysql_query("INSERT INTO `posts`(`theme_id`,`title`,`text`,`date_created`,`show`) "
					. "VALUES(\"{$this->theme_id}\",\"{$this->title}\",\"{$this->text}\","
					. "\"{$this->date_created}\",\"{$this->show}\")");
			//get last auto incremented id of post
			$this->post_id = mysql_insert_id();
			echo "post id " . $this->post_id;
			//
		}
		//
		//for each tag creating row in table tags and put there id of this post
		foreach ($this->tags as $key => $value) 
		{
			$tag = new Tags();
			$tag->post_id = $this->post_id;
			$tag->tag = $value;
			$tag->createTag();			
		}
		//
	}

	public function deletePost()
	{
		//deleting post and all tags connected with it
		if ($this->post_id !== "")
		{		
			mysql_query("DELETE FROM `tags` WHERE `post_id` = \"{$this->post_id}\"");
			mysql_query("DELETE FROM `posts` WHERE `post_id` = \"{$this->post_id}\"");
		}
		//
	}

	// public function updatePost($theme_name,$tags)
	// {	
	// 	//getting theme id from base by it's name
	// 	$theme=new Themes();
	// 	$theme->theme=$theme_name;
	// 	$theme->readThemeByName();
	// 	$this->theme_id=$theme->id;		
	// 	//
	// 	//deleting all tags by post_id and updating row after creating new tags
	// 	if ($this->post_id!==""||$this->theme_id!=="")
	// 	{
	// 		//deleting tags
	// 		$tag=new Tags();
	// 		$tag->post_id=$this->post_id;
	// 		$tag->deleteTagByPostId();
	// 		//
	// 		//updating row
	// 		mysql_query("UPDATE `posts` SET `theme_id`=\"{$this->theme_id}\","
	// 		."`title`=\"{$this->title}\",`text`=\"{$this->text}\","
	// 			."`show`=\"{$this->show}\"");
	// 		//
	// 		//creating new tags
	// 		foreach ($tags as $key => $value) 
	// 		{
	// 			$tag=new Tags();
	// 			$tag->post_id=$this->post_id;
	// 			$tag->tag=$value;
	// 			$tag->createTag();			
	// 		}
	// 		//
	// 	}
	// 	//
	// }

	//return all post info in one array
	public function getAllPostAsArray()
	{	
		return array('post_id' => $this->post_id,
					 'theme_id' => $this->theme_id,
					 'title' => $this->title,
					 'text' => $this->text,
					 'date_created' => $this->date_created,				
			);
	}
	//

	public function readPost()
	{		
		//getting post from base and put it to vars
		if (isset($this->post_id) || $this->post_id !== "")
		{
			$rez = mysql_query("SELECT * FROM `posts` WHERE `post_id` = \"{$this->post_id}\"");
			$rez = mysql_fetch_array($rez);
		}		
		$this->post_id = $rez[0];
		$this->theme_id = $rez[1];
		$this->title = $rez[2];
		$this->text = $rez[3];
		$this->date_created = $rez[4];
		$this->show = $rez[5];
		//
	}

	//switch show row to 1 in that post which we need to show by theme_id
	public function showPostThemeId()
	{
		if ($this->validate())
		{
			mysql_query("UPDATE `posts` SET `show` = \"0\"");
			mysql_query("UPDATE `posts` SET `show` = \"1\" WHERE `theme_id` = \"{$this->theme_id}\"");
		}
	}
	//
	
	// such as showPostThemeId but with tags
	public function showPostTag($tag)
	{
		$tags = new Tags();
		$tags->tag = $tag;
		$tags = $tags->readTagByName();	
		if ($this->validate() || $tags)
		{
			mysql_query("UPDATE `posts` SET `show` = \"0\"");
			while ($row = mysql_fetch_array($tags))
			{				
				mysql_query("UPDATE `posts` SET `show` = \"1\" WHERE `post_id` = \"{$row[1]}\"");
			}		
		}
	}
	//
	//make show=1 in that posts we need to see
	public function showAll()
	{
		mysql_query("UPDATE `posts` SET `show` = 1");
	}
	//
	//count all the posts
	public function countPosts()
	{
		$rez = mysql_query("SELECT COUNT(*) AS numrows FROM `posts` WHERE `show` = \"1\"");		
		$rez = mysql_fetch_row($rez);
		return $rez[0];
	}
	//
	//return an array of posts including paging
	public function getPosts($page = 0)
	{			
		$rez = mysql_query("SELECT * FROM `posts` WHERE `show` = \"1\" ORDER BY date_created DESC LIMIT $page,10");
		$items = array();
		while ($row = mysql_fetch_assoc($rez)) 
		{
			$items[] = $row;
		}
		return $items;
	}
	//
	//getting all posts
	public function getAllPosts()
	{
		$rez = mysql_query("SELECT * FROM `posts` ORDER BY date_created DESC");
		$items = array();
		while ($row = mysql_fetch_assoc($rez)) 
		{		
			$items[] = $row;
		}
		return $items;
	}
	//
}
?>
