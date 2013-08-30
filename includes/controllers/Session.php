<?
class Session extends Controller
{
	public function index(){}
	public function start()
	{
		session_start();
		if (isset($_SESSION['id'])&&isset($_SESSION['password']))
		{
			echo '<meta http-equiv="refresh" content="0;index.php?r=Admin/index">';
		}
		else if (isset($_POST['login']))
			{
				$user = new Users;
				$user->login = $_POST['login'];
				$user->password = $_POST['password'];
				if ($user->validate())
				{
					$_SESSION['id'] = $user->id;
					$_SESSION['password'] = $user->password;
					session_set_cookie_params(60 * 60);	
					echo '<meta http-equiv="refresh" content="0;index.php?r=Admin/index">';
				}
			}
			else return false;
	}

	public function check()
	{
		session_start();
		if (isset($_SESSION['id'])&&isset($_SESSION['password']))
		{

		}
		else
		{			
			echo "<meta http-equiv=\"refresh\" content=\"0;URL='index.php?r=Admin/login'\">";	    	
		}

	}

	public function close()
	{
		session_start();
		session_unset();
		session_destroy();
	}
}