<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dusun extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('Dusun_model', 'dusun');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{
		$id = $this->session->userdata('iddusun');
		$data = array(
			'judul' => 'Dusun',
			'data' => $this->dusun->get(),
			// 'dusun' => $this->all->getiddusun($id)
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
			'dusun' => htmlspecialchars($this->input->post('dusun')),
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('dusun', ['dusun' => htmlspecialchars($this->input->post('dusun'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->dusun->insert($data);
			$this->session->set_flashdata('berhasil', 'dusun Berhasil Ditambah!');
			redirect('dusun');
		} else {
			$this->session->set_flashdata('gagal', 'dusun Gagal Ditambah!');
			redirect('dusun');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->dusun->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'iddusun' => htmlspecialchars($this->input->post('id')),
			'dusun' => htmlspecialchars($this->input->post('dusun')),
		);
		$cek = $this->db->get_where('dusun', ['dusun' => htmlspecialchars($this->input->post('dusun'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->dusun->update(htmlspecialchars($this->input->post('id')), $data);
			$this->session->set_flashdata('berhasil', 'dusun Berhasil Diubah!');
			redirect('dusun');
		} else {
			$this->session->set_flashdata('gagal', 'dusun Gagal Diubah!');
			redirect('dusun');
		}
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->dusun->delete($id);
		$this->session->set_flashdata('berhasil', 'dusun Berhasil Dihapus!');
		redirect('dusun');
	}
}
