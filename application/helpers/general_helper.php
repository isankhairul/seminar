<?php
	
	function encryptPass($pass){
		$B64 	= base64_encode($pass);
		$MD5 	= md5($B64);
		$HASH 	= base64_encode($MD5);
		return $HASH;
	}
	
	function Actions($id){
		$html = '<div class="actions text-center">';
		$html .='<a href="javascript:void(0)" class="edit" id="'.$id.'" onclick="showForm(\'edit\')" title="Ubah"><i class="glyphicon glyphicon-edit"></i></a> ';
		//$html .= '<a href="javascript:void(0)" id="'.$id.'" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a>';
		$html .= '<a href="javascript:void(0)" class="delete" id="'.$id.'" title="Delete"><i class="glyphicon glyphicon-trash"></i></a> ';
		$html .= '</div>';
	 
		return $html;
	}
	
	function checkoutDateHistory($dateCheckOut){
		$date = date_create($dateCheckOut);
		$date = date_modify($date,"-5 days");
		return date_format($date,"Y-m-d");
	}
	
	function Actions_User($id,$status){
		$CI = & get_instance();
		$status = (($status == 1) ? 'freeze' : 'active');
		$session_data = $CI->session->userdata('CMS_logged_in'); 
		$html = '<div class="actions text-center">';
		$html .='<a href="javascript:void(0)" class="edit" id="'.$id.'" onclick="showForm(\'edit\')" title="Ubah"><i class="glyphicon glyphicon-edit"></i></a> ';
		$html .='<a href="javascript:void(0)" class="ChangePassword" id="'.$id.'" onclick="Change_password(\'changePassword\')" title="Change password"><i class="glyphicon glyphicon-user"></i></a> ';
		if(($session_data[id] == 1 && $session_data[username] == 'admin') || ($session_data[id] == 2 && $session_data[username] == 'sri.salsalita')){
			switch($status){
			case 'freeze' :
				$html .='<a href="javascript:void(0)" class="freeze" id="'.$id.'" status="'.$status.'" title="Freeze User"><i class="glyphicon glyphicon-eye-close"></i></a> ';
			break;
			default:	
				$html .='<a href="javascript:void(0)" class="freeze" id="'.$id.'" status="'.$status.'" title="Open User"><i class="glyphicon glyphicon-eye-open"></i></a> ';
			}
		}		
		$html .= '</div>';
	 
		return $html;
	}
	
	function status_user($status){
		switch($status){
			case '1' :
				$info = 'Active' ;
				$label = 'success' ;
			break;
			default:	
				$info = 'Non Active' ;
				$label = 'danger' ;
		}
		
		$html .='<span class="label label-'.$label.'">'.$info.'</span>';
	 
		return $html;
	}
	
	
	function ActionsToTipeMember($id){
		$html = '<div class="actions text-center">';
		$html .='<a href="javascript:void(0)" class="edit" id="'.$id.'" onclick="showForm(\'edit\')" title="Ubah"><i class="glyphicon glyphicon-edit"></i></a> ';
		//$html .= '<a href="javascript:void(0)" class="delete" id="'.$id.'" title="Delete"><i class="glyphicon glyphicon-trash"></i></a> ';
		$html .= '</div>';
	 
		return $html;
	}
	
	function getDetailMovie($id){
		$html = '<div class="actions text-center">';
		//$html .= '<a href="'.site_url('MG/content/'.$url.'?email_id='.$id.'').'" target="_BLANK" class="edit" id="'.$id.'" title="Detail"><i class="glyphicon glyphicon-search"></i></a> ';
		$html .='<a href="javascript:void(0)" class="edit" id="'.$id.'" onclick="showForm(\'edit\')" title="Ubah"><i class="icon-edit"></i></a> ';
		//$html .= '<a href="javascript:void(0)" id="'.$id.'" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a>';
		$html .= '<a href="javascript:void(0)" class="delete" id="'.$id.'" title="Delete"><i class="icon-trash"></i></a> ';
		$html .= '</div>';
	 
		return $html;
	}
	function getDetailLtm($id){
		$html = '<div class="actions text-center">';
		//$html .= '<a href="'.site_url('MG/content/'.$url.'?email_id='.$id.'').'" target="_BLANK" class="edit" id="'.$id.'" title="Detail"><i class="glyphicon glyphicon-search"></i></a> ';
		$html .='<a href="javascript:void(0)" class="edit" id="'.$id.'" onclick="showForm(\'edit\')" title="Ubah"><i class="icon-edit"></i></a> ';
		//$html .= '<a href="javascript:void(0)" id="'.$id.'" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a>';
		$html .= '<a href="javascript:void(0)" class="delete" id="'.$id.'" title="Delete"><i class="icon-trash"></i></a> ';
		$html .= '</div>';
	 
		return $html;
	}
	
	function FormatImage($pict_name, $url = ''){
		$html 	 = '<div class="actions text-center">';
		$html 	.='<img src="'.$url.$pict_name.'" width="45px" class="img-thumbnail"/>';
		$html 	.= '</div>';
	 
		return $html;
	}
	
	function FormatImageHistoryGiftFront($pict_name, $url = ''){
		$html 	 = '<div class="actions text-center">';
		$html 	.='<img src="'.$url.$pict_name.'" width="45px" />';
		$html 	.= '</div>';
	 
		return $html;
	}

	function format_date($date){
		$date1 = new DateTime($date);
		
		return date_format($date1, 'd M Y');
	}
	function status_promo($enddatepromo){
		$enddate = new DateTime($enddatepromo);
		$today = date('Y-m-d');
		$today = new DateTime($today);
		if($enddate >= $today) {
		$html = '<span class="label label-success">Active</span>' ;
	        }else{
		$html = '<span class="label label-danger">Expire</span>' ;
	        }
		return $html ;
	}
	
	function FormatStatusGift($status){
		switch($status){
			case 'pending' :
				$html 	 = '<div class="actions text-center">';
				$html 	.= '<div class="btn btn-warning square btn-block" style="cursor:default;">'.$status.'</div>';
				$html 	.= '</div>';
			break;
			case 'approved' :
				$html 	 = '<div class="actions text-center">';
				$html 	.= '<div class="btn btn-success square btn-block" style="cursor:default;">'.$status.'</div>';
				$html 	.= '</div>';
			break;
			case 'deleted' :
				$html 	 = '<div class="actions text-center">';
				$html 	.= '<div class="btn btn-danger square btn-block" style="cursor:default;">'.$status.'</div>';
				$html 	.= '</div>';
			break;
		}
		return $html;
	}
	
	function generateRandomString($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
	return $randomString;
	}

	function gift_option_checkbox($id, $status, $type = ''){
		
		if($status == 1){
			$html = '<div class="actions text-center">';
			$html .='<input type="checkbox" name="chkGift" id="chkGift'.$id.'" value="'.$id.'" checked onclick="chkGift('.$id.','.$type.')" >';
			$html .= '</div>';	
		}else{
			$html = '<div class="actions text-center">';
			$html .='<input type="checkbox" name="chkGift" id="chkGift'.$id.'" value="'.$id.'" onclick="chkGift('.$id.','.$type.')">';
			$html .= '</div>';
		}
	 
		return $html;
	}
	function option_checkbox($id, $status){
		
		if($status == 1){
			$html = '<div class="actions text-center ">';
			$html .='<input type="checkbox" name="checkbox" id="checkbox'.$id.'" value="'.$id.'" checked onclick="checkbox('.$id.')" > <span id="checkboxcol'.$id.'">Publish </span> ';
			$html .= '</div>';	
		}else{
			$html = '<div class="actions text-center checkboxcol'.$id.'">';
			$html .='<input type="checkbox" name="checkbox" id="checkbox'.$id.'" value="'.$id.'" onclick="checkbox('.$id.')"> <span id="checkboxcol'.$id.'"> Unpublish </span>';
			$html .= '</div>';
		}
	 
		return $html;
	}
	
	function point($roomnight, $promo_point){		
		$html = '-' ;
		if($promo_point > $roomnight){
			
			$promo_point = ($promo_point / $roomnight) ;
			$html = $promo_point ;
		}
		return $html;
	}
	function total_point($roomnight, $promo_point){
		$html = $roomnight ;
		if($promo_point > $roomnight){
			
			//$promo_point = ($promo_point / $roomnight) ;
			$html = $promo_point ;
		}
		return $html;
	}
?>