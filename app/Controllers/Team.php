<?php namespace App\Controllers;

class Team extends BaseController
{
	public function index()
	{
		return $this->lib->render('base', 'team');
	}
}
