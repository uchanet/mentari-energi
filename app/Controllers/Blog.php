<?php namespace App\Controllers;

class Blog extends BaseController
{
	public function index()
	{
		return $this->lib->render('base', 'blog_list');
	}

	public function category()
	{
		$this->lib->render('base', 'blog_category');
	}

	public function tag()
	{
		$this->lib->render('base', 'blog_tag');
	}

	public function search()
	{
		if ($_POST){
			return redirect()->to(site_url().'blog/search/'.sanitize_filename($_POST['search']));
		}
		$uri = $this->request->uri->getSegment(3);
		if ($uri == ''){
			echo "error";
		} else {
			$this->lib->render('base', 'blog_search');
		}
	}

	public function post()
	{
		$uri = $this->request->uri->getSegment(3);
			$post = $this->base->post($uri);
			if ($_POST){
				$comment['post'] = $this->request->getPost('id');
				$comment['parent'] = $this->request->getPost('parent');
				if (!isset($this->session->username) && !isset($this->session->useremail)){
					$comment['name'] = $this->request->getPost('name');
					$comment['email'] = $this->request->getPost('email');
				} else {
					$comment['name'] = $this->session->username;
					$comment['email'] = $this->session->useremail;
					$comment['seen'] = 'Y';
					if (!empty($comment['parent'])){
						$reply['id'] = $comment['parent'];
						$reply['seen'] = 'Y';
						$this->base->add('post_comment', $reply);
					}
				}
				$comment['message'] = $this->request->getPost('message');
				if($this->validation->run($comment, 'postcomment')){
					$this->base->add('post_comment', $comment);
					return redirect()->to(previous_url().'#comment')->with('message', 'Comment posted.');
				}
			}
			if ($post == false || $post['active'] != 'Y'){
				return $this->lib->render('base', '404');
			}
			$message = [
				'message' => $this->validation,
			];
			$data = array_merge($post, $message);
			return $this->lib->render('base', 'blog_post', $data);
	}
}
