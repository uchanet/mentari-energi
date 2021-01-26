<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
		$session = session();
        if (!isset($session->userid) && !isset($session->username) && !isset($session->userrole))
        {
			// ADMIN
            if ($request->uri->getSegment(1) == 'admin' && $request->uri->getPath() != 'admin/login' && $request->uri->getPath() != 'admin/forgot' && $request->uri->getPath() != 'admin/recover')
            {
                 return redirect()->to(site_url().'admin/login');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

}
