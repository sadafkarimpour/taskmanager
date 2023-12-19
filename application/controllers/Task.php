<?php 


defined('BASEPATH') OR exit('No direct script access allowed');



class Task extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	public function UserTable(){
		$this->load->database();
		$tbl="CREATE TABLE IF NOT EXISTS `User` (
			`id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`username` varchar(255) NOT NULL,
			`password` varchar(255) NOT NULL,
			`name` varchar(255) NOT NULL,
			`lastname` varchar(255) NOT NULL
			
			

		)";
		$this->db->query($tbl);
		$this->db->close();
	   
	}
	public function TaskTable(){
		$this->load->database();
		$tbl="CREATE TABLE IF NOT EXISTS `Task` (
			`id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
			`id_user` int(255) NOT NULL,
			`description` varchar(255) NOT NULL,
			`datetime_deadline` datetime NOT NULL,
			`priority` varchar(255) NOT NULL,
			`status` varchar(255) NOT NULL
		)";
		$this->db->query($tbl);
		$this->db->close();
	   
	}
	public function TaskUserTable(){
		$this->load->database();
		$tbl="CREATE TABLE IF NOT EXISTS `TaskUser` (
			`id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`id_user` int(255) NOT NULL ,
			`id_task` int(255) NOT NULL ,
			`id_user_ref` int(255) NOT NULL,
			`phone_number` varchar(255) NOT NULL,
			`datetime` datetime NOT NULL
		)";
		$this->db->query($tbl);
		$this->db->close();
	   
	}

    /**
	 * home page
	 *
	 * @return void
	 */
	public function Index()
	{
		$this->UserTable();
		$this->TaskTable();
		$this->TaskUserTable();
		$this->load->view("header");
		$path="http://localhost/Taskmanager/";
		$data=[
			'PATH'=>$path,
			'SiteurlLogin'=>$path."Task/login",
			'SiteurlRegister'=>$path."Task/register",
			'SiteurlTask'=>$path."Task/task",
			'SiteurlLogout'=>$path."Task/logout",

		];
		$this->load->helper('url');
		$this->load->view("menu",$data);
		$this->load->view("Index",$data);
		$this->load->view("footer");
		
	}

	/**
	 * This index() function, to display my task list page.
	 *
	 * @return void
	 */
	public function taskindex()
	{
		$this->UserTable();
		$this->TaskTable();
		$this->TaskUserTable();
		$this->load->view("header");
		$path="http://localhost/Taskmanager/";

		$this->load->model('User_model');

		$userid = $_SESSION["id"];

		$groups=$this->User_model->groupofid($userid);
		
		$data=[
			'PATH'=>$path,
			'SiteurlLogin'=>$path."Task/login",
			'SiteurlRegister'=>$path."Task/register",
			'SiteurlTask'=>$path."Task/task",
			'SiteurlLogout'=>$path."Task/logout",
			'userid'=>$userid,
			'groups'=> $groups,

		];
		$this->load->helper('url');
		$this->load->view("menu",$data);
		$this->load->view("tastindex",$data);
		$this->load->view("footer");
		
	}



	/**
	 * Login form
	 *
	 * @return void
	 */
	public function login()
	{
		$this->UserTable();
		$this->load->view("header");
		$path="http://localhost/Taskmanager/";
		$data=[
			'PATH'=>$path,
			'SiteurlLogin'=>$path."Task/login",
			'SiteurlRegister'=>$path."Task/register",
			'SiteurlTask'=>$path."Task/task",
			'SiteurlLogout'=>$path."Task/logout",

		];
		$this->load->helper('url');
		$this->load->view("menu",$data);
		$this->load->view("Login",$data);
		$this->load->view("footer");
	}

     /**
	 * do  login
	 *
	 * @return void
	 */
	public function doLogin()
	{
		$this->UserTable();
		

		$username=$this->input->post('username');
		$password=$this->input->post('password');  
	

	
	
		$this->load->model('User_model');
		$result=$this->User_model->login($username, $password);
	 
		if($result){
			echo json_encode([
				'statusCode'=>200
			]);
			return;
		}

		echo json_encode([
			'statusCode'=>201
		]);
	}

	
	/**
	 * Register form
	 *
	 * @return void
	 */
	public function register()
	{
		$this->UserTable();
		
		$this->load->view("header");
		$path="http://localhost/Taskmanager/";
		$data=[
			'PATH'=>$path,
			'SiteurlLogin'=>$path."Task/login",
			'SiteurlRegister'=>$path."Task/register",
			'SiteurlTask'=>$path."Task/task",
			'SiteurlLogout'=>$path."Task/logout",

		];
		$this->load->helper('url');
		$this->load->view("menu",$data);
		$this->load->view("Register",$data);
		$this->load->view("footer");
	}

     /**
	 * do  Register
	 *
	 * @return void
	 */
	public function doRegister()
	{
		// throw new Exception("Error Processing Request", 1);
		$this->UserTable();
		

		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$name=$this->input->post('name');
		$lastname=$this->input->post('lastname');
	
		$d = $this->load->model('User_model');
		$result=$this->User_model->register($username,$password,$name ,$lastname);

		if($result){
			echo json_encode([
				'statusCode'=>200
			]);
			return;
		}

		echo json_encode([
			'statusCode'=>201
		]);
	}


	/**
	 * receive list of task as a json to use in index
	 *
	 * @return void
	 */
	public function search()
	{	
		$this->load->model('Task_model');
		$result = $this->Task_model->Taskitems();
		if($result){
			echo json_encode($result);
			return;
		}

		echo json_encode([]);
	}

	/**
	 * view task
	 *
	 * @return void
	 */
	public function view($id)
	{

	}

	/**
	 * edit task
	 *
	 * @return void
	 */
	public function edit($id)
	{

	}


    /**
	 * Send the data of the edit form as Post & ajax to this function to save it in the db 
	 * and the result of save is returned as json.
	 *
	 * @return void
	 */
	public function save()
	{

		$this->TaskTable();
		

		$description=$this->input->post('description');
		$priority=$this->input->post('priority');
		$status=$this->input->post('status');

		$d = $this->load->model('Task_model');
		$result=$this->Task_model->Save($description,$priority,$status);

		if($result){
			echo json_encode([
				'statusCode'=>200
			]);
			return;
		}

		echo json_encode([
			'statusCode'=>201
		]);
	}

	public function Saveedit()
	{

		$this->TaskTable();
		
        $editid=$this->input->post('editid');
		$description=$this->input->post('description');
		$priority=$this->input->post('priority');
		$status=$this->input->post('status');

		$d = $this->load->model('Task_model');
		$result=$this->Task_model->Saveedit($editid,$description,$priority,$status);

		if($result){
			echo json_encode([
				'statusCode'=>200
			]);
			return;
		}

		echo json_encode([
			'statusCode'=>201
		]);
	}


	public function delete()
	{

		$this->TaskTable();
		

		$deletedid=$this->input->post('deletedid');

		$d = $this->load->model('Task_model');
		$result=$this->Task_model->delete($deletedid);

		if($result){
			echo json_encode([
				'statusCode'=>200
			]);
			return;
		}

		echo json_encode([
			'statusCode'=>201
		]);
	}


	/**
	 * This function receives the ID of the task and the ID of the user 
	 * and refers that task to the user and returns the result of the references as json.
	 *
	 * @return void
	 */
	public function Ref($id_task,$id_user)
	{

	}

	/**
	 * To change the state and save it.
	 *
	 * @return void
	 */
	public function Change_status($id_task,$new_state)
	{

	}
}
?>
