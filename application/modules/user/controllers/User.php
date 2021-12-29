<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('User_model', 'user');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{
		$data = array(
			'judul' => 'User',
			'data' => $this->user->get(),
			'roles' => $this->db->get('role')->result()
		);
		// var_dump($data['role']);
		// die();
		$this->load->view('template/header');
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => password_hash(htmlspecialchars($this->input->post('password')), PASSWORD_DEFAULT),
			'nama'     => $this->input->post('nama'),
			'idrole'   => $this->input->post('role'),
			'aktif'     => $this->input->post('aktif')
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('user', ['username' => htmlspecialchars($this->input->post('username'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->user->insert($data);
			$this->session->set_flashdata('berhasil', 'User Berhasil Ditambah!');
			redirect('user');
		} else {
			$this->session->set_flashdata('gagal', 'User Gagal Ditambah!');
			redirect('user');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->user->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'iduser' => htmlspecialchars($this->input->post('id')),
			'username' => $this->input->post('username'),
			'password' => password_hash(htmlspecialchars($this->input->post('password')), PASSWORD_DEFAULT),
			'nama'     => $this->input->post('nama'),
			'idrole'   => $this->input->post('role'),
			'aktif'     => $this->input->post('aktif')
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('user', $data)->row();
		// var_dump($cek);
		if (!$cek) {
			$this->user->update(htmlspecialchars($this->input->post('id')), $data);
			$this->session->set_flashdata('berhasil', 'User Berhasil Diubah!');
			redirect('user');
		} else {
			$this->session->set_flashdata('gagal', 'User Gagal Diubah!');
			redirect('user');
		}
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->user->delete($id);
		$this->session->set_flashdata('berhasil', 'User Berhasil Dihapus!');
		redirect('user');
	}
}
