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






}

?>
