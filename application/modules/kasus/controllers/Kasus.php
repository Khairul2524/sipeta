<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kasus extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('Kasus_model', 'kasus');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{

		$data = array(
			'judul' => 'Kasus',
			'data' => $this->kasus->get(),
			// 'kasus' => $this->all->getidkasus($id)
		);
		// var_dump($data['data']);
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
			'kasus' => htmlspecialchars($this->input->post('kasus')),
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('kasus', ['kasus' => htmlspecialchars($this->input->post('kasus'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->kasus->insert($data);
			$this->session->set_flashdata('berhasil', 'kasus Berhasil Ditambah!');
			redirect('kasus');
		} else {
			$this->session->set_flashdata('gagal', 'kasus Gagal Ditambah!');
			redirect('kasus');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->kasus->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'idkasus' => htmlspecialchars($this->input->post('id')),
			'kasus' => htmlspecialchars($this->input->post('kasus')),
		);
		$cek = $this->db->get_where('kasus', ['kasus' => htmlspecialchars($this->input->post('kasus'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->kasus->update(htmlspecialchars($this->input->post('id')), $data);
			$this->session->set_flashdata('berhasil', 'kasus Berhasil Diubah!');
			redirect('kasus');
		} else {
			$this->session->set_flashdata('gagal', 'kasus Gagal Diubah!');
			redirect('kasus');
		}
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->kasus->delete($id);
		$this->session->set_flashdata('berhasil', 'kasus Berhasil Dihapus!');
		redirect('kasus');
	}
}
