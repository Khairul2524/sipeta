<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Status extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		login();
		$this->load->model('Status_model', 'status');
		$this->load->model('All_model', 'all');
	}

	public function index()
	{

		$data = array(
			'judul' => 'Status',
			'data' => $this->status->get(),
			// 'status' => $this->all->getidstatus($id)
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
			'status' => htmlspecialchars($this->input->post('status')),
		);
		// print_r($data);
		// die;
		$cek = $this->db->get_where('status', ['status' => htmlspecialchars($this->input->post('status'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->status->insert($data);
			$this->session->set_flashdata('berhasil', 'status Berhasil Ditambah!');
			redirect('status');
		} else {
			$this->session->set_flashdata('gagal', 'status Gagal Ditambah!');
			redirect('status');
		}
	}
	public function getubah()
	{
		$id = $_POST['id'];
		echo json_encode($this->status->getid($id));
	}
	public function ubah()
	{
		$data = array(
			'idstatus' => htmlspecialchars($this->input->post('id')),
			'status' => htmlspecialchars($this->input->post('status')),
		);
		$cek = $this->db->get_where('status', ['status' => htmlspecialchars($this->input->post('status'))])->row();
		// var_dump($cek);
		if (!$cek) {
			$this->status->update(htmlspecialchars($this->input->post('id')), $data);
			$this->session->set_flashdata('berhasil', 'status Berhasil Diubah!');
			redirect('status');
		} else {
			$this->session->set_flashdata('gagal', 'status Gagal Diubah!');
			redirect('status');
		}
	}
	public function hapus($id)
	{
		// var_dump($id);
		// die;
		$this->status->delete($id);
		$this->session->set_flashdata('berhasil', 'status Berhasil Dihapus!');
		redirect('status');
	}
}
