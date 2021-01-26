<?php namespace App\Models;

use CodeIgniter\Model;

class Admin_model extends Model
{
	public function settings($data)
	{
		$query = $this->db->table('setting')->where('id', 1)->update($data);
		if ($query){
			return true;
		} else {
			return false;
		}
	}

	public function visit($data)
	{
		$result = $this->db->table('traffic')->where('ip', $data['ip'])->where('useragent', $data['useragent'])->where('DAY(lastactivity)', 'DAY(NOW())', FALSE)->get();
		if ($result->getResult()){
			$query = $this->db->table('traffic')->where('ip', $data['ip'])->where('useragent', $data['useragent'])->where('DAY(lastactivity)', 'DAY(NOW())', FALSE)->set('lastactivity', 'NOW()', FALSE)->set('impression', 'impression+1', FALSE)->update();
			if ($query){
				return true;
			} else {
				return false;
			}
		} else {
			$query = $this->db->table('traffic')->insert($data);
			if ($query){
				return true;
			} else {
				return false;
			}
		}
	}

	public function graph($day = 7)
	{
		$session = \Config\Services::session();
		$traffic = $this->db->table('traffic');
		$visitor = $this->db->query("SELECT DAY(m1) as day, MONTHNAME(m1) as month,
		
		(SELECT COUNT(ip) FROM traffic WHERE DAY(lastactivity)=DAY(m1) AND MONTH(lastactivity)=MONTH(m1)) as ip,
		(SELECT SUM(impression) FROM traffic WHERE DAY(lastactivity)=DAY(m1) AND MONTH(lastactivity)=MONTH(m1)) as impression
		
		FROM (SELECT SUBDATE(NOW(), INTERVAL '$day' DAY) + INTERVAL m DAY AS m1 FROM (select @rownum:=@rownum+1 as m from (select 1 union select 2 union select 3 union select 4) t1, (select 1 union select 2 union select 3 union select 4) t2, (select 1 union select 2 union select 3 union select 4) t3, (select 1 union select 2 union select 3 union select 4) t4, (select 1 union select 2 union select 3 union select 4) t5, (select @rownum:=0) t0) d1) d2 WHERE m1 <= now() ORDER BY m1");

		$t1 = $this->db->table('traffic')->select('ip')->where('lastactivity BETWEEN DATE_SUB(NOW(), INTERVAL '.$day.' DAY) AND NOW()')->groupBy('ip')->countAllResults();
		foreach($visitor->getResultArray() as $row){
			$t2[] = $row['day'] ." ". $row['month'];
			$t3[] = $row['ip'];
			$i = $row['impression'];
			$t4[] = (!empty($i)) ? $i : 0;
		}
		if ($session->userid <> 1){
			$post = $this->db->table('post')->where('author', $session->userid)->countAllResults();
			$category = $this->db->table('post_category')->where('author', $session->userid)->countAllResults();
			$comment = $this->db->table('post_comment')->join('post', 'post_comment.post = post.id')->where('post.author', $session->userid)->countAllResults();
		} else {
			$post = $this->db->table('post')->countAll();
			$category = $this->db->table('post_category')->countAll();
			$comment = $this->db->table('post_comment')->countAllResults();
		}
		$user = $this->db->table('user')->countAll();
		$page = $this->db->table('page')->countAll();
		$message = $this->db->table('contact')->countAll();
		return array($t1, $t2, $t3, $t4, $user, $page, $post, $category, $comment, $message);
	}

	public function add($table, $data)
	{
		if(empty($data['id'])){
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

	public function import($table, $data)
	{
		$query = $this->db->table($table)->insertBatch($data);
		if ($query){
			return true;
		} else {
			return false;
		}
	}

	public function getConfig()
	{
		$result = $this->db->query("select * from setting");
		if (isset($result)){
			return $result->getRowArray();
		}
	}

	public function getData($table, $data)
	{
		$result = $this->db->query("select * from $table where id='$data'");
		if (isset($result)){
			return $result->getRowArray();
		}
	}

	public function getUser($data)
	{
		$result = $this->db->query("select * from user where id='$data' or username='$data' or email='$data'");
		if (isset($result)){
			return $result->getRowArray();
		}
	}

	public function login($username, $password)
	{
		$result = $this->db->query("SELECT * FROM user WHERE (username='".$username."' OR email='".$username."') AND password='".$password."'");
		if (isset($result)){
			$this->db->query("UPDATE user SET lastlogin=now() where username='".$username."'");
			return $result->getRowArray();
		}
	}

	public function forgot($data)
	{
		$query = $this->db->table('forgot')->where('email', $data['email'])->get();
		if($query->getResult()){
			$query = $this->db->table('forgot')->where('email', $data['email'])->set('code', $data['code'])->set('expire', 'DATE_ADD(NOW(), INTERVAL +6 HOUR)', FALSE)->update();
			if ($query){
				return true;
			} else {
				return false;
			}
		} else {
			$query = $this->db->table('forgot')->set('email', $data['email'])->set('code', $data['code'])->set('expire', 'DATE_ADD(NOW(), INTERVAL +6 HOUR)', FALSE)->insert();
			if ($query){
				return true;
			} else {
				return false;
			}
		}
	}

	public function recover($email, $code)
	{
		$query = $this->db->table('forgot')->where('email', $email)->where('code', $code)->get();
		if($query->getResult()){
			$result = $this->db->table('forgot')->where('email', $email)->where('code', $code)->where('expire>', 'NOW()', FALSE)->get();
			if ($result->getResult()){
				return true;
			} else {
				$this->db->table('forgot')->where('email', $email)->where('code', $code)->delete();
			}
		}
	}

	public function changepassword($code, $password)
	{
		$result = $this->db->table('user')->join('forgot', 'user.email = forgot.email')->where('forgot.code', $code)->get();
		if ($result->getResult()){
			$query = $this->db->query("UPDATE user join forgot on (user.email = forgot.email) SET password = '$password' WHERE forgot.code = '$code'");
			if ($query){
				$this->db->table('forgot')->where('code', $code)->delete();
				return true;
			} else {
				return false;
			}
		}
	}

	public function accountExist($account)
	{
		$query = $this->db->query("SELECT * FROM user WHERE active='Y' AND (username='".$account."' OR email='".$account."')");
		$results = $query->getRow();

        return $results;
	}

	public function emailExist($email, $id = '')
	{
		$query = $this->db->query("SELECT * FROM user WHERE email='".$email."' AND id!='".$id."'");
		$results = $query->getRow();

        return $results;
	}

	public function usernameExist($username, $id = '')
	{
		$query = $this->db->query("SELECT * FROM user WHERE username='".$username."' AND id!='".$id."'");
		$results = $query->getRow();

        return $results;
	}

	public function urlExist($table, $id, $url)
	{
		$query = $this->db->query("SELECT * FROM ".$table." WHERE url='".$url."' AND id!='".$id."'");
		$results = $query->getRow();

		return $results;
	}

	public function addMenu($data)
	{
		if ($data['id'] == ''){
			$query = $this->db->table('menu')->insert($data);
			$id = $this->db->insertID();
			$arr = array(
				'type' => 'add',
				'menu' => '<li class="dd-item dd3-item" data-id="'.$id.'" >
							<div class="dd-handle dd3-handle"></div>
							<div class="dd3-content"><span id="label_show'.$id.'">'.$data['label'].'</span>
								<span class="span-right"><span id="link_show'.$id.'">'.$data['link'].'</span> &nbsp;&nbsp;
								<a class="edit-button" id="'.$id.'" label="'.$data['label'].'" link="'.$data['link'].'"  icon="'.$data['icon'].'"  category="'.$data['category'].'" ><i class="fa fa-pencil-alt"></i></a>
								<a class="del-button" id="'.$id.'"><i class="fa fa-trash"></i></a>
								</span>
							</div>'
			);
		} else {
			$this->db->table('menu')->where('id', $data['id'])->update($data);
			$arr = array(
				'type' => 'edit',
				'label' => $data['label'],
				'icon' => $data['icon'],
				'link' => $data['link'],
				'id' => $data['id'],
				'category' => $data['category']
			);
		}
		return json_encode($arr);
	}

	function changeMenu($data)
    {
		$builder = $this->db->table('menu');
		function parseJsonArray($jsonArray, $parentID = 0) {
			$return = array();
			foreach ($jsonArray as $subArray) {
				$returnSubSubArray = array();
				if (isset($subArray->children)) {
					$returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
				}

				$return[] = array('id' => $subArray->id, 'parentID' => $parentID);
				$return = array_merge($return, $returnSubSubArray);
			}
			return $return;
		}

		$readbleArray = parseJsonArray($data);

		$i=0;
		foreach($readbleArray as $row){
			$i++;
			$data = [
				'parent' => $row['parentID'],
				'sort'  => $i
			];

			$builder->where('id', $row['id']);
			$builder->update($data);
		}
    }

	function deleteMenu($data)
    {
        function recursiveDelete($id) {
			$db = \Config\Database::connect();
			$builder = $db->table('menu');
			$query = $builder->getWhere(array('parent' => $id));
			if ($query->getResultArray() > 0) {
			   foreach($query->getResultArray() as $row){
					recursiveDelete($row['id']);
			   }
			}
			$builder->where('id', $id);
			$builder->delete();
		}
		recursiveDelete($data);
    }

	function multiRead($table, $data)
    {
		$this->db->query('UPDATE '.$table.' SET seen = "Y" WHERE id = "'.$data.'"');
    }

	function multiDelete($table, $data)
    {
		$query = implode(',',$data);
		if ($query !== ''){
			$this->db->query('DELETE FROM '.$table.' WHERE id IN('.sanitize_filename($query).')');
			if ($table == 'post'){
				$this->db->query('DELETE FROM post_comment WHERE post IN('.sanitize_filename($query).')');
			}
			if ($table == 'post_comment'){
				$this->db->query('DELETE FROM '.$table.' WHERE parent IN('.sanitize_filename($query).')');
			}
		}
    }

}
