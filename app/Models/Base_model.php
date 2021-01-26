<?php namespace App\Models;

use CodeIgniter\Model;

class Base_model extends Model
{
	protected $table = 'users';

	public function getConfig()
	{
		$query = $this->db->query("select * from settings");
		foreach ($query->getResult() as $row){
			$result['sitename'] = $row->sitename;
			$result['sitedescription'] = $row->sitedescription;
			$result['sitetag'] = $row->sitetag;
			$result['smtphost'] = $row->smtphost;
			$result['email'] = $row->email;
			$result['smtppassword'] = $row->smtppassword;
			$result['smtpport'] = $row->smtpport;
		}
		if (isset($result)){
			return $result;
		}
	}

	public function page($data)
	{
		$result = $this->db->query("select * from page where url='$data'");
		if (isset($result)){
			return $result->getRowArray();
		}
	}

	public function post($data)
	{
		$result = $this->db->query("select * from post where url='$data'");
		if (isset($result)){
			$this->db->table('post')->where('url', $data)->set('view', 'view+1', FALSE)->update();
			return $result->getRowArray();
		}
	}

	public function add($table, $data)
	{
		if(!empty($data['id']) == ''){
			$query = $this->db->table($table)->insert($data);
			if ($query){
				return true;
			} else {
				return false;
			}
		} else {
			$query = $this->db->table($table)->where('id', $data['id'])->update($data);
			if ($query){
				return true;
			} else {
				return false;
			}
		}
	}

	public function login2($username, $password)
	{
		$query = $this->db->query("SELECT * FROM mahasiswa WHERE npm='".$username."' AND pass='".$password."'");

		foreach ($query->getResult() as $row){
			$result['id'] = $row->id;
			$result['npm'] = $row->npm;
			$result['name'] = $row->name;
			$result['prodi'] = $row->prodi;
			$result['pass'] = $row->pass;
		}
		if (isset($result)){
			return $result;
		}
	}

	public function login($username, $password)
	{
		$query = $this->db->query("SELECT * FROM users WHERE (username='".$username."' OR email='".$username."') AND password='".$password."'");

		foreach ($query->getResult() as $row){
			$result['id'] = $row->id;
			$result['name'] = $row->name;
			$result['username'] = $row->username;
			$result['email'] = $row->email;
			$result['role'] = $row->role;
		}
		if (isset($result)){
			return $result;
		}
	}

	public function register($data)
	{
		$query = $this->db->table('users')->insert($data);
		if ($query){
			return true;
		} else {
			return false;
		}
	}

	public function forgot($data)
	{
		$query = $this->db->query("SELECT * FROM forgot WHERE email='".$data['email']."'");
		$exist = $query->getRow();
		if ($exist == TRUE){
			$builder = $this->db->table('forgot');
			$builder->where('email', $data['email']);
			$query = $builder->update($data);
			if ($query){
				return true;
			} else {
				return false;
			}
		} else {
			$query = $this->db->table('forgot')->insert($data);
			if ($query){
				return true;
			} else {
				return false;
			}
		}
	}

	public function getForgot($data)
	{
		$query = $this->db->query("SELECT * FROM forgot WHERE code='".$data."'");
		foreach ($query->getResult() as $row){
			$result = $row->email;
		}
		if (isset($result)){
			return $result;
		}
	}

	public function changePassword($email, $password)
	{
		$builder = $this->db->table('users');
		$builder->set('password', $password);
		$builder->where('email', $email);
		if ($builder->update()){
			return true;
		} else {
			return false;
		}
	}

	public function deleteForgot($data)
	{
		$builder = $this->db->table('forgot');
		$builder->where('email', $data);
		$builder->delete();
	}

	public function emailExist($email)
	{
		$query = $this->db->query("SELECT * FROM users WHERE email='".$email."'");
		$results = $query->getRow();

        return $results;
	}

	public function usernameExist($username)
	{
		$query = $this->db->query("SELECT * FROM users WHERE username='".$username."'");
		$results = $query->getRow();

        return $results;
	}

	public function accountExist($account)
	{
		$query = $this->db->query("SELECT * FROM users WHERE username='".$account."' OR email='".$account."'");
		$results = $query->getRow();

        return $results;
	}

	public function accountExist2($account)
	{
		$query = $this->db->query("SELECT * FROM mahasiswa WHERE npm='".$account."'");
		$results = $query->getRow();

        return $results;
	}
}

class Post extends Model
{
	protected $table = 'post';
}

class Comment extends Model
{
	protected $table = 'post_comment';
}
