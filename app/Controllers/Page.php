<?php namespace App\Controllers;

class Page extends BaseController
{
	public function index()
	{
		$uri = $this->request->uri->getSegment(2);
		if ($uri == ''){
			echo "error";
		} else {
			$page = $this->base->page($uri);
			if ($page == false || $page['active'] != 'Y'){
				return $this->lib->render('base', '404');
			}
			$data = array_merge($page);
			return $this->lib->render('base', 'page', $data);
		}
	}
}
