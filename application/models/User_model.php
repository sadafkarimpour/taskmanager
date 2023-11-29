<?php 

defined('BASEPATH') OR exit('No direct script access allowed');



class User_model extends CI_Model{


	/**
     * شناسه کاربر
     *
     * @var int
     */ 

	public $id;


	/**
     * نام کاربری
     *
     * @var string
     */ 

	public $username;


	/**
     * رمز عبور به صررت (hash)
     *
     * @var string
     */ 

	public $password;


	/**
     * نام کاربر
     *
     * @var string
     */ 

	public $name;


	/**
     * نام خانوادگی کاربر
     *
     * @var string
     */ 

	public $lastname;


	public static function login($username,$password)
	{
		 
		 $c = &get_instance();
		 $c->load->database();
	    
		 $username=$c->input->post('username');
		 $password=$c->input->post('password');
	
		 $check = $c->db->query("SELECT * From  `User` WHERE username='$username' and password='$password'");
		 $num_rows=$check->num_rows();
	    if($num_rows===1){
			 foreach ($check->result() as $row)
		 {
 
			 if($row->username==$username and $row->password==$password){
		  
				 $_SESSION["id"]=$row->id;
				 
				   return true;
			    
				 
			   }
			  else{
			   return false;
			  }
				 
		 }
	    }
	    else
	    {
		  
		   return false;
	    }
	
	}

	public static function register($username,$password,$name,$lastname)
	{
	   
		 $c = &get_instance();
		 $c->load->database();
		 $result = $c->db->query("INSERT INTO `User` ( `username`, `password`, `name`, `lastname`) VALUES ('$username','$password','$name','$lastname')");
 
	    if($result){
		   return array("statusCode"=>200);
	    }
	    else{
		   return array("statusCode"=>201);
	    
	    }
	}


}

?>
