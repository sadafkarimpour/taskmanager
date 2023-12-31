<?php 

defined('BASEPATH') OR exit('No direct script access allowed');



class Task_User_model extends CI_Model{


	/**
     * شناسه کاربر(primary key)
     *
     * @var int
     */ 

	public $id;


	/**
     *  شناسه کاربر(foreign key)
     *
     * @var string
     */ 

	public $iduser;


	/**
     * شناسه لیست(foreign key)
     *
     * @var string
     */ 

	public $idtask;


	/**
     * شناسه کاربر که لیست به او ارجاع شده
     *
     * @var string
     */ 

	public $iduser_ref;


	/**
     * تاریخ 
     *
     * @var string
     */ 

	public $datetime;



	

	public function SaveRef($userid,$referralid,$id_userref,$datedeadline){
		$c = &get_instance();
		$c->load->database();
		$result = $c->db->query("INSERT INTO `TaskUser` ( `id_user`, `id_task`, `id_user_ref` , `datetime`) VALUES ('$userid','$referralid','$id_userref','$datedeadline') ");
 
	    if($result){
		   return array("statusCode"=>200);
	    }
	    else{
		   return array("statusCode"=>201);
	    
	    }
	}

}

?>
