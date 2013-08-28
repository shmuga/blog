<?
class Admin extends Controller
{
	public function index()
	{
		$this->registry['template']->show("admin");
	}
}