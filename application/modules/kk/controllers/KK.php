<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class KK extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('KK_model', 'kk');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{
		$id = $this->session->userdata('idkk');
		$data = array(
			'judul' => 'Kartu Keluarga',
			'data' => $this->kk->get(),
			// 'kk' => $this->all->getidkk($id)
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
			'kk' => htmlspecialchars($this->input->post('kk')),
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('kk', ['kk' => htmlspecialchars($this->input->post('kk'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->kk->insert($data);
			$this->session->set_flashdata('berhasil', 'kk Berhasil Ditambah!');
			redirect('kk');
		} else {
			$this->session->set_flashdata('gagal', 'kk Gagal Ditambah!');
			redirect('kk');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->kk->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'idkk' => htmlspecialchars($this->input->post('id')),
			'kk' => htmlspecialchars($this->input->post('kk')),
		);
		$cek = $this->db->get_where('kk', ['kk' => htmlspecialchars($this->input->post('kk'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->kk->update(htmlspecialchars($this->input->post('id')), $data);
			$this->session->set_flashdata('berhasil', 'kk Berhasil Diubah!');
			redirect('kk');
		} else {
			$this->session->set_flashdata('gagal', 'kk Gagal Diubah!');
			redirect('kk');
		}
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->kk->delete($id);
		$this->session->set_flashdata('berhasil', 'kk Berhasil Dihapus!');
		redirect('kk');
	}
}
