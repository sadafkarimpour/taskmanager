<?php 

defined('BASEPATH') OR exit('No direct script access allowed');



class Task extends CI_Model{


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



}

?>
