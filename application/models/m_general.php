<?php
Class M_general extends CI_Model{
	
	function __construct(){
	parent::__construct();
	}
	
	public function getUserDetail($username,$password){
		$this->db->select('*');
		$this->db->from('cms_user');
		$this->db->where('user_name', $this->db->escape_str($username));
		$this->db->where('user_pass', $this->db->escape_str($password));
        $query = $this->db->get();
		
        if($query->num_rows() > 0){
            return $query->result();
        }else{
        	return false;
		}
	}
	
	function checkUserIsAllowed($groupId,$page){
		$this->db->select('access.*');
		$this->db->from('cms_groupaccess AS access');
		$this->db->join('cms_menu AS menu', 'access.menu_id = menu.menu_id and menu.menu_url = "'.$page.'"');
		$this->db->where('access.group_id', $groupId);
        $query = $this->db->get();
		
        if($query->num_rows() > 0){
            return true;
        }else{
        	return false;
		}
	}
	
	function checkUserIsExist($userId,$userName,$groupId){
		$this->db->select('*');
		$this->db->from('cms_user');
		$this->db->where('user_id', $userId);
		$this->db->where('user_name', $this->db->escape_str($userName));
		$this->db->where('group_id', $groupId);
        $query = $this->db->get();
		
        if($query->num_rows() > 0){
            return $query->result();
        }else{
        	return false;
		}
	}
	
	function getGroupAccess($groupId){
		$this->db->select('menucategory.menucategory_name, menucategory.menucategory_icon, menu.menu_name, menu.menu_url');
		$this->db->from('cms_menucategory AS menucategory, cms_menu AS menu, cms_groupaccess AS access');
		$this->db->where('menucategory.menucategory_id = menu.menucategory_id');
		$this->db->where('menu.menu_id = access.menu_id');
		$this->db->where('access.group_id', $groupId);
		$this->db->order_by('menucategory.menucategory_id asc, menu.menu_id asc');
        $query = $this->db->get();
		
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
        	return false;
		}
	}
	
	function userLog($action,$detail,$userId){
		$this->data = array('userlog_date' => date("Y-m-d H:i:s"),
							'userlog_action' => $action,
							'userlog_detail' => $detail,
							'user_id' => $userId);
		$query = $this->db->insert('cms_userlog', $this->data); 
		
		if($query){
			return true;
        }else{
        	return false;
		}
	}
	
	function errorLog($action,$detail,$userId='0'){
		$this->data = array('errorlog_date' => date("Y-m-d H:i:s"),
							'errorlog_action' => $action,
							'errorlog_detail' => $detail,
							'user_id' => $userId);
		$query = $this->db->insert('cms_errorlog', $this->data); 
		
		if($query){
			return true;
        }else{
        	return false;
		}
	}
	
	function getList($table,$order,$condition=NULL){
		if(!empty($condition)){
			$this->db->where($condition);
		}
		$this->db->order_by($order);
		$query = $this->db->get($table);
		
		 if($query->num_rows() > 0){
            return $query->result_array();
        }else{
        	return false;
		}
	}
	
	public function getAllData($table,$order="",$type=""){
		if(!empty($order) && !empty($type)){
			$this->db->order_by($order,$type);
		}
		return $this->db->get($table);
	}
	
	public function getSelectedData($table,$data,$order="",$type=""){
		if(!empty($order) && !empty($type)){
			$this->db->order_by($order,$type);
		}
		return $this->db->get_where($table, $data);
	}
	
	function manualQuery($q){
		return $this->db->query($q);
	}
	
	function insertData($table,$data){
		$query = $this->db->insert($table,$data);
		if($query){
			return true ;
		}else
			return false ;
	}
	
	function updateData($table,$data,$field_key)
	{
		$query = $this->db->update($table,$data,$field_key);
		if($query){
			return true ;
		}else
			return false ;
	}
	
	function deleteData($table,$data)
	{
		$query = $this->db->delete($table,$data);
		if($query){
			return true ;
		}else
			return false ;
	}
}
?>