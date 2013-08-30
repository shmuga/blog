<?php 

class Site extends Controller
{
	public function index()
	{	
		$posts=new Posts;
		$posts->showAll();
		if (isset($_GET['p']))
		{
			$p=$posts->getPosts($_GET['p']);
		}
		else $p=$posts->getPosts();
		$themes=new Themes;
		$this->registry['template']->set('themes_model',$themes);
		$themes=$themes->readAllThemes();
		$this->registry['template']->set('post',$p);
		$this->registry['template']->set('themes',$themes);
		$this->registry['template']->set('controler','r=Site/index&');
		$this->registry['template']->show("index");
		$this->registry['template']->unsetAll();
	}

	public function post()
	{
		if (isset($_GET['post_id']))
		{
			$posts=new Posts;
			$posts->post_id=$_GET['post_id'];
			$posts->readPost();
			$p=$posts->getAllPostAsArray();
			$themes=new Themes;
			$this->registry['template']->set('themes_model',$themes);
			$themes=$themes->readAllThemes();
			$this->registry['template']->set('post',$p);
			$this->registry['template']->set('themes',$themes);
			$this->registry['template']->show("readpost");
			$this->registry['template']->unsetAll();
		}
	}

	public function theme()
	{
		if (isset($_GET['theme_id']))
		{
			$posts=new Posts;
			$posts->theme_id=$_GET['theme_id'];
			$posts->showPostThemeId();
			if (isset($_GET['p']))
			{
				$p=$posts->getPosts($_GET['p']);
			}
			else $p=$posts->getPosts();
			$themes=new Themes;
			$this->registry['template']->set('themes_model',$themes);
			$themes=$themes->readAllThemes();
			$this->registry['template']->set('post',$p);
			$this->registry['template']->set('themes',$themes);
			$this->registry['template']->set('controler','r=Site/theme&theme_id=' . $_GET['theme_id'] . '&');
			$this->registry['template']->show("index");
			$this->registry['template']->unsetAll();
		}
	}

	public function topics()
	{
		$theme=new Themes;
		$theme=$theme->readAllThemes();
		$this->registry['template']->set('theme',$theme);
		$this->registry['template']->show("topics");
		$this->registry['template']->unsetAll();
	}

	public function search()
	{
		$posts=new Posts;		
		if (isset($_GET['search']))
		{
			$posts->search($_GET['search']);
			if (isset($_GET['p']))
			{
				$p=$posts->getPosts($_GET['p']);
			}
			else $p=$posts->getPosts();
			$themes=new Themes;
			$this->registry['template']->set('themes_model',$themes);
			$themes=$themes->readAllThemes();
			$this->registry['template']->set('post',$p);
			$this->registry['template']->set('themes',$themes);
			$this->registry['template']->set('controler','r=Site/search&search=' . $_GET['search'] . '&');
			$this->registry['template']->show("index");
			$this->registry['template']->unsetAll();
		}
		else if (isset($_POST['search']))
		{
			$posts->search($_POST['search']);
			if (isset($_GET['p']))
			{
				$p=$posts->getPosts($_GET['p']);
			}
			else $p=$posts->getPosts();
			$themes=new Themes;
			$this->registry['template']->set('themes_model',$themes);
			$themes=$themes->readAllThemes();
			$this->registry['template']->set('post',$p);
			$this->registry['template']->set('themes',$themes);
			$this->registry['template']->set('controler','r=Site/search&search=' . $_POST['search'] . '&');
			$this->registry['template']->show("index");
			$this->registry['template']->unsetAll();
		}
		else
		{	
			$this->registry['template']->show("search");
			$this->registry['template']->unsetAll();
		} 				
	}
}

?>