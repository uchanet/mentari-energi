<?php namespace App\Controllers;

class Base extends BaseController
{
	public function index()
	{
		return $this->lib->render('base', 'home');
	}

	//--------------------------------------------------------------------

}
