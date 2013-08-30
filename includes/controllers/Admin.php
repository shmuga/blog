<?
class Admin extends Controller
{
	public function login()	
	{
		$this->registry['session']->start();
		$this->registry['template']->show("login");
		$this->registry['template']->unsetAll();
	}

	public function index()
	{
		//checking if user auth
		$this->registry['session']->check();
		//
		$posts = new Posts;
		$posts->showAll();
		if (isset($_GET['p']))
		{
			$p = $posts->getPosts($_GET['p']);
		}
		else $p = $posts->getPosts();
		$this->registry['template']->set('post',$p);		
		$this->registry['template']->set('controler','r=Admin/index&');
		$this->registry['template']->show("admin");
		$this->registry['template']->unsetAll();
	}

	public function logout()
	{	
		$this->registry['session']->close();
		echo '<meta http-equiv="refresh" content="0;index.php?r=Admin/login">';
	}

	public function addPostIndex()
	{
		//checking if user auth
		$this->registry['session']->check();
		//
		$theme = new Themes();
		$theme = $theme->readAllThemes();
		$this->registry['template']->set('theme',$theme);
		$this->registry['template']->show("addpost");
		$this->registry['template']->unsetAll();
	}

	public function addPost()
	{
		//checking if user auth
		$this->registry['session']->check();
		//
		$post = new Posts();
		$post->title = $_POST['title'];
		$post->theme_name = $_POST['theme_name'];
		$post->text = $_POST['text'];
		$post->createPost();
		echo '<meta http-equiv="refresh" content="0;index.php?r=Admin/index">';
	}

	public function editPostIndex()
	{
		//checking if user auth
		$this->registry['session']->check();
		//
		if (isset($_GET['post_id']))
		{
			$post=new Posts;
			$post->post_id=$_GET['post_id'];
			$post->readPost();			
			$theme = new Themes();
			$theme = $theme->readAllThemes();
			$this->registry['template']->set('theme',$theme);
			$this->registry['template']->set('post',$post);
			$this->registry['template']->show("editpost");
			$this->registry['template']->unsetAll();

		}
		else return false;
	}

	public function editPost()
	{
		//checking if user auth
		$this->registry['session']->check();
		//
		$post = new Posts();
		$post->post_id = $_POST['post_id'];
		$post->title = $_POST['title'];
		$post->theme_name = $_POST['theme_name'];
		$post->text = $_POST['text'];
		$post->updatePost();
		echo '<meta http-equiv="refresh" content="0;index.php?r=Admin/index">';
	}

	public function deletePost()
	{
		//checking if user auth
		$this->registry['session']->check();
		//
		if (isset($_GET['post_id']))
		{
			$post = new Posts();
			$post->post_id = $_GET['post_id'];
			$post->deletePost();
		}
		echo '<meta http-equiv="refresh" content="0;index.php?r=Admin/index">';
	}

	public function topics()
	{
		//checking if user auth
		$this->registry['session']->check();
		//
		if (isset($_POST['topic']))
			{
				$theme=new Themes;
				$theme->theme=$_POST['topic'];
				$theme->createTheme();
			}
		$theme=new Themes;
		$theme=$theme->readAllThemes();
		$this->registry['template']->set('theme',$theme);
		$this->registry['template']->show("admintopics");
		$this->registry['template']->unsetAll();
	}

	public function deleteTopic()
	{
		if (isset($_GET['id']))
		{
			$theme=new Themes;
			$theme->id=$_GET['id'];
			$theme->deleteTheme();
		}
		echo '<meta http-equiv="refresh" content="0;index.php?r=Admin/topics">';
	}

}