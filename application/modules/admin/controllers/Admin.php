<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('Admin_model', 'admin');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{

		$data = array(
			'judul' => 'Dashboard',
			'status' => $this->all->getstatus(),
			'dusun' => $this->all->getdusun()
		);
		// var_dump($data['status']);
		// die();
		$this->load->view('template/header');
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar');
		$this->load->view('index', $data);
		$this->load->view('template/footer');
	}


	public function notpound()
	{
		$this->load->view('template/header');
		$this->load->view('template/navbar');
		$this->load->view('template/sidebar');
		$this->load->view('notpound');
		$this->load->view('template/footer');
	}
}
