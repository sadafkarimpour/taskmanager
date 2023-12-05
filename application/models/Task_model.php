<?php 

defined('BASEPATH') OR exit('No direct script access allowed');



class Task_model extends CI_Model{


	/**
     * شناسه لیست
     *
     * @var int
     */ 

	public $id;


	/**
     * تاریخ ایجاد رکورد
     *
     * @var string
     */ 

	public $datetime;


	/**
     * شناسه کاربر ایجادکننده
     *
     * @var string
     */ 

	public $id_user;


	/**
     * متن توضیحات
     *
     * @var string
     */ 

	public $description;


	/**
     * تاریخ سررسید
     *
     * @var string
     */ 

	public $datetime_deadline;


	
	/**
     *اولویت(تاریخ اهمیت)
     *
     * @var string
     */ 

	public $priority;

	
	/**
     * وضعیت
     *
     * @var string
     */ 

	public $status;



	public static function Taskitems(){
		$c = &get_instance();
		$c->load->database();
		$tasks=[];
		$result = $c->db->query("SELECT * FROM `Task`");
		$total=$result->num_rows();
		if($total>0){
			foreach ($result->result() as $row)
		{

			log_message("debug", "row: \n" . print_r($row, true));
		
                $task = new Task_model();
			
                $task->id = $row->id;
			 $task->datetime=$row->datetime;
			 $task->id_user=$row->id_user;
			 $task->description=$row->description;
			 $task->priority=$row->priority;
			 $task->status=$row->status;
			 $task->datetime_deadline=$row->datetime_deadline;

              
                $tasks[] = $task;
           
		
			}
		}
		return $tasks;



	}

}

?>
