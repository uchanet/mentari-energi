<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $signup = [
        'name'     => 'required',
        'username'     => 'required',
        'password'     => 'required|min_length[8]',
        //'repassword' => 'required|matches[password]',
        'email'        => 'required|valid_email',
        'role'        => 'required'
    ];

    public $signup_errors = [
        'username' => [
            'required'    => 'You must choose a username.',
        ],
        'email'    => [
            'valid_email' => 'Please check the Email field. It does not appear to be valid.'
        ]
    ];

	public $edituser = [
        'name' => 'required',
        'username' => 'required',
        'email' => 'required|valid_email'
    ];

	public $postcomment = [
        'name' => 'required',
        'email' => 'required|valid_email',
        'message' => 'required',
    ];

	public $replycomment = [
        'message' => 'required',
    ];

	public $postmessage = [
        'name' => 'required',
        'subject' => 'required',
        'email' => 'required|valid_email',
        'message' => 'required',
    ];

	public $sendmessage = [
        'email' => 'required',
        'subject' => 'required',
        'message' => 'required',
    ];

	public $editpage = [
        'title' => 'required',
        'url' => 'required',
        'content' => 'required',
    ];

	public $editcategory = [
        'title' => 'required',
        'url' => 'required',
    ];

	public $editclient = [
        'title' => 'required',
    ];

	public $editpost = [
        'title' => 'required',
        'url' => 'required',
        'content' => 'required',
        'category' => 'required',
        'picture' => 'required',
    ];

	public $login = [
        'username' => 'required',
        'password' => 'required',
    ];

	public $email = [
        'email' => 'required|valid_email',
    ];

	public $forgot = [
        'email' => 'required',
    ];

	public $resetpassword = [
        'password' => 'required|min_length[8]',
        'cpassword' => ['label' => 'confirm password', 'rules' => 'required|matches[password]'],
    ];

    public $resetpassword_errors = [
        'cpassword' => [
            'matches'    => 'The confirm password field does not match the password field.',
        ]
    ];

	public $file = [
        'file' => 'ext_in[file,csv,xls,xlsx]',
    ];

	public $title = [
        'title' => 'required|min_length[4]',
    ];
}
