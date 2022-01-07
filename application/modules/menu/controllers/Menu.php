<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('idrole') != 2) {
			redirect('auth');
		}
		$this->load->model('Menu_model', 'menu');
		$this->load->model('all_model', 'all');
	}

	public function index()
	{
		$id = $this->session->userdata('idrole');
		$data = array(
			'judul' => 'Menu',
			'menu' => $this->menu->get(),
			'role' => $this->all->getidrole($id)
		);
		// var_dump($data['data']);
		// die();
		$this->load->view('template/header');
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar');
		$this->load->view('index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data = array(
			'menu' => htmlspecialchars($this->input->post('menu')),
			'icon' => htmlspecialchars($this->input->post('icon')),
			'url' => htmlspecialchars($this->input->post('url')),
			'urutan' => htmlspecialchars($this->input->post('urutan')),
			'aktif' => htmlspecialchars($this->input->post('aktif')),
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('menu', ['menu' => htmlspecialchars($this->input->post('menu'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->menu->insert($data);
			// $this->session->set_flashdata('berhasil', 'Role Berhasil Ditambah!');
			redirect('menu');
		} else {
			// $this->session->set_flashdata('gagal', 'menu Gagal Ditambah!');
			redirect('menu');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->menu->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'idmenu' => htmlspecialchars($this->input->post('id')),
			'menu' => htmlspecialchars($this->input->post('menu')),
			'icon' => htmlspecialchars($this->input->post('icon')),
			'url' => htmlspecialchars($this->input->post('url')),
			'urutan' => htmlspecialchars($this->input->post('urutan')),
			'aktif' => htmlspecialchars($this->input->post('aktif')),
		);
		// print_r($data);
		// die;
		$this->menu->update(htmlspecialchars($this->input->post('id')), $data);
		// $this->session->set_flashdata('berhasil', 'menu Berhasil Diubah!');
		redirect('menu');
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->menu->delete($id);
		$this->session->set_flashdata('berhasil', 'menu Berhasil Dihapus!');
		redirect('menu');
	}
}
