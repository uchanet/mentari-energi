<?php namespace App\Controllers;

class Contact extends BaseController
{
	public function index()
	{
		if ($_POST){
			if($this->validation->run($_POST, 'postmessage')){
				$data['name'] = sanitize_filename($this->request->getPost('name'));
				$data['subject'] = sanitize_filename($this->request->getPost('subject'));
				$data['email'] = sanitize_filename($this->request->getPost('email'));
				$data['message'] = sanitize_filename($this->request->getPost('message'));
				$data['ip'] = $this->request->getIPAddress();
				$data['target'] = $this->admin->getConfig()['sitemail'];
				$data = $this->base->add('contact', $data);
				return redirect()->to(previous_url())->with('message', 'Message sent.');
			}
		}
		$data = [
			'message' => $this->validation,
		];
		$this->lib->render('base', 'contact', $data);
	}

	//--------------------------------------------------------------------

}
