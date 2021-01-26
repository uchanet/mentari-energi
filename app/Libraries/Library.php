<?php namespace App\Libraries;
use App\Models\Admin_model;

class Library
{
	public function __construct()
	{
		$this->session = session();
		$this->admin = new Admin_model();
	}

	public function getAuthor($data)
	{
		$result = $this->admin->getUser($data);
		return $result['name'];
	}

	public function getCategory($data)
	{
		$result = $this->admin->getData('post_category', $data);
		return $result['title'];
	}

	public function getRole($data)
	{
		$result = $this->admin->getData('role', $data);
		return $result['title'];
	}

	function isLogin()
	{
		if (isset($this->session->userid) && isset($this->session->username) && isset($this->session->userrole)){
			return false;
		} else {
			return true;
		}
	}

	function role($data = null)
	{
		foreach(json_decode($this->admin->getData('role', $this->session->userrole)['permission']) as $value) {
			if ($value[0] == uri_string()){
				$auth = [
					'read' => $value[1][0],
					'create' => $value[1][1],
					'change' => $value[1][2],
				];
			}
		}
		if (isset($auth[$data])){
			if ($auth[$data] == $this->session->userrole){
				return true;
			}
		} else {
			return true; // hapus else untuk blokir semua url yang tidak ada di permission
		}
	}

	public function render($path = '', $page = 'home', $content = array())
	{
        if (!is_file(APPPATH.'/Views/'.$path.'/'.$page.'.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

		$data['pagetitle'] = ucwords(((!empty($_GET['act'])) ? $_GET['act'] . str_replace("_"," ",$page) : str_replace("_"," ",(empty($content['title'])) ? $page : $content['title'])));
		$data['tag'] = (empty($content['tag'])) ? null : $content['tag'];
		$data['content'] = (empty($content['content'])) ? null : character_limiter(strip_tags($content['content']), 200);
		$data['config'] = $this->admin->getConfig();

		echo view($path.'/header', $data);
		if ($path == 'base' && $this->admin->getConfig()['sitemaintenance'] == 'Y' && $this->admin->getConfig()['sitemaintenancedate'] > date('Y-m-d H:i:s')){
			$data = $this->admin->getConfig();
			echo view('base/maintenance', $data);
		} else if ($path == 'admin' && $this->role('read') == FALSE){
			echo view('admin/_403', $data);
		} else {
			echo view($path.'/'.$page, $content);
		}
		echo view($path.'/footer');
	}

}
