<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Libraries\Library;
use App\Libraries\SSP;
use App\Models\Admin_model;
use App\Models\Base_model;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['text', 'inflector', 'security'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->ssp = new SSP();
		$this->lib = new Library();
		$this->base = new Base_model();
		$this->admin = new Admin_model();
		$this->session = \Config\Services::session();
		$this->validation =  \Config\Services::validation();
		
		$geo = json_decode(@file_get_contents("http://extreme-ip-lookup.com/json/".$this->request->getIPAddress()));

		$data = [
			'ip' => $this->request->getIPAddress(),
			'useragent' => $this->request->getUserAgent(),
			'country' => (!empty($geo->country)) ? $geo->country : NULL,
			'city' => (!empty($geo->city)) ? $geo->city : NULL,
			'isp' => (!empty($geo->isp)) ? $geo->isp : NULL,
			'impression' => 1,
		];

		$this->admin->visit($data);
	}

}
