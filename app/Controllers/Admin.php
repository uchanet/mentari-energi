<?php

namespace App\Controllers;

use PHPExcel_Reader_CSV;
use PHPExcel_Reader_Excel2007;
use PHPExcel_Reader_Excel5;

class Admin extends BaseController
{
	public function index()
	{
		$data = $this->admin->graph();
		$data = [
			'totalvisitor' => json_encode($data[0]),
			'labelvisitor' => json_encode($data[1]),
			'countvisitor' => json_encode($data[2]),
			'sumvisitor' => json_encode($data[3]),
			'totaluser' => json_encode($data[4]),
			'totalpage' => json_encode($data[5]),
			'totalpost' => json_encode($data[6]),
			'totalcategory' => json_encode($data[7]),
			'totalcomment' => json_encode($data[8]),
			'totalmessage' => json_encode($data[9]),
		];

		return $this->lib->render('admin', 'home', $data);
	}

	public function setting()
	{
		if ($_POST) {
			if ($this->lib->role('change')) {
				if ($favicon = $this->request->getFile('siteicon')) {
					if ($favicon->isValid() && !$favicon->hasMoved()) {
						$image = \Config\Services::image()
							->withFile($favicon)
							->resize(32, 32)
							->save();
						if (file_exists('assets/images/favicon.png')) {
							unlink('assets/images/favicon.png');
						}
						$favicon->move('assets/images', 'favicon.png');
						$data['siteicon'] = 'favicon.png?v=' . random_string('alnum', 16);
					}
				}
				if ($logo = $this->request->getFile('sitelogo')) {
					if ($logo->isValid() && !$logo->hasMoved()) {
						$image = \Config\Services::image()
							->withFile($logo)
							->resize(160, 120)
							->save();
						if (file_exists('assets/images/sitelogo.png')) {
							unlink('assets/images/sitelogo.png');
						}
						$logo->move('assets/images', 'sitelogo.png');
						$data['sitelogo'] = 'sitelogo.png?v=' . random_string('alnum', 16);
					}
				}
				$data['sitename'] = sanitize_filename($this->request->getPost('sitename'));
				$data['sitemaintenance'] = $this->request->getPost('sitemaintenance');
				$data['sitemaintenancedate'] = $this->request->getPost('sitemaintenancedate');
				$data['sitedescription'] = sanitize_filename($this->request->getPost('sitedescription'));
				$data['sitetag'] = dasherize(underscore(sanitize_filename($this->request->getPost('sitetag'))));
				$data['sitemail'] = sanitize_filename($this->request->getPost('sitemail'));
				$data['smtphost'] = sanitize_filename($this->request->getPost('smtphost'));
				$data['smtpport'] = sanitize_filename($this->request->getPost('smtpport'));
				$data['smtpuser'] = sanitize_filename($this->request->getPost('smtpuser'));
				(!empty($this->request->getPost('smtppassword'))) ? $data['smtppassword'] = $this->request->getPost('smtppassword') : NULL;
				$data['sitephone'] = sanitize_filename($this->request->getPost('sitephone'));
				$data['siteaddress'] = sanitize_filename($this->request->getPost('siteaddress'));
				$data['sitegeolocation'] = sanitize_filename($this->request->getPost('sitegeolocation'));
				$data['sitefacebook'] = sanitize_filename($this->request->getPost('sitefacebook'));
				$data['siteinstagram'] = sanitize_filename($this->request->getPost('siteinstagram'));
				$data['sitetwitter'] = sanitize_filename($this->request->getPost('sitetwitter'));
				$data['sitelinkedin'] = sanitize_filename($this->request->getPost('sitelinkedin'));
				$this->admin->settings($data);
				return redirect()->to(site_url() . 'admin/setting')->with('success', 'Settings updated.');
			} else {
				return $this->lib->render('admin', '_403');
			}
		} else {
			$data = $this->admin->getConfig();
			return $this->lib->render('admin', 'setting', $data);
		}
	}

	public function post($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change')) {
					if ($this->validation->run($_POST, 'editpost')) {
						$post['id'] = sanitize_filename($this->request->getPost('id'));
						$post['title'] = sanitize_filename($this->request->getPost('title'));
						$post['url'] = sanitize_filename($this->request->getPost('url'));
						$post['content'] = $this->request->getPost('content');
						$post['picture'] = $this->request->getPost('picture');
						$post['category'] = $this->request->getPost('category');
						$post['tag'] = dasherize(underscore($this->request->getPost('tag')));
						if (empty($post['id'])) {
							$post['author'] = $this->session->userid;
							$post['role'] = $this->session->userrole;
						}
						$post['active'] = $this->request->getPost('active');
						if ($this->admin->urlExist('post', $post['id'], $post['url']) == FALSE) {
							$add = $this->admin->add('post', $post);
							if ($add == TRUE) {
								return redirect()->to(current_url())->with('success', 'Post ' . $post['title'] . ' saved.');
							}
						} else {
							if ($this->admin->urlExist('post', $post['id'], $post['url']) == TRUE) {
								$error = "URL " . $post['url'] . " has been exist!";
							}
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change') && isset($_GET['id'])) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('post', $uri);
					if ($result == false || $result['author'] <> $this->session->userid && $this->session->userrole <> 1) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_post', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_post', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('post', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'post');
		}
	}

	public function post_data($data = array())
	{
		$table = 'post';
		$primaryKey = 'id';

		$columns = array(
			array('db' => 'p.' . $primaryKey,			'dt' => 0, 'field' => $primaryKey),
			array(
				'db' => 'p.title',				'dt' => 1, 'field' => 'title',
				'formatter' => function ($d, $row) {
					if ($row['active'] == 'Y') {
						$active = '';
					} else {
						$active = '<span class="shadow-none badge badge-danger">Inactive</span> ';
					}
					return "<a href='" . site_url() . "blog/post/" . $row['url'] . "'>" . $active . character_limiter($d, 60) . "</a>";
				}
			),
			array(
				'db' => 'p.category',				'dt' => 2, 'field' => 'category',
				'formatter' => function ($d, $row) {
					return "<a href='" . site_url() . "category/" . (!empty($row['category_url'])) ? $row['category_url'] : NULL . "'>" . character_limiter($d, 60) . "</a>";
				}
			),
			array('db' => 'u.username',				'dt' => 3, 'field' => 'username'),
			array(
				'db' => 'created',				'dt' => 4, 'field' => 'created',
				'formatter' => function ($d, $row) {
					return date("d M Y H:i", strtotime($d));
				}
			),
			array(
				'db' => 'p.' . $primaryKey,			'dt' => 5, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="' . site_url() . "blog/post/" . $row['url'] . '">View</a>
									<a class="dropdown-item" href="?act=edit&id=' . $d . '">Edit</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
			array('db' => 'p.url',					'dt' => '', 'field' => 'url'),
			array('db' => 'c.title as category',	'dt' => '', 'field' => 'category'),
			array('db' => 'c.url as category_url',	'dt' => '', 'field' => 'category_url'),
			array('db' => 'p.active',					'dt' => '', 'field' => 'active'),
		);
		if ($this->session->userid == 1) {
			$joinQuery = "FROM post AS p LEFT JOIN post_category AS c ON (p.category = c.id) LEFT JOIN user AS u ON (u.id = p.author)";
			echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns, $joinQuery));
		} else {
			$joinQuery = "FROM post AS p LEFT JOIN post_category AS c ON (p.category = c.id) LEFT JOIN user AS u ON (u.id = p.author) WHERE p.author = '" . $this->session->userid . "'";
			echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns, $joinQuery));
		}
	}

	public function category($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change')) {
					if ($this->validation->run($_POST, 'editcategory')) {
						$category['id'] = sanitize_filename($this->request->getPost('id'));
						$category['title'] = sanitize_filename($this->request->getPost('title'));
						$category['url'] = sanitize_filename($this->request->getPost('url'));
						if (empty($category['id'])) {
							$category['author'] = $this->session->userid;
							$category['role'] = $this->session->userrole;
						}
						if ($this->admin->urlExist('post_category', $category['id'], $category['url']) == FALSE) {
							$add = $this->admin->add('post_category', $category);
							if ($add == TRUE) {
								return redirect()->to(current_url())->with('success', 'Category ' . $category['title'] . ' saved.');
							}
						} else {
							if ($this->admin->urlExist('post_category', $category['id'], $category['url']) == TRUE) {
								$error = "URL " . $category['url'] . " has been exist!";
							}
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change') && isset($_GET['id'])) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('post_category', $uri);
					if ($result == false || $result['author'] <> $this->session->userid && $this->session->userrole <> 1) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_category', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_category', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('post_category', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'category');
		}
	}

	public function category_data($data = array())
	{
		$table = 'post_category';
		$primaryKey = 'id';

		$columns = array(
			array('db' => $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array('db' => 'title',		'dt' => 1, 'field' => 'title'),
			array(
				'db' => 'url',		'dt' => 2, 'field' => 'url',
				'formatter' => function ($d, $row) {
					return "<a href='" . site_url() . "blog/category/" . $row['url'] . "'>" . character_limiter($d, 60) . "</a>";
				}
			),
			array(
				'db' => $primaryKey,	'dt' => 3, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="' . site_url() . "blog/category/" . $row['url'] . '">View</a>
									<a class="dropdown-item" href="?act=edit&id=' . $d . '">Edit</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
		);
		if ($this->session->userid == 1) {
			echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns));
		} else {
			$joinQuery = "FROM post_category WHERE author = '" . $this->session->userid . "'";
			echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns, $joinQuery));
		}
	}

	public function comment($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('change')) {
					if ($this->validation->run($_POST, 'replycomment')) {
						$comment['parent'] = sanitize_filename((empty($this->request->getPost('parent'))) ? $_GET['id'] : $this->request->getPost('parent'));
						$comment['post'] = sanitize_filename($this->request->getPost('post'));
						$comment['name'] = $this->session->username;
						$comment['email'] = '-';
						$comment['message'] = sanitize_filename($this->request->getPost('message'));
						$comment['seen'] = 'Y';
						$add = $this->admin->add('post_comment', $comment);
						if ($add == TRUE) {
							if (!empty($comment['parent'])) {
								$post['id'] = $comment['parent'];
								$post['seen'] = 'Y';
								$this->admin->add('post_comment', $post);
							}
							return redirect()->to(current_url())->with('success', 'Comment posted.');
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'reply' && isset($_GET['id'])) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('post_comment', $uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_comment', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('post_comment', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'comment');
		}
	}

	public function comment_data($data = array())
	{
		$table = 'post_comment';
		$primaryKey = 'id';

		$columns = array(
			array('db' => 'c.' . $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array('db' => 'name',			'dt' => 1, 'field' => 'name'),
			array('db' => 'email',			'dt' => 2, 'field' => 'email'),
			array(
				'db' => 'p.title',		'dt' => 3, 'field' => 'title',
				'formatter' => function ($d, $row) {
					return "<a href='" . site_url() . "blog/post/" . $row['url'] . "'>" . character_limiter($d, 60) . "</a>";
				}
			),
			array(
				'db' => 'date',			'dt' => 4, 'field' => 'date',
				'formatter' => function ($d, $row) {
					return date("d M Y H:i", strtotime($d));
				}
			),
			array(
				'db' => 'c.' . $primaryKey,	'dt' => 5, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="' . site_url() . "blog/post/" . $row['url'] . '#comment">View</a>
									<a class="dropdown-item" href="?act=reply&id=' . $d . '">Reply</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
			array('db' => 'p.url',			'dt' => '', 'field' => 'url'),
		);
		$joinQuery = "FROM post_comment AS c LEFT JOIN post AS p ON (c.post = p.id)";
		echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns, $joinQuery));
	}

	public function contact($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('change')) {
					if ($this->validation->run($_POST, 'sendmessage')) {
						$var = $this->admin->getConfig();
						$contact['name'] = $var['sitename'];
						$contact['subject'] = sanitize_filename($this->request->getPost('subject'));
						$contact['email'] = $var['sitemail'];
						$contact['target'] = sanitize_filename($this->request->getPost('email'));
						$contact['cc'] = sanitize_filename($this->request->getPost('cc'));
						$contact['message'] = $this->request->getPost('message');
						$contact['attachment'] = $this->request->getPost('attachment');
						$contact['ip'] = $this->request->getIPAddress();
						$contact['seen'] = 'Y';
						$add = $this->admin->add('contact', $contact);

						$config = [
							'mailType'	=> 'html',
							'charset'	 => 'utf-8',
							'protocol'	=> 'smtp',
							'SMTPHost' => $var['smtphost'],
							'SMTPUser' => $var['smtpuser'],
							'SMTPPass'	 => $var['smtppassword'],
							'SMTPCrypto' => 'ssl',
							'SMTPPort'	 => $var['smtpport'],
							'CRLF'		=> "\r\n",
							'newline' => "\r\n"
						];

						$email = \Config\Services::email();
						$email->initialize($config);
						$email->setFrom($var['sitemail'], $var['sitename']);
						$email->setTo($contact['target']);
						$email->setCC($contact['cc']);
						$email->setSubject($contact['subject']);
						$email->setMessage($contact['message']);
						if (!empty($contact['attachment'])) {
							foreach (json_decode($contact['attachment']) as $value) {
								$email->attach($value);
							}
						}

						if ($add == TRUE && $email->send()) {
							$message['id'] = sanitize_filename($_GET['id']);
							$message['seen'] = 'Y';
							$this->admin->add('contact', $message);
							return redirect()->to(current_url())->with('success', 'Reply sent.');
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'reply' && isset($_GET['id'])) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('contact', $uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_contact', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('contact', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'contact');
		}
	}

	public function contact_data($data = array())
	{
		$table = 'contact';
		$primaryKey = 'id';

		$columns = array(
			array('db' => $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array('db' => 'name',			'dt' => 1, 'field' => 'name'),
			array('db' => 'email',			'dt' => 2, 'field' => 'email'),
			array('db' => 'subject',		'dt' => 3, 'field' => 'subject'),
			array(
				'db' => 'date',			'dt' => 4, 'field' => 'date',
				'formatter' => function ($d, $row) {
					return date("d M Y H:i", strtotime($d));
				}
			),
			array(
				'db' => $primaryKey,	'dt' => 5, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="javascript:void(0);" id="read" data-id="' . $d . '" data-name="' . $row['name'] . '" data-email="' . $row['email'] . '" data-subject="' . $row['subject'] . '" data-date="' . $row['date'] . '" data-subject="' . $row['subject'] . '" data-message="' . $row['message'] . '" data-mailto="' . $row['target'] . '" data-toggle="modal" data-target="#readMessage">View</a>
									<a class="dropdown-item" href="?act=reply&id=' . $d . '">Reply</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
			array('db' => 'subject',		'dt' => '', 'field' => 'subject'),
			array('db' => 'message',		'dt' => '', 'field' => 'message'),
			array('db' => 'target',			'dt' => '', 'field' => 'target'),
		);

		echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns));
	}

	public function page($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change')) {
					if ($this->validation->run($_POST, 'editpage')) {
						$page['id'] = sanitize_filename($this->request->getPost('id'));
						$page['title'] = sanitize_filename($this->request->getPost('title'));
						$page['url'] = sanitize_filename($this->request->getPost('url'));
						$page['content'] = $this->request->getPost('content');
						$page['picture'] = $this->request->getPost('picture');
						$page['active'] = $this->request->getPost('active');
						if ($this->admin->urlExist('page', $page['id'], $page['url']) == FALSE) {
							$add = $this->admin->add('page', $page);
							if ($add == TRUE) {
								return redirect()->to(current_url())->with('success', 'Page ' . $page['title'] . ' saved.');
							}
						} else {
							if ($this->admin->urlExist('page', $page['id'], $page['url']) == TRUE) {
								$error = "URL " . $page['url'] . " has been exist!";
							}
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change') && isset($_GET['id'])) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('page', $uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_page', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_page', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('page', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'page');
		}
	}

	public function page_data($data = array())
	{
		$table = 'page';
		$primaryKey = 'id';

		$columns = array(
			array('db' => $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array(
				'db' => 'title',		'dt' => 1, 'field' => 'title',
				'formatter' => function ($d, $row) {
					if ($row['active'] == 'Y') {
						$active = '';
					} else {
						$active = '<span class="shadow-none badge badge-danger">Inactive</span> ';
					}
					return $active . character_limiter($d, 60);
				}
			),
			array(
				'db' => 'url',		'dt' => 2, 'field' => 'url',
				'formatter' => function ($d, $row) {
					return "<a href='" . site_url() . "page/" . $row['url'] . "'>" . character_limiter($d, 60) . "</a>";
				}
			),
			array(
				'db' => $primaryKey,	'dt' => 3, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="' . site_url() . "page/" . $row['url'] . '">View</a>
									<a class="dropdown-item" href="?act=edit&id=' . $d . '">Edit</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
			array('db' => 'active',		'dt' => '', 'field' => 'active'),
		);

		echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns));
	}

	public function user($id = null, $emailExist = null, $usernameExist = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change') && !(isset($_POST['id']) == 1 && $this->session->userid <> 1)) {
					if ($this->validation->run($_POST, 'edituser')) {
						$account['id'] = sanitize_filename($this->request->getPost('id'));
						$account['name'] = sanitize_filename($this->request->getPost('name'));
						$account['username'] = strtolower(sanitize_filename($this->request->getPost('username')));
						$account['email'] = strtolower(sanitize_filename($this->request->getPost('email')));
						(!empty($this->request->getPost('password'))) ? $account['password'] = sha1($this->request->getPost('password')) : NULL;
						$account['bio'] = sanitize_filename($this->request->getPost('bio'));

						$account['facebook'] = sanitize_filename($this->request->getPost('facebook'));
						$account['twitter'] = sanitize_filename($this->request->getPost('twitter'));
						if ($this->session->userrole == 1) {
							$account['role'] = sanitize_filename($this->request->getPost('role'));
							$account['active'] = $this->request->getPost('active');
						}
						if ($picture = $this->request->getFile('picture')) {
							if ($picture->isValid() && !$picture->hasMoved()) {
								$image = \Config\Services::image()
									->withFile($picture)
									->resize(320, 320)
									->save();
								if (file_exists('assets/images/profile/user_' . $account['id'] . '.png')) {
									unlink('assets/images/profile/user_' . $account['id'] . '.png');
								}
								$picture->move('assets/images/profile', 'user_' . $account['id'] . '.png');
								$account['picture'] = 'user_' . $account['id'] . '.png';
							}
						}

						if ($this->admin->emailExist($account['email'], $account['id']) == FALSE && $this->admin->usernameExist($account['username'], $account['id']) == FALSE) {
							$add = $this->admin->add('user', $account);
							if ($add == TRUE) {
								return redirect()->to(site_url() . 'admin/user')->with('success', 'Account ' . $account['username'] . ' saved.');
							}
						} else {
							if ($this->admin->emailExist($account['email'], $account['id']) == TRUE) {
								$emailExist = "Email " . $account['email'] . " has been registered!";
							}
							if ($this->admin->usernameExist($account['username'], $account['id']) == TRUE) {
								$usernameExist = "Username " . $account['username'] . " has been registered!";
							}
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'emailExist' => $emailExist,
				'usernameExist' => $usernameExist
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change')) {
				if (isset($_GET['id'])) {
					$uri = sanitize_filename($_GET['id']);
				} else {
					$uri = sanitize_filename($this->session->userid);
				}
				if (isset($uri) == true) {
					$result = $this->admin->getUser($uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_user', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_user', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if ($_FILES) {
			if ($this->validation->run($_POST, 'file')) {
				$file = $this->request->getFile('file');
				if ($file->isValid() && !$file->hasMoved()) {
					$file->move('assets/uploads');
					include APPPATH . 'ThirdParty/PHPExcel.php';
					if ($file->getClientExtension() == "csv") {
						$excelreader	= new PHPExcel_Reader_CSV();
					} else if ($file->getClientExtension() == "xls") {
						$excelreader	= new PHPExcel_Reader_Excel5();
					} else if ($file->getClientExtension() == "xlsx") {
						$excelreader	= new PHPExcel_Reader_Excel2007();
					}
					$loadexcel	= $excelreader->load('assets/uploads/' . $file->getName());
					$sheet		= $loadexcel->getActiveSheet()->toArray(null, true, true, true);
					$data		= array();
					$i			= 1;
					foreach ($sheet as $row) {
						if ($i > 1) {
							array_push($data, array(
								//'id'		=> $row['A'],
								'name'		=> $row['B'],
								'username'	=> $row['C'],
								'email'		=> $row['D'],
								'password'	=> $row['E'],
								//'picture'	=> $row['F'],
								'role'		=> $row['F'],
								//'registered'=> $row['H'],
								//'lastlogin'	=> $row['I'],
								'active'	=> $row['G'],
								//'facebook'	=> $row['K'],
								//'twitter'	=> $row['L'],
								//'bio'		=> $row['M'],
							));
						}
						$i++;
					}
					$this->admin->import('user', $data);
					unlink('assets/uploads/' . $file->getName());
					return redirect()->to(site_url() . 'admin/user')->with('success', 'Successfully import data.');
				}
			} else {
				return redirect()->to(site_url() . 'admin/user')->with('error', 'File not support.');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			if (!in_array($this->session->userid, $_POST['item']) && $this->session->userrole == 1) { //user tidak bisa menghapus disinya sendiri dan hanya user role 1 yang dapat menghapus user
				$this->admin->multiDelete('user', $_POST['item']);
			}
			return redirect()->to(site_url() . 'admin/user');
		} else {
			return $this->lib->render('admin', 'user');
		}
	}

	public function user_data($data = array())
	{
		$table = 'user';
		$primaryKey = 'id';

		$columns = array(
			array('db' => 'u.' . $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array(
				'db' => 'picture',		'dt' => 1, 'field' => 'picture',
				'formatter' => function ($d, $row) {
					return '<span><img src="' . site_url() . 'assets/images/profile/' . $d . '" class="profile-img" alt="avatar"></span>';
				}
			),
			array(
				'db' => 'name',			'dt' => 2, 'field' => 'name',
				'formatter' => function ($d, $row) {
					if ($row['active'] == 'Y') {
						$active = '';
					} else {
						$active = '<span class="shadow-none badge badge-danger">Inactive</span> ';
					}
					return $active . $d;
				}
			),
			array('db' => 'r.title',		'dt' => 3, 'field' => 'title'),
			array(
				'db' => 'lastlogin',		'dt' => 4, 'field' => 'lastlogin',
				'formatter' => function ($d, $row) {
					return date("d M Y H:i", strtotime($d));
				}
			),
			array(
				'db' => 'u.' . $primaryKey,	'dt' => 5, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="' . site_url() . "admin/profile/" . $row['username'] . '">View</a>
									<a class="dropdown-item" href="?act=edit&id=' . $d . '">Edit</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
			array('db' => 'username',		'dt' => '', 'field' => 'username'),
			array('db' => 'active',		'dt' => '', 'field' => 'active'),
		);

		$joinQuery = "FROM user AS u LEFT JOIN role AS r ON (u.role = r.id)";

		echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns, $joinQuery));
	}

	public function profile($id = null, $emailExist = null, $usernameExist = null)
	{

		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change') && !(isset($_POST['id']) == 1 && $this->session->userid <> 1)) {
					if ($this->validation->run($_POST, 'edituser')) {
						$account['id'] = sanitize_filename($this->request->getPost('id'));
						$account['name'] = sanitize_filename($this->request->getPost('name'));
						$account['username'] = strtolower(sanitize_filename($this->request->getPost('username')));
						$new['username'] = $account['username'];
						$account['email'] = strtolower(sanitize_filename($this->request->getPost('email')));
						$new['useremail'] = $account['email'];
						(!empty($this->request->getPost('password'))) ? $account['password'] = sha1($this->request->getPost('password')) : NULL;
						$account['facebook'] = sanitize_filename($this->request->getPost('facebook'));
						$account['twitter'] = sanitize_filename($this->request->getPost('twitter'));
						if ($this->session->userrole == 1) {
							$account['role'] = sanitize_filename($this->request->getPost('role'));
							$account['active'] = $this->request->getPost('active');
						}
						if ($picture = $this->request->getFile('picture')) {
							if ($picture->isValid() && !$picture->hasMoved()) {
								$image = \Config\Services::image()
									->withFile($picture)
									->resize(320, 320)
									->save();
								if (file_exists('assets/images/profile/user_' . $account['id'] . '.png')) {
									unlink('assets/images/profile/user_' . $account['id'] . '.png');
								}
								$picture->move('assets/images/profile', 'user_' . $account['id'] . '.png');
								$account['picture'] = 'user_' . $account['id'] . '.png';
								$new['userpicture'] = $account['picture'];
							}
						}

						if ($this->admin->emailExist($account['email'], $account['id']) == FALSE && $this->admin->usernameExist($account['username'], $account['id']) == FALSE) {
							$add = $this->admin->add('user', $account);
							if ($add == TRUE) {
								$this->session->set($new);
								return redirect()->to(site_url() . 'admin/profile')->with('success', 'Account ' . $account['username'] . ' saved.');
							}
						} else {
							if ($this->admin->emailExist($account['email'], $account['id']) == TRUE) {
								$emailExist = "Email " . $account['email'] . " has been registered!";
							}
							if ($this->admin->usernameExist($account['username'], $account['id']) == TRUE) {
								$usernameExist = "Username " . $account['username'] . " has been registered!";
							}
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'emailExist' => $emailExist,
				'usernameExist' => $usernameExist
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change')) {
				if (isset($_GET['id'])) {
					$uri = sanitize_filename($_GET['id']);
				} else {
					$uri = sanitize_filename($this->session->userid);
				}
				if (isset($uri) == true) {
					$result = $this->admin->getUser($uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_user', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_user', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else {
			$uri = sanitize_filename($this->request->uri->getSegment(3));
			if ($uri == '') {
				$page = $this->admin->getUser($this->session->username);
				if ($page == false) {
					return $this->lib->render('admin', '404');
				}
				return $this->lib->render('admin', 'profile', $page);
			} else {
				$page = $this->admin->getUser($uri);
				if ($page == false) {
					return $this->lib->render('admin', '404');
				}
				return $this->lib->render('admin', 'profile', $page);
			}
		}
	}

	public function role($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change') && !(isset($_GET['id']) == 1 && $this->session->userid <> 1)) {
					if ($this->validation->run($_POST, 'title')) {
						$data = array();
						for ($i = 0; $i < sizeof($_POST['url']); $i++) {
							$data[] = array($_POST['url'][$i], array((!empty($_POST['access'][$i])) ? $_POST['access'][$i] : '', (!empty($_POST['create'][$i])) ? $_POST['create'][$i] : '', (!empty($_POST['modify'][$i])) ? $_POST['modify'][$i] : ''));
						}
						$role['id'] = sanitize_filename($this->request->getPost('id'));
						$role['title'] = sanitize_filename($this->request->getPost('title'));
						$role['permission'] = json_encode($data);

						$add = $this->admin->add('role', $role);
						if ($add == TRUE) {
							return redirect()->to(current_url())->with('success', 'Role ' . $role['id'] . ' saved.');
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change') && isset($_GET['id']) && !($_GET['id'] == 1 && $this->session->userid <> 1)) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('role', $uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_role', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_role', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('role', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'role');
		}
	}

	public function role_data($data = array())
	{
		$table = 'role';
		$primaryKey = 'id';

		$columns = array(
			array('db' => $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array('db' => 'title',		'dt' => 1, 'field' => 'title'),
			array(
				'db' => $primaryKey,	'dt' => 2, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="?act=edit&id=' . $d . '">Edit</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
		);

		echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns));
	}

	public function slider($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change')) {
					if ($this->validation->run($_POST, 'editclient')) {
						$slider['id'] = sanitize_filename($this->request->getPost('id'));
						$slider['title'] = sanitize_filename($this->request->getPost('title'));
						$slider['description'] = sanitize_filename($this->request->getPost('description'));
						$oldpicture = sanitize_filename($this->request->getPost('oldpicture'));
						if ($picture = $this->request->getFile('picture')) {
							if ($picture->isValid() && !$picture->hasMoved()) {
								$slider['picture'] = $picture->getName();
								$image = \Config\Services::image()
									->withFile($picture)
									->resize(1920, 940)
									->save();
								if ($oldpicture && file_exists('assets/images/slider/' . $oldpicture)) {
									unlink('assets/images/slider/' . $oldpicture);
								}
								$picture->move('assets/images/slider', $slider['picture']);
							}
						}
						$add = $this->admin->add('slider', $slider);
						if ($add == TRUE) {
							return redirect()->to(current_url())->with('success', 'slider ' . $slider['title'] . ' saved.');
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change') && isset($_GET['id'])) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('slider', $uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_slider', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_slider', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('slider', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'slider');
		}
	}

	public function slider_data($data = array())
	{
		$table = 'slider';
		$primaryKey = 'id';

		$columns = array(
			array('db' => $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array(
				'db' => 'picture',	'dt' => 1, 'field' => 'picture',
				'formatter' => function ($d, $row) {
					return '<span><img src="' . site_url() . 'assets/images/slider/' . $d . '" class="profile-img" alt="avatar"></span>';
				}
			),
			array('db' => 'title',		'dt' => 2, 'field' => 'title'),
			array(
				'db' => 'description', 'dt' => 3, 'field' => 'description',
				'formatter' => function ($d, $row) {
					return character_limiter($d, 60);
				}
			),
			array(
				'db' => $primaryKey,	'dt' => 4, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="?act=edit&id=' . $d . '">Edit</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
		);

		echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns));
	}

	public function sponsor($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change')) {
					if ($this->validation->run($_POST, 'editclient')) {
						$sponsor['id'] = sanitize_filename($this->request->getPost('id'));
						$sponsor['title'] = sanitize_filename($this->request->getPost('title'));
						$sponsor['link'] = $this->request->getPost('link');
						$sponsor['active'] = $this->request->getPost('active');
						$sponsor['expire'] = $this->request->getPost('expire');
						$oldpicture = sanitize_filename($this->request->getPost('oldpicture'));
						if ($picture = $this->request->getFile('picture')) {
							if ($picture->isValid() && !$picture->hasMoved()) {
								$sponsor['picture'] = $picture->getName();
								$image = \Config\Services::image()
									->withFile($picture)
									->resize(1920, 940)
									->save();
								if ($oldpicture && file_exists('assets/images/slider/' . $oldpicture)) {
									unlink('assets/images/sponsor/' . $oldpicture);
								}
								$picture->move('assets/images/sponsor', $sponsor['picture']);
							}
						}
						$add = $this->admin->add('sponsor', $sponsor);
						if ($add == TRUE) {
							return redirect()->to(current_url())->with('success', 'sponsor ' . $sponsor['title'] . ' saved.');
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change') && isset($_GET['id'])) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('sponsor', $uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_sponsor', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_sponsor', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('sponsor', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'sponsor');
		}
	}

	public function sponsor_data($data = array())
	{
		$table = 'sponsor';
		$primaryKey = 'id';

		$columns = array(
			array('db' => $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array(
				'db' => 'picture',	'dt' => 1, 'field' => 'picture',
				'formatter' => function ($d, $row) {
					return '<span><img src="' . site_url() . 'assets/images/sponsor/' . $d . '" class="profile-img" alt="avatar"></span>';
				}
			),
			array('db' => 'title',		'dt' => 2, 'field' => 'title'),
			array('db' => 'link',		'dt' => 3, 'field' => 'link'),
			array('db' => 'expire',		'dt' => 4, 'field' => 'expire'),
			array(
				'db' => 'active',		'dt' => 5, 'field' => 'active',
				'formatter' => function ($d, $row) {
					if ($d == 'Y' && date('Y-m-d H:i:s') < $row['expire']) {
						return '<i class="fa fa-check" aria-hidden="true" style="color: lightgreen"></i>';
					} else {
						return '<i class="fa fa-ban" aria-hidden="true"></i>';
					};
				}
			),
			array(
				'db' => $primaryKey,	'dt' => 6, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="?act=edit&id=' . $d . '">Edit</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
		);

		echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns));
	}

	public function client($id = null, $error = null)
	{
		if (isset($_GET['act'])) {
			if ($_POST) {
				if ($this->lib->role('create') || $this->lib->role('change')) {
					if ($this->validation->run($_POST, 'editclient')) {
						$client['id'] = sanitize_filename($this->request->getPost('id'));
						$client['title'] = sanitize_filename($this->request->getPost('title'));
						$client['description'] = sanitize_filename($this->request->getPost('description'));
						$client['link'] = $this->request->getPost('link');
						$oldpicture = sanitize_filename($this->request->getPost('oldpicture'));
						if ($picture = $this->request->getFile('picture')) {
							if ($picture->isValid() && !$picture->hasMoved()) {
								$client['picture'] = $picture->getName();
								$image = \Config\Services::image()
									->withFile($picture)
									->resize(225, 110)
									->save();
								if ($oldpicture && file_exists('assets/images/slider/' . $oldpicture)) {
									unlink('assets/images/client/' . $oldpicture);
								}
								$picture->move('assets/images/client', $client['picture']);
							}
						}
						$add = $this->admin->add('client', $client);
						if ($add == TRUE) {
							return redirect()->to(current_url())->with('success', 'Client ' . $client['title'] . ' saved.');
						}
					}
				} else {
					return $this->lib->render('admin', '_403');
				}
			}
			$data = [
				'validation' => $this->validation,
				'error' => $error,
			];
			if ($_GET['act'] == 'edit' && $this->lib->role('change') && isset($_GET['id'])) {
				$uri = sanitize_filename($_GET['id']);
				if (isset($uri) == true) {
					$result = $this->admin->getData('client', $uri);
					if ($result == false) {
						return $this->lib->render('admin', '_404');
					}
					$data = array_merge((!$result) ? array() : $result, $data);
				}
				return $this->lib->render('admin', '_client', $data);
			} else if ($_GET['act'] == 'add' && $this->lib->role('create')) {
				return $this->lib->render('admin', '_client', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		} else if (isset($_POST['item']) && $this->lib->role('change')) {
			$this->admin->multiDelete('client', $_POST['item']);
			return redirect()->to(current_url());
		} else {
			return $this->lib->render('admin', 'client');
		}
	}

	public function client_data($data = array())
	{
		$table = 'client';
		$primaryKey = 'id';

		$columns = array(
			array('db' => $primaryKey,	'dt' => 0, 'field' => $primaryKey),
			array(
				'db' => 'picture',	'dt' => 1, 'field' => 'picture',
				'formatter' => function ($d, $row) {
					return '<span><img src="' . site_url() . 'assets/images/client/' . $d . '" class="profile-img" alt="avatar"></span>';
				}
			),
			array('db' => 'title',		'dt' => 2, 'field' => 'title'),
			array('db' => 'link',		'dt' => 3, 'field' => 'link'),
			array(
				'db' => 'description', 'dt' => 4, 'field' => 'description',
				'formatter' => function ($d, $row) {
					return character_limiter($d, 60);
				}
			),
			array(
				'db' => $primaryKey,	'dt' => 5, 'field' => $primaryKey,
				'formatter' => function ($d, $row) {
					return '<div class="dropdown custom-dropdown">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
								</a>

								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
									<a class="dropdown-item" href="?act=edit&id=' . $d . '">Edit</a>
									<a class="dropdown-item" href="javascript:void(0);" id="delete" data-id="' . $d . '" data-toggle="modal" data-target="#alert">Delete</a>
								</div>
							</div>';
				}
			),
		);

		echo json_encode($this->ssp->simple($_POST, $table, $primaryKey, $columns));
	}

	public function menu()
	{
		if (isset($_POST['data'])) {
			$data = json_decode($_POST['data']);
			$this->admin->changeMenu($data);
		} else if (isset($_POST['item'])) {
			$id = sanitize_filename($this->request->getPost('item'));
			$result = $this->admin->deleteMenu($id);
			echo $result;
		} else if ($_POST) {
			$label = sanitize_filename($this->request->getPost('label'));
			$icon = sanitize_filename($this->request->getPost('icon'));
			$link = $this->request->getPost('link');
			$id = sanitize_filename($this->request->getPost('id'));
			$category = sanitize_filename($this->request->getPost('category'));
			$data = array(
				'label' => $label,
				'icon' => $icon,
				'link' => $link,
				'id' => $id,
				'category' => $category,
			);
			$result = $this->admin->addMenu($data);
			echo $result;
		} else {
			$category = sanitize_filename((!empty($_GET['id'])) ? $_GET['id'] : 1);
			if (isset($category) == true) {
				$data = array(
					'category' => $category
				);
				return $this->lib->render('admin', 'menu', $data);
			} else {
				return $this->lib->render('admin', '_404');
			}
		}
	}

	public function login($error = null)
	{
		if ($_POST) {
			if ($this->validation->run($_POST, 'login')) {
				$username = $this->request->getPost('username');
				$password = $this->request->getPost('password');

				if ($this->admin->accountExist($username) == TRUE) {
					$auth = $this->admin->login($username, sha1($password));
					if ($auth > 0) {
						$data = [
							'userid' => $auth['id'],
							'username' => $auth['username'],
							'useremail' => $auth['email'],
							'userrole' => $auth['role'],
							'userpicture' => $auth['picture'],
						];
						$this->session->set($data);
					} else {
						$error = "The password you entered don't match!";
					}
				} else {
					$error = "Account " . $username . " not registered!";
				}
			}
		}
		if ($this->lib->isLogin()) {
			$data = [
				'validation' => $this->validation,
				'error' => $error,
				'config' => $this->admin->getConfig()
			];
			return view('admin/login', $data);
		} else {
			return redirect()->to(site_url() . 'admin');
		}
	}

	public function forgot($error = null)
	{
		if ($_POST) {
			if ($this->validation->run($_POST, 'forgot')) {
				$email = $this->request->getPost('email');

				$account = $this->admin->getUser($email);
				if ($account > 0) {
					$var = $this->admin->getConfig();
					$config = [
						'mailType'	=> 'html',
						'charset'	 => 'utf-8',
						'protocol'	=> 'smtp',
						'SMTPHost' => $var['smtphost'],
						'SMTPUser' => $var['smtpuser'],
						'SMTPPass'	 => $var['smtppassword'],
						'SMTPCrypto' => 'ssl',
						'SMTPPort'	 => $var['smtpport'],
						'CRLF'		=> "\r\n",
						'newline' => "\r\n"
					];

					$reset['code'] = random_string('alnum', 15);
					$reset['email'] = $account['email'];

					$add = $this->admin->forgot($reset);

					$reset['sitename'] = $var['sitename'];
					$mail = \Config\Services::email();
					$mail->initialize($config);
					$mail->setFrom($var['sitemail'], $var['sitename']);
					$mail->setTo($reset['email']);
					$mail->setSubject("Password Reset - " . $var['sitename']);
					$mail->setMessage(view('email/forgot', $reset));


					if ($add == true && $mail->send()) {
						return redirect()->to(site_url() . 'admin/forgot')->with('emailsent', "We've sent an email to " . $account['email'] . ". Click the link in the email to reset your password!");
					} else {
						$error = $mail->printDebugger(['headers']);
					}
				} else {
					$error = "Account  " . $email . " not registered!";
				}
			}
		}
		if ($this->lib->isLogin()) {
			$data = [
				'validation' => $this->validation,
				'error' => $error,
				'config' => $this->admin->getConfig()
			];
			return view('admin/forgot', $data);
		} else {
			return redirect()->to(site_url() . 'admin');
		}
	}

	public function recover($accountExist = null, $notMatch = null)
	{
		if (!$this->lib->isLogin()) {
			return redirect()->to(site_url() . 'admin');
		}
		if ($_POST) {
			if ($this->validation->run($_POST, 'resetpassword')) {
				$code = $this->request->getPost('code');
				$password = sha1($this->request->getPost('password'));

				if ($this->admin->changepassword($code, $password) == TRUE) {
					return redirect()->to(site_url() . 'admin/login')->with('newpassword', 'Password successfully changed!');
				} else {
					return redirect()->to(site_url() . 'admin/forgot')->with('message', 'Reset code has been expired or not valid!');
				}
			} else {
				$data = [
					'validation' => $this->validation,
					'accountExist' => $accountExist,
					'notMatch' => $notMatch,
					'config' => $this->admin->getConfig()
				];
				return view('admin/recover', $data);
			}
		} else if (isset($_GET['email']) && isset($_GET['code'])) {
			$email = sanitize_filename($_GET['email']);
			$code = sanitize_filename($_GET['code']);

			if ($this->admin->recover($email, $code) == TRUE) {
				$data = [
					'config' => $this->admin->getConfig()
				];
				return view('admin/recover', $data);
			} else {
				return redirect()->to(site_url() . 'admin/forgot')->with('message', 'Reset code has been expired or not valid!');
			}
		} else {
			return $this->lib->render('admin', '_404');
		}
	}

	public function logout()
	{
		$this->session->destroy();
		return redirect()->to(site_url() . 'admin/login');
	}
}
